<?php

namespace App\Http\Controllers;

use App\Models\Stage;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    public function index(Request $request)
    {
        if ($request->search) {
            $teachers = Teacher::where('email', $request->search)
                ->OrWhere('national_id', $request->search)
                ->OrWhere('name', 'like', '%' . $request->search . '%')->get();
        } else $teachers = Teacher::all();
        return view('admin.teachers.teachers', compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $nationalities = DB::table('nationalities')->select('id', 'name')->get();
        $specialties = DB::table('specialties')->select('id', 'name')->get();
        return view('admin.teachers.Add_teachers', compact('nationalities', 'specialties'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $request->validate([
                'email' => 'required|email|unique:teachers,email',
                'password' => 'required|min:8',
                'name' => 'required|string|max:255',
                'phone' => 'required|numeric',
                'nationality' => 'required',
                'national_id' => 'required|digits:14|unique:teachers,national_id',
                'gender'=> 'required',
                'specialty.*' => 'exists:specialties,id',
        ]);
        $request->merge(['password' => Hash::make($request->password)]);
       $teacher= Teacher::create(
            $request->all()
        );
        $teacher->specialties()->attach($request->specialty);

        return back()->with('message', " added  successful!");
    }

    /**
     * Display the specified resource.
     */
    public function show(Teacher $teacher)
    {
        $teacher_specialty=[];
        foreach($teacher->specialties as $specialty){
            $teacher_specialty[]=$specialty->id;
        }
        $nationalities = DB::table('nationalities')->select('id', 'name')->get();
        $specialties = DB::table('specialties')->select('id', 'name')->get();
        return view('admin.teachers.show_teachers', compact('teacher', 'nationalities', 'specialties', 'teacher_specialty'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Teacher $teacher)
    {
        $teacher_specialty = [];
        foreach ($teacher->specialties as $specialty) {
            $teacher_specialty[] = $specialty->id;
        }
        $nationalities = DB::table('nationalities')->select('id', 'name')->get();
        $specialties = DB::table('specialties')->select('id', 'name')->get();

        return view('admin.teachers.edit_teachers', compact('teacher', 'nationalities','specialties', 'teacher_specialty'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Teacher $teacher)
    {

        $request->validate([
            'email' => 'required|email|unique:teachers,email',
            'password' => 'required|min:8',
            'name' => 'required|string|max:255',
            'phone' => 'required|numeric',
            'gender'=> 'required',
            'nationality' => 'required',
            'national_id' => 'required|digits:14|unique:teachers,national_id',
            'specialty.*' => 'exists:specialties,id',
        ]);
        $teacher->fill([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'gender'=>$request->gender,
            'religion' => $request->religion,
            'nationality' => $request->nationality,
            'national_id' => $request->national_id,
        ]);

        $teacher->save();
        $teacher->specialties()->sync($request->specialty);

        return back()->with('message', ' update  successful!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $teacher = Teacher::findOrFail($id);
        $teacher->delete();
        return back()->with('message', 'تم الحذف');
    }
}
