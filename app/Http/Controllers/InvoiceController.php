<?php

namespace App\Http\Controllers;

use App\Models\Fee;
use App\Models\Invoice;
use App\Models\Student;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->search){
            $search= $request->search;
            $invoices=Invoice::where('id', $search)
            ->orWhereHas('student',function($query)use ($search){
                $query->where('name','like','%'.$search.'%');
            })->paginate();
        }
        else $invoices=Invoice::paginate(50);
        return view('admin.invoices.index', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $student=Student::findOrFail($request->id); //(['id','name'])
        $fees=Fee::where('year',2024)
        ->where(function($query)use($student){
            $query->where('grade_id',$student->classroom->grade_id)
            ->orWhere(function($subQuery)use($student){
             $subQuery->where('stage_id',$student->classroom->grade->stage_id)
             ->whereNull('grade_id');
            })
            ->orWhere(function($subQuery)use($student){
                $subQuery->whereNull('stage_id')->whereNull('grade_id');
            });
        })->get();
        return view('admin.invoices.create',compact('student','fees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'student_id'=>'required|exists:students,id',
            'fees'=> 'required|array',
            'fees.*' => 'exists:fees,id',
            'costs' => 'required|array',
            'notes' => 'array',
        ]);

        $notes = implode(' ', array_filter($request->notes));
        $invoice= Invoice::create([
            'student_id'=>$request->student_id,
            'amount'=>array_sum($request->costs),
            'notes'=>$notes,
        ]);
       
        foreach ($request->fees as $index => $feeId) {
            $invoice->fees()->attach($feeId, [
                'notes' => $request->notes[$index] ?? null 
            ]);
        }
        return back()->with('message', 'Invoice created successfully');
}

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
         
        $student=Student::find($invoice->student_id);
        return view('admin.invoices.show', compact('invoice', 'student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice)
    {             
        $student = Student::findOrFail($invoice->student_id); 
        $fees = Fee::where('year', 2024)
        ->where(function ($query) use ($student) {
            $query->where('grade_id', $student->classroom->grade_id)
                ->orWhere(function ($subQuery) use ($student) {
                    $subQuery->where('stage_id', $student->classroom->grade->stage_id)
                        ->whereNull('grade_id');
                })
                ->orWhere(function ($subQuery) use ($student) {
                    $subQuery->whereNull('stage_id')->whereNull('grade_id');
                });
        })->get();
        return view('admin.invoices.edit', compact('invoice', 'fees', 'student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Invoice $invoice)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'fees' => 'required|array',
            'fees.*' => 'exists:fees,id',
            'costs' => 'required|array',
            'notes' => 'array',
        ]);

        $notes = implode(' ', array_filter($request->notes));
        $invoice->update([
            'student_id' => $request->student_id,
            'amount' => array_sum($request->costs),
            'notes' => $notes,
        ]);
        $feeData = [];
        foreach ($request->fees as $index => $feeId) {
            $feeData[$feeId] = ['notes' => $request->notes[$index] ?? null];
        }
        $invoice->fees()->sync($feeData);
        return back()->with('message', 'Invoice updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        $invoice->delete();
        return back()->with('message', 'Invoice deleted successfully');
    }

    public function delelte_selection(Request $request) {
        $request->validate(['invoices_selected'=>'required|array']);
        Invoice::whereIn('id', $request->invoices_selected)->delete();
        return back()->with('message', 'Invoices selection deleted successfully');

    }
    
}
