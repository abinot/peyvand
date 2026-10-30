<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Link extends Model
{
    use HasFactory;

    /** کدهایی که با مسیرهای خود برنامه تداخل دارند */
    public const RESERVED = [
        'login', 'logout', 'register', 'dashboard', 'settings', 'teams', 'team',
        'links', 'api', 'admin', 'forgot-password', 'reset-password',
        'two-factor-challenge', 'email', 'up', 'livewire', 'build', 'storage',
    ];

    protected $fillable = [
        'user_id', 'team_id', 'code', 'original_url', 'title',
        'clicks', 'is_active', 'expires_at',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'expires_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
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
