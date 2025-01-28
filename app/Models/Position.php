<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Position extends Model
{
    /* @property int $id - id должности
     * @property string $position - название должности
     * @property datetime $created_at - дата создания
     * @property datetime $updated_at - дата обновления
     */

    protected $fillable = [
        'position',
    ];

    public function employees(): hasMany
    {
        return $this->hasMany(Employee::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(
            Category::class,
            'position_category',
            'position_id',
            'category_id'
        );
    }
}
