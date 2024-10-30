<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Stage;
use App\Models\Grade;
use App\Models\Specialty;
use Illuminate\Http\Request;

class SpecialtyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stages = Stage::all();
        $grades = Grade::all();
        $specialties = Specialty::all();
        return view('admin.specialties.index', compact('stages','grades','specialties'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = ['name'=>'required|string|max:255'];
        if($request->grade_id == 'all') $request['grade_id'] = null;
        else $rules['grade_id'] = 'required|exists:grades,id';

        if($request->stage_id == 'all') $request['stage_id'] = null;
        else $rules['stage_id'] = 'required|exists:stages,id';

        $request->validate($rules);
        
        Specialty::create($request->all());
        return back()->with('message', 'add success!');
    }

  

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Specialty $specialty)
    {
        $rules = ['name'=>'required|string|max:255'];
        if($request->grade_id == 'all') $request['grade_id'] = null;
        else $rules['grade_id'] = 'required|exists:grades,id';

        if($request->stage_id == 'all') $request['stage_id'] = null;
        else $rules['stage_id'] = 'required|exists:stages,id';
       

        $request->validate($rules);
        $specialty->update($request->all());
        return back()->with('message', 'update success!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Specialty $specialty)
    {
        $specialty->delete();
        return back()->with('message', 'delete success!');
    }

    public function delete_selection(Request $request){
        $request->validate(['specialties_selected'=>'required|array']);
        Specialty::whereIn('id', $request->specialties_selected)->delete();
        return back()->with('message', 'delete selection successfully!');
    }
}
