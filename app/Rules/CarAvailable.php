<?php

namespace App\Rules;

use App\Models\Car;
use Illuminate\Contracts\Validation\Rule;

class CarAvailable implements Rule
{
    protected $startedAt;
    protected $endedAt;

    public function __construct($startedAt, $endedAt)
    {
        $this->startedAt = $startedAt;
        $this->endedAt = $endedAt;
    }

    public function passes($attribute, $value)
    {
        return Car::where('id', $value)
            ->whereDoesntHave('reservations', function ($query) {
                $query->where(function ($query) {
                    $query->where('started_at', '<=', $this->endedAt)
                        ->where('ended_at', '>=', $this->startedAt);
                });
            })->exists();
    }

    public function message()
    {
        return 'The selected car is not available for the specified time.';
    }
}
