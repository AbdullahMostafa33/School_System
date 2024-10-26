<?php

namespace App\Http\Controllers;

use App\Models\Fee;
use App\Models\Stage;
use Illuminate\Http\Request;

class FeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->search) $fees=Fee::where('name','like','%'. $request->search.'%')->get();
        elseif ($request->year_filter) $fees = Fee::where('year', $request->year_filter)->get();
        else $fees=Fee::all();
        return view('admin.fees.index',compact('fees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $stages=Stage::all();
        return view('admin.fees.create',compact('stages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules= [
            'name' => 'required',
            'cost' => 'required|numeric',
            'year' => 'required|numeric',
            'stage_id' => 'required|exists:stages,id',
            'grade_id' => 'required|exists:grades,id',
        ];
        if($request->stage_id=='all') {
            $request['stage_id']=null;
            $rules['stage_id']='nullable';
        }
        if ($request->grade_id == 'all') {
            $request['grade_id'] = null;
            $rules['grade_id'] = 'nullable';
        }
        $request->validate($rules);
        Fee::create($request->all());
        return back()->with('message','add success!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Fee $fee)
    {
        return view('admin.fees.show',compact('fee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Fee $fee)
    {
        $stages = Stage::all();
        return view('admin.fees.edit', compact('fee', 'stages'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Fee $fee)
    {
        $rules = [
            'name' => 'required',
            'cost' => 'required|numeric',
            'year' => 'required|numeric',
            'stage_id' => 'required|exists:stages,id',
            'grade_id' => 'required|exists:grades,id',
        ];
        if ($request->stage_id == 'all') {
            $request['stage_id'] = null;
            $rules['stage_id'] = 'nullable';
        }
        if ($request->grade_id == 'all') {
            $request['grade_id'] = null;
            $rules['grade_id'] = 'nullable';
        }
        $request->validate($rules);
        $fee->update($request->all());
        return back()->with('message', 'update success!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fee $fee)
    {
        $fee->delete();
        return back()->with('message', 'delete success!');
    }

    public function delelte_selection(Request $request){
        $request->validate(['fees_selected'=>'required|array']);
        Fee::whereIn('id',$request->fees_selected)->delete();
        return back()->with('message', 'delete selection success!');
    }
}
