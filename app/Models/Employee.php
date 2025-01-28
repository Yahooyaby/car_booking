<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Employee extends Authenticatable
{
    use HasApiTokens;

    /* @property int $id - id сотрудника
     * @property string $name - имя сотрудника
     * @property string $email - адрес электронной почты
     * @property int $position_id - id должности сотрудника
     * @property int $password - пароль
     * @property datetime $created_at - дата создания
     * @property datetime $updated_at - дата обновления
     */

    protected $fillable = [
        'name',
        'email',
        'position_id',
        'password',
    ];

    public function position(): BelongsTo
    {
        return $this->belongsTo(Position::class);
    }

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }
}
