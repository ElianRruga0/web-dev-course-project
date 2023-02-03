<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth:api');
    }

    public function index()
    {
        $reservations = Reservation::with('activity')->get();

        return response()->json([
            'status' => 'success',
            'reservations' => $reservations,
        ]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'surname' => 'required|string',
            'email' => 'required|string',
            'phone' => 'required|string',
            'guests' => 'required',
            'activity_id' => 'required|exists:activities,id'
        ]);


        $reservation = Reservation::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'phone' => $request->phone,
            'guests' => $request->guests,
            'activity_id' => $request->activity_id,
        ]);


        return response()->json([
            'status' => 'success',
            'message' => 'Reservation created successfully',
            'reservation' => $reservation,
        ]);
    }

    public function show($id)
    {
        $reservation = Reservation::find($id);
        return response()->json([
            'status' => 'success',
            'reservation' => $reservation,
        ]);
    }

    public function destroy($id)
    {
        $Reservation = Reservation::find($id);
        $Reservation->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Reservation deleted successfully',
            'reservation' => $Reservation,
        ]);
    }
}