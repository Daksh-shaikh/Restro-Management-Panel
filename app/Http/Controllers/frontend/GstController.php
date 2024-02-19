<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gst;

class GstController extends Controller
{
    public function index(){
        $gst=Gst::all();
        return view('frontend.GST', ['gst', $gst]);
    }



    public function gstStore(Request $request)
    {

        //    dd($request->all());
           $data=$request->validate([
            'cgst'=>'required',
            'sgst'=>'required',

        ]);

        $gst = Gst::create($data);


        return redirect(route('gstIndex'))->with('success', 'GST added successfully');

    }

}
