<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservationRequest;
use App\Models\Reservation;

class ReservationController extends Controller
{
    public function store(ReservationRequest $request)
    {
        $reservation = Reservation::create([
            'employee_id' => $request->user()->id,
            'car_id' => $request->car_id,
            'started_at' => $request->started_at,
            'ended_at' => $request->ended_at,
        ]);

        return response()->json([
            'message' => 'Reservation created successfully',
            'reservation' => $reservation,
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
