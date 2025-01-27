<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    public $fillable = [
        'name',
    ];

    public function car()
    {
        return $this->hasOne(Car::class);
    }
}
