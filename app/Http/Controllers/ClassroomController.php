<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Stage;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{

    public function index(Request $request)
    {
        $stages = Stage::all();
        if ($request->filter) {
            $filter_value = $request->filter;
            $classrooms = Classroom::where('name', 'like', '%' . $request->search . '%')
                ->whereHas('grade', function ($query) use ($filter_value) {
                    $query->where('stage_id', $filter_value);
                })->get();
        }
       else if ($request->search) {
            $classrooms = Classroom::where('name', 'like', '%' . $request->search . '%')->get();               
        }
        else {
            $classrooms = Classroom::all();
        }

        return view('admin.classrooms', compact('classrooms', 'stages',));
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required',
            'grade_id' => 'required',
        ]);

        Classroom::create($request->all());

        return back()->with('message', " added  successful!");
    }



    public function update(Request $request, string $id)
    {
        $validate = $request->validate([
            'name' => 'required',
            'grade_id' => 'required',
        ]);
        $grade = Classroom::findOrFail($id);
        $grade->name = $request->name;
        $grade->grade_id = $request->grade_id;
        $grade->status = $request->status;
        $grade->save();
        return back()->with('message', ' update  successful!');
    }

    public function destroy($id)
    {

        $grade = Classroom::findOrFail($id);
        $grade->delete();
        return back()->with('message', 'تم الحذف');
    }

    
}
