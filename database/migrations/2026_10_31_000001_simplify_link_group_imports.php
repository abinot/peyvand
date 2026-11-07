<?php

use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('links') && ! Schema::hasColumn('links', 'tracking_rules')) {
            Schema::table('links', function (Blueprint $table) {
                $table->json('tracking_rules')->nullable()->after('metadata');
            });
        }

        if (Schema::hasTable('links')) {
            DB::transaction(function () {
                $campaigns = Schema::hasTable('link_campaigns')
                    ? DB::table('link_campaigns')->orderBy('id')->get()->keyBy('id')
                    : collect();
                $folderIdsByCampaign = [];

                // Convert old campaign names into ordinary team folders.
                if (Schema::hasTable('link_folders') && Schema::hasColumn('links', 'folder_id')) {
                    foreach ($campaigns as $campaign) {
                        $folderName = mb_substr(trim((string) $campaign->name) ?: 'گروه قدیمی '.$campaign->id, 0, 100);
                        $folderId = DB::table('link_folders')
                            ->where('team_id', $campaign->team_id)
                            ->where('name', $folderName)
                            ->value('id');

                        if (! $folderId) {
                            $folderId = DB::table('link_folders')->insertGetId([
                                'team_id' => $campaign->team_id,
                                'name' => $folderName,
                                'color' => 'zinc',
                                'position' => 0,
                                'created_at' => now(),
                                'updated_at' => now(),
                            ]);
                        }

                        $folderIdsByCampaign[$campaign->id] = $folderId;
                        if (Schema::hasColumn('links', 'campaign_id')) {
                            DB::table('links')
                                ->where('campaign_id', $campaign->id)
                                ->whereNull('folder_id')
                                ->update(['folder_id' => $folderId]);
                        }
                    }
                }

                // Move recipient data onto its ordinary Link. In the rare case
                // an old recipient no longer has a link, recreate one from the
                // campaign destination instead of silently discarding it.
                if (Schema::hasTable('link_campaign_recipients')) {
                    foreach (DB::table('link_campaign_recipients')->orderBy('id')->get() as $recipient) {
                        $link = ! empty($recipient->link_id)
                            ? DB::table('links')->where('id', $recipient->link_id)->first()
                            : null;
                        $campaign = $campaigns->get($recipient->campaign_id);

                        $recipientMetadata = $this->decodeJsonArray($recipient->metadata ?? null);
                        if (filled($recipient->name ?? null)) {
                            $recipientMetadata['name'] = $recipient->name;
                        }
                        if (filled($recipient->phone ?? null)) {
                            $phone = (string) $recipient->phone;
                            try {
                                // The previous model used Laravel's `encrypted` cast.
                                $phone = Crypt::decryptString($phone);
                            } catch (DecryptException) {
                                // Keep legacy plaintext values compatible.
                            }
                            $recipientMetadata['phone'] = $phone;
                        }
                        if (filled($recipient->status ?? null)) {
                            $recipientMetadata['status'] = $recipient->status;
                        }
                        if (filled($recipient->clicked_at ?? null)) {
                            $recipientMetadata['clicked_at'] = $recipient->clicked_at;
                        }

                        if (! $link) {
                            $destinationUrl = (string) ($campaign->destination_url ?? '');
                            if (! filter_var($destinationUrl, FILTER_VALIDATE_URL)) {
                                throw new RuntimeException(
                                    'Cannot convert legacy recipient '.$recipient->id.' because its campaign destination URL is missing or invalid.'
                                );
                            }

                            $campaignMetadata = $this->decodeJsonArray($campaign->metadata ?? null);
                            $utmSource = trim((string) ($campaign->channel ?? 'sms')) ?: 'sms';
                            $metadata = [
                                'utm_defaults' => array_filter([
                                    'utm_source' => $utmSource,
                                    'utm_medium' => $utmSource,
                                    'utm_campaign' => $campaignMetadata['utm_campaign'] ?? null,
                                ]),
                                'recipient' => $recipientMetadata,
                            ];

                            $name = trim((string) ($recipientMetadata['name'] ?? ''));
                            $campaignName = trim((string) ($campaign->name ?? 'گروه قدیمی'));
                            DB::table('links')->insert([
                                'team_id' => $recipient->team_id,
                                'created_by' => $campaign->created_by ?? null,
                                'folder_id' => $folderIdsByCampaign[$recipient->campaign_id] ?? null,
                                'category_id' => null,
                                'code' => $this->generateUniqueShortCode(),
                                'original_url' => $destinationUrl,
                                'title' => mb_substr($campaignName.($name !== '' ? ' — '.$name : ''), 0, 255),
                                'clicks' => 0,
                                'is_active' => true,
                                'expires_at' => null,
                                'metadata' => json_encode(
                                    $this->encryptSensitiveMetadata($metadata),
                                    JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES,
                                ),
                                'tracking_rules' => null,
                                'created_at' => $recipient->created_at ?? now(),
                                'updated_at' => now(),
                            ]);

                            continue;
                        }

                        $metadata = $this->decodeJsonArray($link->metadata ?? null);
                        if ($recipientMetadata !== []) {
                            $metadata['recipient'] = array_merge(
                                is_array($metadata['recipient'] ?? null) ? $metadata['recipient'] : [],
                                $recipientMetadata,
                            );
                        }

                        DB::table('links')->where('id', $link->id)->update([
                            'metadata' => json_encode(
                                $this->encryptSensitiveMetadata($metadata),
                                JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES,
                            ),
                        ]);
                    }
                }
            });
        }

        // Group creation is a bulk operation over regular links, not a separate
        // SMS-campaign domain. Remove the legacy campaign-only storage.
        Schema::dropIfExists('link_campaign_recipients');

        if (Schema::hasTable('links') && Schema::hasColumn('links', 'campaign_id')) {
            Schema::table('links', function (Blueprint $table) {
                $table->dropIndex(['team_id', 'campaign_id']);
                $table->dropConstrainedForeignId('campaign_id');
            });
        }

        Schema::dropIfExists('link_campaigns');
    }

    public function down(): void
    {
        if (Schema::hasTable('links') && Schema::hasColumn('links', 'tracking_rules')) {
            Schema::table('links', function (Blueprint $table) {
                $table->dropColumn('tracking_rules');
            });
        }

        // Conversion of legacy campaign data into folders/metadata is one-way.
    }

    private function generateUniqueShortCode(): string
    {
        do {
            $code = Str::random(6);
        } while (DB::table('links')->where('code', $code)->exists());

        return $code;
    }

    private function decodeJsonArray(mixed $value): array
    {
        if (is_array($value)) {
            return $value;
        }

        if (! is_string($value) || trim($value) === '') {
            return [];
        }

        $decoded = json_decode($value, true);

        return is_array($decoded) ? $decoded : [];
    }

    private function encryptSensitiveMetadata(array $values): array
    {
        $sensitiveKeys = ['phone', 'mobile', 'phone_number', 'mobile_number', 'telephone', 'mobile_phone'];

        foreach ($values as $key => $value) {
            if (is_array($value)) {
                $values[$key] = $this->encryptSensitiveMetadata($value);
                continue;
            }

            if (in_array(mb_strtolower((string) $key), $sensitiveKeys, true) && is_scalar($value) && (string) $value !== '') {
                $string = (string) $value;
                $values[$key] = str_starts_with($string, 'enc:') ? $string : 'enc:'.Crypt::encryptString($string);
            }
        }

        return $values;
    }
};
