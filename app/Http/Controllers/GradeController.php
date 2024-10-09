<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    
    public function index()
    {
        $grades=Grade::all();       
        return view('admin.grades',compact('grades'));
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required',
            'statge_id' => 'required',
        ]);

        Grade::create($request->all());

        return back()->with('message', " added  successful!");
    }



    public function update(Request $request, string $id)
    {
        $validate = $request->validate([
            'name' => 'required','statge_id' => 'required',
        ]);
        $grade = Grade::findOrFail($id);
        $grade->name = $request->name;
        $grade->statge_id = $request->statge_id;
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
}
