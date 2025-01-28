<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservationRequest;
use App\Http\Resources\Reservation\ReservationResource;
use App\Models\Reservation;

class ReservationController extends Controller
{
    public function show(int $id)
    {
        $reservation = Reservation::with(['car','employee'])->findOrFail($id);

        return new ReservationResource($reservation);
    }

    public function store(ReservationRequest $request)
    {
        $data = $request->validated();
        $data['employee_id'] = $request->user()->id;

        $reservation = Reservation::create($data);

        return ReservationResource::make($reservation)->
        addiational([
            'message' => 'Reservation created successfully'
        ]);
    }

    public function delete(int $id)
    {
        $reservation = Reservation::findOrFail($id);

        $reservation->delete();

        return response()->json([
            'success' => true,
            'message' => 'Reservation deleted'
        ]);
    }
}
