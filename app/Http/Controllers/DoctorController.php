<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;

class DoctorController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    public function index(Request $request)
    {
        $appointments = Appointment::where('doctor_id', Auth::id())
            ->when($request->date, function ($query, $date) {
                $query->whereDate('appointment_date', $date);
            })
            ->get();

        return response()->json($appointments);
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
}
