<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LinkClick extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'link_id', 'ip_hash', 'user_agent', 'referer', 'utm_parameters',
        'metadata', 'device_type', 'browser', 'platform', 'created_at',
    ];

    protected function casts(): array
    {
        return [
            'utm_parameters' => 'array',
            'metadata' => 'array',
            'created_at' => 'datetime',
        ];
    }

    public function link(): BelongsTo
    {
        return $this->belongsTo(Link::class);
    }
}
