<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservationRequest;
use App\Models\Reservation;

class ReservationController extends Controller
{
    public function store(ReservationRequest $request)
    {
        $data = $request->validated();
        $data['employee_id'] = $request->user()->id;

        $reservation = Reservation::create($data);

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
