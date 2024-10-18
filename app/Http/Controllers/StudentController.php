<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Grade;
use App\Models\Parents;
use App\Models\Stage;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
   
    public function index(Request $request)
    {
        if(($request->filter_by&&$request->filter_value)|| $request->search){
            $filter_value= $request->filter_value;
            $query= Student::where('national_id',$request->search)
                    ->orWhere('name', 'like', '%' . $request->search . '%');
          
        if($request->filter_by=='classroom')$query->where('classroom_id',$filter_value);
        elseif($request->filter_by == 'grade'){
            $query->whereHAs('classroom',function($query)use($filter_value){
                $query->where('grade_id',$filter_value);
            });
        }
        elseif($request->filter_by == 'stage') {
            $query->whereHas('classroom.grade',function($query)use($filter_value){
                $query->where('stage_id',$filter_value);
            });
        }
        $students=$query->get();      
        }
        else  $students=Student::all();
        $stages=Stage::all();
        $grades = Grade::with('stage')->get();
        $classrooms=Classroom::with('grade')->get();

        return view('admin.students.students',compact('students', 'stages', 'grades', 'classrooms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         $nationalities=DB::table('nationalities')->get();
        $stages=Stage::get(['id','name']);
        return view('admin.students.Add_students',compact('nationalities','stages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
       $parent= Parents::where('national_id',$request->parent_national_id)->first(['id']);
       if($parent) $request['parent_id']=$parent->id;

        $request->validate([
            'email' => 'required|email|unique:students,email',
            'name' => 'required|string|max:255',
            'phone'=>'required',
            'nationality' => 'required',
            'address' => 'required',
            'religion' => 'required',
            'gender' => 'required',
            'national_id' => 'required|string|max:50',
            'parent_id' => 'required|exists:parents,id', 
            'classroom_id' => 'required|exists:classrooms,id', 
        ],[
            'parent_id.required' =>"Parent doesn't exit add parent first" ,
        ]);

        Student::create($request->all());
       return back()->with('message','add success!');       
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        return view('admin.students.show_students',compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        $nationalities = DB::table('nationalities')->get();
        $stages = Stage::get(['id', 'name']);
        return view('admin.students.edit_students', compact('student', 'nationalities', 'stages'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        $parent = Parents::where('national_id', $request->parent_national_id)->first(['id']);
        if ($parent) $request['parent_id'] = $parent->id;
        $request->validate([
            'email' => 'required|email|unique:students,email,'.$student->id,
            'name' => 'required|string|max:255',
            'password'=> 'required|min:8',
            'phone' => 'required',
            'nationality' => 'required',
            'address' => 'required',
            'religion' => 'required',
            'gender' => 'required',
            'national_id' => 'required|string|max:50',
            'parent_id' => 'required|exists:parents,id',
            'classroom_id' => 'required|exists:classrooms,id',
        ], [
            'parent_id.required' => "Parent doesn't exit add parent first",
        ]);
        
        $student->update([
            'email' => $request->email,
            'name' => $request->name,
            'password' => Hash::make($request->password), // Ensure the password is hashed
            'phone' => $request->phone,
            'nationality' => $request->nationality,
            'address' => $request->address,
            'religion' => $request->religion,
            'gender' => $request->gender,
            'national_id' => $request->national_id,
            'parent_id' => $request->parent_id,
            'classroom_id' => $request->classroom_id,
        ]);
        return back()->with('message', 'Update success!');       
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $student->delete();
        return back()->with('message', 'delete successful!');
    }
}
