<?php

namespace App\Http\Resources\Car;

use App\Http\Resources\Driver\DriverResource;
use App\Http\Resources\Reservation\ReservationResource;
use App\Models\Car;
use App\Models\Category;
use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CarResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'model' => $this->model,
            'category_id' => $this->category_id,
            'driver_id' => $this->driver_id,
            'driver' => DriverResource::make($this->whenLoaded('driver')),
            'reservations' => ReservationResource::collection($this->whenLoaded('reservations')),
            'id' => $this->id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
