<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Specialty;
use App\Models\Stage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class Distribute_Specilties extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $specialties = [];
        $classroom=null;
        if ($request->all()) {
            $request->validate([
                'classroom_id' => 'required|exists:classrooms,id',
            ]);
            $classroom = Classroom::findOrFail($request->classroom_id);
            $specialties=$classroom->specialties;
        }
        $stages = Stage::all();

        return view('admin.specialties.distribute', compact('specialties', 'stages','classroom'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $specialties = [];
        if ($request->all()) {
            $request->validate([
                'classroom_id' => 'required|exists:classrooms,id',
            ]);
            $classroom = Classroom::findOrFail($request->classroom_id);
            $specialties = Specialty::where('grade_id', $classroom->grade_id)
                ->orWhereNull('grade_id')->get();
        }
        $stages = Stage::all();

        return view('admin.specialties.createDistribute', compact('specialties', 'stages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    private function saveOrUpdate($request){
        $request->validate([
            'classroom_id' => 'required',
            'specialties_id' => 'required|array',
            'teachers_id' => 'required|array',
        ]);
        if (count($request->specialties_id) != count($request->teachers_id))
            return back()->withErrors(['count_mismatch' => 'There are teachers not selected']);

        $classroom = Classroom::find($request->classroom_id);
        $attachData = [];
        foreach ($request->specialties_id as $index => $specialtyId) {
            $attachData[$specialtyId] = [
                'teacher_id' => $request->teachers_id[$index],
            ];
        }
        $classroom->specialties()->sync($attachData);
        
    }


    public function store(Request $request)
    {
        $this->saveOrUpdate($request);
        return redirect()->route('distribute.specialties.index',['classroom_id'=>$request->classroom_id])
        ->with('message', 'Specialties distributed successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $specialties = [];
        $classroom=null;
        if ($request->all()) {
            $request->validate([
                'classroom_id' => 'required|exists:classrooms,id',
            ]);
            $classroom = Classroom::findOrFail($request->classroom_id);
            $specialties = $classroom->specialties;
        }
        $stages = Stage::all();
        return view('admin.specialties.editDistribute',compact('specialties','stages','classroom'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->saveOrUpdate($request);
        return redirect()->route('distribute.specialties.index', ['classroom_id' => $request->classroom_id])
        ->with('message', 'Specialties distributed updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $classroom = Classroom::findOrFail($id);
        $classroom->specialties()->detach();
        return back()->with('message', 'Specialties distributed deleted successfully');
    }
}
