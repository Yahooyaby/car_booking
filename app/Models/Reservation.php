<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

class Reservation extends Model
{
    /* @property int $id - id бронирования
     * @property int $employee_id - id сотрудника
     * @property int $car_id - id машины
     * @property datetime $started_at - время начала бронирования водителя
     * @property datetime $ended_at - время окончания бронирования водителя
     * @property datetime $created_at - дата создания
     * @property datetime $updated_at - дата обновления
     */

    protected $fillable = [
        'employee_id',
        'car_id',
        'started_at',
        'ended_at',
    ];

    protected function casts(): array
    {
        return [
            'started_at' => 'datetime',
            'ended_at' => 'datetime'
        ];
    }

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class);
    }

    public function scopeFuture($query)
    {
        return $query->where('started_at', '>', Carbon::now());
    }
}
