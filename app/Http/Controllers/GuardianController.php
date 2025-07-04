<?php

namespace App\Http\Controllers;

use App\Models\Guardian;
use Illuminate\Http\Request;

use App\Models\Student;

class GuardianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function getByStudent($studentId)
    {
        $student = Student::find($studentId);

        if (!$student) {
            return response()->json(['error' => 'Student not found.'], 404);
        }

        $guardian = $student->guardian;

        if (!$guardian) {
            return response()->json(['error' => 'Guardian not found for this student.'], 404);
        }

        return response()->json([
            'message' => 'Guardian retrieved successfully.',
            'data' => $guardian
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Guardian $guardian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Guardian $guardian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Guardian $guardian)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Guardian $guardian)
    {
        //
    }
}
