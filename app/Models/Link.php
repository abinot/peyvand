<?php

namespace App\Models;

use App\Casts\EncryptedMetadata;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Link extends Model
{
    use HasFactory;

    /** کدهایی که با مسیرهای خود برنامه تداخل دارند. */
    public const RESERVED = [
        'login', 'logout', 'register', 'dashboard', 'settings', 'teams', 'team',
        'links', 'analytics', 'api', 'admin', 'forgot-password',
        'reset-password', 'two-factor-challenge', 'email', 'up', 'livewire',
        'build', 'storage',
    ];

    protected $fillable = [
        'team_id', 'created_by', 'folder_id', 'category_id',
        'code', 'original_url', 'title', 'clicks', 'is_active', 'expires_at', 'metadata', 'tracking_rules',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'expires_at' => 'datetime',
            'metadata' => EncryptedMetadata::class,
            'tracking_rules' => 'array',
        ];
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function folder(): BelongsTo
    {
        return $this->belongsTo(LinkFolder::class, 'folder_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(LinkCategory::class, 'category_id');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(LinkTag::class, 'link_tag_link')->withTimestamps();
    }

    public function scopeForTeam(Builder $query, int $teamId): Builder
    {
        return $query->where('team_id', $teamId);
    }

    public function clickLogs(): HasMany
    {
        return $this->hasMany(LinkClick::class);
    }

    public function getShortUrlAttribute(): string
    {
        return url($this->code);
    }

    public function isUsable(): bool
    {
        return $this->is_active
            && (! $this->expires_at || $this->expires_at->isFuture());
    }

    public static function generateCode(int $length = 6): string
    {
        do {
            $code = Str::random($length);
        } while (
            in_array(strtolower($code), self::RESERVED, true)
            || self::where('code', $code)->exists()
        );

        return $code;
    }
}
