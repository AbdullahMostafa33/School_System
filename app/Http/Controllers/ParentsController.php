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
    public function index(Request $request)
    {
        if($request->search){
            $parents=Parents::where('email', $request->search)
                             ->OrWhere('national_id', $request->search)
                             ->OrWhere('name','like', '%' . $request->search . '%')->get();                     
        }
        else $parents=Parents::all();
        return view('admin.parents.parents', compact('parents'));
    }


    public function validateStep(Request $request)
    {        
        // Define validation rules based on the current step
        $rules = [];

        if ($request->current_step==0) { // First step (Parent Account)            
            $rules = [
                'parent_email' => 'required|email|unique:parents,email',
                'parent_password' => 'required|min:8',
                'parent_confirm_password' => 'required|same:parent_password',
            ];
        } elseif ($request->current_step == 1) { // Second step (Parent Profile)           
            $rules = [
                'name_parent' => 'required|string|max:255',
                'phone_parent' => 'required|numeric',
                'nationality_id_parent' => 'required|exists:nationalities,id',
                'national_id_parent' => 'required|digits:14|unique:parents,national_id',
            ];
        } elseif ($request->current_step == 2) {// Third step (Child Information)            
            $rules = [
                'email_student' => 'required|email|unique:students,email',
                'name_student' => 'required|string|max:255',
                'phone_student' => 'required|numeric',
                'national_id_student' => 'required|digits:14|unique:students,national_id',
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
        $nationalities = DB::table('nationalities')->select('id', 'name')->get();
        $stages = Stage::all();
        return view('admin.parents.Add_parents', compact('nationalities', 'stages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Create Parent
        $parent =Parents::create(        
        [
            'email' => $request->parent_email,
            'password' => Hash::make($request->parent_password), 
            'name' => $request->name_parent,
            'national_id'=>$request->national_id_parent,
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
    public function show(Parents $parent)
    {
        $nationalities = DB::table('nationalities')->select('id', 'name')->get();
        return view('admin.parents.show_parents', compact('parent', 'nationalities'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Parents $parent)
    {
        $nationalities = DB::table('nationalities')->select('id', 'name')->get();
        return view('admin.parents.edit_parents', compact('parent', 'nationalities'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Parents $parent)
    {
       
        $request->validate(['parent_email' => 'required|email',
            'parent_password' => 'required|min:8',
            'parent_confirm_password' => 'required|same:parent_password',
            'name_parent' => 'required|string|max:255',
            'phone_parent' => 'required|numeric',
            'nationality_id_parent' => 'required|exists:nationalities,id',
            'national_id_parent' => 'required|digits:14',
            'address_parent'=> 'required',
            'religion_parent'=> 'required'
        ]);
        $parent->fill([
            'email' => $request->parent_email,
            'password' => Hash::make($request->parent_password),
            'name' => $request->name_parent,
            'address'=>$request->address_parent,
            'phone' => $request->phone_parent,
            'religion'=>$request->religion_parent,
            'nationality_id' => $request->nationality_id_parent,
            'national_id' => $request->national_id_parent,
        ]);

        $parent->save();
        return back()->with('message', ' update  successful!'); 
       }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $parent = Parents::findOrFail($id);
        $parent->delete();
        return back()->with('message', 'تم الحذف');
    }
}
