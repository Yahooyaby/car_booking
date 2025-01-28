<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    /* @property int $id - id водителя
     * @property string $name - имя водителя
     * @property datetime $created_at - дата создания
     * @property datetime $updated_at - дата обновления
     */

    public $fillable = [
        'name',
    ];

    public function car()
    {
        return $this->hasOne(Car::class);
    }
}
