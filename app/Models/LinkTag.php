<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class LinkTag extends Model
{
    use HasFactory;

    protected $fillable = ['team_id', 'name', 'slug'];

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function links(): BelongsToMany
    {
        return $this->belongsToMany(Link::class, 'link_tag_link')->withTimestamps();
    }
}
