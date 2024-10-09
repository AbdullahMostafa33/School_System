<?php

namespace App\Http\Controllers;

use App\Models\Statge;
use Illuminate\Http\Request;

class StatgeController extends Controller
{
    
    public function index()
    {
        $statges=Statge::all();
        return view('admin.statge',compact('statges'));
    }

    
    public function store(Request $request)
    {
        $validate=$request->validate([
           'name'=>'required',
        ]);

        Statge::create($request->all());

        return back()->with('message', " added  successful!");
        }

   

    public function update(Request $request, string $id)
    {
        $validate = $request->validate([
            'name' => 'required',
        ]);
        $statge = Statge::findOrFail($id);
        $statge->name=$request->name;
        $statge->notice = $request->notice;
        $statge->save();
        return back()->with('message', ' update  successful!');
    }

    public function destroy($id)
    {

        $statge=Statge::findOrFail($id);
        $statge->delete();
        return back()->with('message', 'تم الحذف');
    }
}
