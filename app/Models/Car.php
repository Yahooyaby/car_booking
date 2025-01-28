<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Car extends Model
{
    /* @property int $id - id машины
     * @property string $model - название модели
     * @property int $category_id - id категории машины
     * @property datetime $created_at - дата создания
     * @property datetime $updated_at - дата обновления
     */

    protected $fillable = [
        'model',
        'category_id',
        'driver_id',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function driver(): BelongsTo
    {
        return $this->belongsTo(Driver::class, 'driver_id', 'id');
    }

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class, 'car_id', 'id');
    }

}
