<?php

namespace App\Http\Controllers;

use App\Models\Parents;
use App\Models\Stage;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class ParentsController extends Controller
{
    public function index()
    {
        $nationalities = DB::table('nationalities')->select('id', 'name')->get();
        $stages = Stage::all();
        return view('admin.parents', compact('nationalities', 'stages'));
    }


    public function validateStep(Request $request)
    {

        
        // Define validation rules based on the current step
        $rules = [];

        if ($request->current_step==0) { // First step (Parent Account)            
            $rules = [
                'parent_email' => 'required|email',
                'parent_password' => 'required|min:8',
                'parent_confirm_password' => 'required|same:parent_password',
            ];
        } elseif ($request->current_step == 1) { // Second step (Parent Profile)           
            $rules = [
                'name_parent' => 'required|string|max:255',
                'phone_parent' => 'required|numeric',
                'nationality_id_parent' => 'required|exists:nationalities,id',
                'national_id_parent' => 'required|digits:14',
            ];
        } elseif ($request->current_step == 2) {// Third step (Child Information)            
            $rules = [
                'email_student' => 'required|email',
                'name_student' => 'required|string|max:255',
                'phone_student' => 'required|numeric',
                'national_id_student' => 'required|digits:14',
                'nationality_id_student' => 'required|exists:nationalities,id',
                'classroom_id' => 'required|exists:classrooms,id',
            ];
        }

        // Validate the request
        $validator = validator()->make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()->all()
            ]);
        }

        return response()->json([
            'success' => true
        ]);
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
        // Create Parent
        $parent =Parents::updateOrCreate(
        [
            'national_id' => $request->national_id_parent, // Search by National ID
        ],
        [
            'email' => $request->parent_email,
            'password' => Hash::make($request->parent_password), 
            'name' => $request->name_parent,
            'address' => $request->address_parent,
            'phone' => $request->phone_parent,
            'religion' => $request->religion_parent,
            'nationality_id' => $request->nationality_id_parent,
        ]);
    
        // Create Student
        Student::create([
            'email' => $request->email_student,
            'name' => $request->name_student,
            'national_id' => $request->national_id_student,
            'address' => $request->address_student,
            'phone' => $request->phone_student, 
            'religion' => $request->religion_student,
            'nationality_id' => $request->nationality_id_student,
            'parent_id' => $parent->id, 
            'classroom_id' => $request->classroom_id,
        ]);

      return back()->with('message', " added  successful!");;
      
    }

    /**
     * Display the specified resource.
     */
    public function show(Parents $parents)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Parents $parents)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Parents $parents)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Parents $parents)
    {
        //
    }
}
