<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;

class AppointmentController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    public function create(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required|exists:users,id',
            'appointment_date' => 'required|date|after:now',
        ]);

        $appointment = new Appointment();
        $appointment->patient_id = Auth::id();
        $appointment->doctor_id = $request->doctor_id;
        $appointment->appointment_date = $request->appointment_date;
        $appointment->status = 'pending';
        $appointment->save();

        return response()->json($appointment, 201);
    }

    public function updateStatus(Request $request, Appointment $appointment)
    {
        $this->authorize('update', $appointment);

        $request->validate([
            'status' => 'required|in:approved,cancelled',
        ]);

        $appointment->status = $request->status;
        $appointment->save();

        return response()->json($appointment);
    }

    public function index(Request $request)
    {
        $appointments = Appointment::where('patient_id', Auth::id())
            ->when($request->date, function ($query, $date) {
                $query->whereDate('appointment_date', $date);
            })
            ->get();

        return response()->json($appointments);
    }
}
