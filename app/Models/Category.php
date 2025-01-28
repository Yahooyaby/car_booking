<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = [
        'category'
    ];

    public function cars(): HasMany
    {
        return $this->hasMany(Car::class);
    }

    public function positions(): BelongsToMany
    {
        return $this->belongsToMany(
            Position::class,
            'position_category',
            'category_id',
            'position_id'
        );
    }
}
