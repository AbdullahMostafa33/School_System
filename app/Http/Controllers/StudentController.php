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
        $students=$query->paginate(100);      
        }
        else  $students=Student::paginate(100);
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
        $student->forceDelete();
        return back()->with('message', 'delete successful!');
    }

    public function showMove(Request $request)
    {
    $students=[];
    if (!empty($request->all())){ //$request->all() return request parameter name
       $query=Student::where('name','like','%'.$request->search.'%');
       if($request->filter_classroom) $query->where('classroom_id', $request->filter_classroom);
       elseif ($request->filter_grade){
           $grade_value= $request->filter_grade;
           $query->whereHas('classroom',function ($query)use($grade_value){
             $query->where('grade_id',$grade_value);
          });
       }
       elseif($request->filter_stage){
        $stage_value= $request->filter_stage;
        $query->whereHas('classroom.grade',function($query)use($stage_value){
            $query->where('stage_id',$stage_value);
        });
       }

        $students=$query->get();
    }
        $stages = Stage::all();      

        return view('admin.students.move', compact('students', 'stages' ));
    }


    public function move(Request $request){  
                
        $request->validate([
            'move_stage' => 'required|exists:stages,id',
            'move_grade' => 'required|exists:grades,id',
            'move_classroom' => 'required|exists:classrooms,id',
            'students_selected' => 'required|array|exists:students,id'
        ]);       
        Student::whereIn('id', $request->students_selected)
        ->update(['classroom_id' => $request->move_classroom]);
        return back()->with('message','Move Success!');            
    }

    public function delete_selection(Request $request)  {
       $request->validate( ['students_selected'=>'required|array']  );
       Student::whereIn('id',$request->students_selected)->forceDelete();
       return back()->with('message','Delete Success!');      
    }

    public function show_graduates(Request $request){
        if($request->search){
            $students = Student::onlyTrashed()->where('name','like','%'. $request->search.'%')
             ->orWhere('national_id', $request->search)->paginate(100);
        }
        elseif($request->graduate_year) $students = Student::onlyTrashed()->whereYear('deleted_at', $request->graduate_year)->paginate(100);
        else  $students=Student::onlyTrashed()->paginate(100);
        return view('admin.students.graduates', compact('students'));
    }

    public function graduate_students(Request $request)
    {
         $request->validate(['students_selected'=>'required|array']);
         Student::whereIn('id',$request->students_selected)->delete();
         return back()->with('message', 'Graduate Success!');
    }

    public function restore_student($id , Request $request) {       
       if($id=='restore_selection'){
         $request->validate(['students_selected' => 'required|array']);
         Student::withTrashed()->whereIn('id', $request->students_selected)->restore();
       }
       else Student::withTrashed()->find($id)->restore();
       return back()->with('message', 'Restore Success!');
    }
}
