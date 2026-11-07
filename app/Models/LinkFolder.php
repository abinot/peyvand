<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LinkFolder extends Model
{
    use HasFactory;

    protected $fillable = ['team_id', 'name', 'color', 'position'];

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function links(): HasMany
    {
        return $this->hasMany(Link::class, 'folder_id');
    }
}
