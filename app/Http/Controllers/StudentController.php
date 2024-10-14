<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
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
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:students,email',
            'name' => 'required|string|max:255',
            'national_id' => 'required|string|max:50',
            'parent_id' => 'required|exists:parents,id', // Assuming a parents table exists
            'classroom_id' => 'required|exists:classrooms,id', // Assuming a classrooms table exists
        ]);

        // Create the student
        Student::create([
            'email' => $request->email,
            'name' => $request->name,
            'national_id' => $request->national_id,
            'parent_id' => $request->parent_id,
            'classroom_id' => $request->classroom_id,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        //
    }
}
