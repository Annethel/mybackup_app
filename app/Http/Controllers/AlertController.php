<?php

namespace App\Http\Controllers;

use App\Models\Alert;
use Illuminate\Http\Request;
use App\Http\Requests\AlertRequest;

class AlertController extends Controller
{
    
   public function store(AlertRequest $request)
{
    $user = auth()->user();

    if  (!$user->student)  {
        return response()->json(['error' => 'Only students can create alerts.'], 403);
    }

    


    $alert = Alert::create([
        'student_id' => $user->student->id,
        'alert_type_id' => $request->alert_type_id,
        'location_name' => $request->location_name,
        'latitude' => $request->latitude,
        'longitude' => $request->longitude,
        'description' => $request->description,
        'sent_at' => now(),
    ]);

    return response()->json([
        'message' => 'Alert created successfully.',
        'data' => $alert
    ], 201);
}

    // List all alerts for the logged-in user (student or guardian)
     public function index()
{
    $user = auth()->user();

    if (!$user) {
        return response()->json(['error' => 'Unauthenticated.'], 401);
    }

    // Student can view their own alerts
    if ($user->student) {
        $alerts = $user->student->alerts()->latest()->get();

        return response()->json([
            'message' => 'Student alerts retrieved successfully.',
            'data' => $alerts
        ]);
    }

    // Guardian can view alerts of their linked student
    if ($user->guardian) {
        $student = \App\Models\Student::first(); // you can later change this to find the actual linked student

        if (!$student) {
            return response()->json(['error' => 'No student found.'], 404);
        }

        $alerts = $student->alerts()->latest()->get();

        return response()->json([
            'message' => 'Guardian view: student alerts retrieved.',
            'data' => $alerts
        ]);
    }

    return response()->json(['error' => 'Unauthorized.'], 403);
}

}
