<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LinkClick extends Model
{
    public $timestamps = false;

    protected $fillable = ['link_id', 'ip_hash', 'user_agent', 'referer'];

    public function link(): BelongsTo
    {
        return $this->belongsTo(Link::class);
    }
}
