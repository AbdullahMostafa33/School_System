<?php

namespace App\Http\Controllers;

use App\Models\Stage;
use Illuminate\Http\Request;

class StageController extends Controller
{
    
    public function index()
    {
        $stages=Stage::all();
        return view('admin.stage',compact('stages'));
    }

    
    public function store(Request $request)
    {
        $validate=$request->validate([
           'name'=>'required',
        ]);

        Stage::create($request->all());

        return back()->with('message', " added  successful!");
        }

   

    public function update(Request $request, string $id)
    {
        $validate = $request->validate([
            'name' => 'required',
        ]);
        $stage = Stage::findOrFail($id);
        $stage->name=$request->name;
        $stage->notice = $request->notice;
        $stage->save();
        return back()->with('message', ' update  successful!');
    }

    public function destroy($id)
    {

        $stage=Stage::findOrFail($id);
        $stage->delete();
        return back()->with('message', 'تم الحذف');
    }
}
