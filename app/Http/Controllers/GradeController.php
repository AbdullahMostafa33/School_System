<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Stage;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    
    public function index()
    {
        $grades=Grade::all();
        $stages=Stage::all();       
        return view('admin.grades',compact('grades' ,'stages',));
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required',
            'stage_id' => 'required',
        ]);

        Grade::create($request->all());

        return back()->with('message', " added  successful!");
    }



    public function update(Request $request, string $id)
    {
        $validate = $request->validate([
            'name' => 'required','stage_id' => 'required',
        ]);
        $grade = Grade::findOrFail($id);
        $grade->name = $request->name;
        $grade->stage_id = $request->stage_id;
        $grade->notice = $request->notice;
        $grade->save();
        return back()->with('message', ' update  successful!');
    }

    public function destroy($id)
    {

        $grade = Grade::findOrFail($id);
        $grade->delete();
        return back()->with('message', 'تم الحذف');
    }

    // get grade of same stage  for ajax
    public function getGrades(Request $request)
    {
        $grades = Grade::where('stage_id', $request->stage_id)->get();
        return $grades;
    }
}
