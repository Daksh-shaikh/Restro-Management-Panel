<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LeaveDate;

class LeaveDateController extends Controller
{
    public function index(){
        $date = LeaveDate::all();
        return view('admin.leave-date', ['date'=>$date]);
    }

    public function dateStore(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'start_date' => 'required',
            'end_date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            // Add other validation rules as needed
        ]);

        $event = new LeaveDate;
        $event->start_date = $request->start_date;
        $event->end_date = $request->end_date;
        $event->start_time = $request->start_time;
        $event->end_time = $request->end_time;


       // $event->event_video = $videoName;
        $event->save();
        return redirect()->route('leave_date')->with('success', 'Field Added successfully.');
    }

    public function leaveDateDestroy($id){
        $date = LeaveDate::find($id);

        if ($date) {
            $date->delete();
            return redirect(route('leave_date'))->with('success', 'Field Deleted Successfully');
        } else {
            return redirect(route('leave_date'))->with('error', 'Field not found');
        }
    }


    public function leaveDateEdit($id){
        $leaveDateEdit = LeaveDate::find($id);
        $leaveDate = LeaveDate::all();
        return view('admin.leave-date_edit', ['leaveDateEdit'=>$leaveDateEdit, 'leaveDate'=>$leaveDate]);
    }


    public function categoryUpdate(Request $request)
    {

        $request->validate([
            'start_date' => 'required',
            'end_date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        LeaveDate::where('id',$request->id)->update([
            'start_date'=>$request->start_date,
            'end_date'=>$request->end_date,
            'start_time'=>$request->start_time,
            'end_time'=>$request->end_time,

            ]
        );
        return redirect(route('leave_date'))->with(['success'=>'Successfully Updated !']);
        // return redirect(route('city'))->with(['success' => 'Successfully Updated !']);
    }

}
