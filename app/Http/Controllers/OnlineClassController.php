<?php

namespace App\Http\Controllers;

use App\Models\OnlineClass;
use App\Models\Specialty;
use App\Models\Stage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Jubaer\Zoom\Facades\Zoom;

class OnlineClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
       // return Zoom::getAllMeeting();
        if($request->classroom_id)  $onlineClasses = OnlineClass::where('classroom_id',$request->classroom_id)->get();
        elseif($request->grade_id) $onlineClasses = OnlineClass::where('grade_id',$request->grade_id)->get();
        else $onlineClasses = OnlineClass::all();
        
        $stages = Stage::all();
      //  dd($onlineClasses);
        return view('onlineClass.index',compact('onlineClasses','stages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $stages = Stage::all();
        $Specilaties = Specialty::all();
        return view('onlineClass.create',compact('stages','Specilaties'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
       $request->validate([
            'name' => 'required',
            'title' => 'required',
            'duration' => 'required|numeric',
            'grade_id' => 'required',
            'classroom_id' => 'required',
            'specialty_id' => 'required',
            'start_at' => 'required|date_format:Y-m-d\TH:i',
        ]);
        $meeting = Zoom::createMeeting([
            "agenda" => $request->name,
            "topic" => $request->title,
            "type" => 2, // 1 => instant, 2 => scheduled, 3 => recurring with no fixed time, 8 => recurring with fixed time
            "duration" => $request->duration, // in minutes
            "timezone" => 'Africa/Cairo', // set your timezone
            "start_time" => $request->start_at, // set your start time
            "settings" => [
                'join_before_host' => false, // if you want to join before host set true otherwise set false
                'host_video' => false, // if you want to start video when host join set true otherwise set false
                'participant_video' => false, // if you want to start video when participants join set true otherwise set false
                'mute_upon_entry' => false, // if you want to mute participants when they join the meeting set true otherwise set false
                'waiting_room' => false, // if you want to use waiting room for participants set true otherwise set false
                'audio' => 'both', // values are 'both', 'telephony', 'voip'. default is both.
                'auto_recording' => 'none', // values are 'none', 'local', 'cloud'. default is none.
                'approval_type' => 0, // 0 => Automatically Approve, 1 => Manually Approve, 2 => No Registration Required
            ],

        ]);
        if ($meeting['status'] == true) {
            OnlineClass::create([
                'name' => $request->name,
                'title' => $request->title,
                'meeting_zoom_id' => $meeting['data']['id'],
                'duration' => $request->duration,
                'start_at' => $request->start_at,
                'start_url' => $meeting['data']['start_url'],
                'join_url' => $meeting['data']['join_url'],
                'grade_id' => $request->grade_id == 'all' ? null : $request->grade_id,
                'classroom_id' => $request->classroom_id == 'all' ? null : $request->classroom_id,
                'specialty_id' => $request->specialty_id == 'global' ? null : $request->specialty_id,
                
                // redit this
                'created_by' =>isset(Auth::guard('admin')->user()->id)? Auth::guard('admin')->user()->id: Auth::user()->id,

            ]);            
        }
        else return back()->withErrors(['error_zoom' => 'Error when Updating  zoom']);
        return redirect()->route('onlineClass.index')->with('message', 'Online Class Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(OnlineClass $onlineClass)
    {
        return view('onlineClass.show',compact('onlineClass'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OnlineClass $onlineClass)
    {
        $stages = Stage::all();
        $Specilaties = Specialty::all();
        return view('onlineClass.edit',compact('onlineClass','stages','Specilaties'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OnlineClass $onlineClass)
    {
        $request->validate([
            'name' => 'required',
            'title' => 'required',
            'duration' => 'required|numeric',
            'grade_id' => 'required',
            'classroom_id' => 'required',
            'specialty_id' => 'required',
            'start_at' => 'required|date_format:Y-m-d\TH:i',
        ]);
        $meeting= Zoom::rescheduleMeeting($onlineClass->meeting_zoom_id, [
            "agenda" => $request->name,
            "topic" => $request->title,
            "type" => 2, 
            "duration" => $request->duration, 
            "start_time" => $request->start_at,
        ]);
        if($meeting['status'] == true){
            $onlineClass->update([
                'name' => $request->name,
                'title' => $request->title,
                'duration' => $request->duration,
                'start_at' => $request->start_at,                
                'grade_id' => $request->grade_id == 'all' ? null : $request->grade_id,
                'classroom_id' => $request->classroom_id == 'all' ? null : $request->classroom_id,
                'specialty_id' => $request->specialty_id == 'global' ? null : $request->specialty_id,
            ]);            
        }
        else   return back()->withErrors(['error_zoom' => 'Error when Updating  zoom']);

        return back()->with('message', 'Online Class Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OnlineClass $onlineClass)
    {
        Zoom::deleteMeeting($onlineClass->meeting_zoom_id);
        $onlineClass->delete();
        return redirect()->route('onlineClass.index')->with('message', 'Online Class Deleted Successfully');
    }

    public function deleteALL(){
        $meetings = Zoom::getAllMeeting()['data']['meetings'];
        foreach ($meetings as $meeting) {
            Zoom::deleteMeeting($meeting['id']);
        }
        return redirect()->route('onlineClass.index')->with('message', 'Online Classes Deleted Successfully');
    }
}
