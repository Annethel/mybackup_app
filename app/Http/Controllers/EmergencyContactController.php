<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmergencyContactRequest;
use App\Models\EmergencyContact;
use Illuminate\Http\Request;


class EmergencyContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmergencyContactRequest $request)
    {
        $user = auth()->user();

        // Assuming the user has a related student profile
        if (!$user->student) {
            return response()->json(['error' => 'Only students can add emergency contacts.'], 403);
        }

        $contact = EmergencyContact::create([
            'student_id' => $user->student->id,
            'name' => $request->name,
            'phone' => $request->phone,
            'type' => $request->type,
            'relationship' => $request->relationship,
            'address' => $request->address,
        ]);

        return response()->json([
            'message' => 'Emergency contact created successfully.',
            'data' => $contact
        ], 201);
    }

    /**
     * Display the specified resource.
     */

     public function index()
{
    $user = auth()->user();

    if (!$user) {
        return response()->json(['error' => 'Unauthenticated.'], 401);
    }

    if (!$user->student) {
        return response()->json(['error' => 'Only students can view their emergency contacts.'], 403);
    }

    $contacts = $user->student->emergencyContacts()->latest()->get();

    return response()->json([
        'message' => 'Emergency contacts retrieved successfully.',
        'data' => $contacts
    ]);

    if ($user->guardian) {
        $student = \App\Models\Student::first(); // get the only student

        if (!$student) {
            return response()->json(['error' => 'No student found.'], 404);
        }

        $contacts = $student->emergencyContacts()->latest()->get();

        return response()->json([
            'message' => 'Guardian view: student emergency contacts retrieved.',
            'data' => $contacts
        ]);
    }
}

    public function show(EmergencyContact $emergencyContact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EmergencyContact $emergencyContact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EmergencyContact $emergencyContact)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EmergencyContact $emergencyContact)
    {
        //
    }
}
