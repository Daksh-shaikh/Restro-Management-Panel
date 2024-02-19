<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupon;
use App\Models\Restro;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class CouponController extends Controller
{
    public function index(){
        $coupon=Coupon::all();
        $restro = Restro::all();

        return view('frontend.coupon',['coupon'=> $coupon,'restro'=> $restro]);
        // return view('frontend.coupon', ['coupon'=> $coupon]);
    }

    public function couponStore(Request $request)
    {
        // dd($request->all());
        $request->validate([

            'restaurant' => 'required',
            'code' => 'required',
            'start_from' => 'required',
            'upto' => 'required',
            'value' => 'required',
        ]);

    //     $file = $request->file('banner');
    //     $filename = time() . '.' . $file->getClientOriginalExtension();
    //     $file->move(public_path('banner/'), $filename);

        $data = [

            'restaurant_id' => $request->input('restaurant'),
            'code' => $request->input('code'),
            'dstype' => $request->input('dstype'),
            'value' => $request->input('value'),
            'start_from' => $request->input('start_from'),
            'upto' => $request->input('upto'),
            'min_cost' => $request->input('min_cost'),
        ];

        $coupon = Coupon::create($data);

        return redirect(route('couponIndex'))->with('success', 'Field Added Successfully');
    }

    public function couponDestroy($id){
        $coupon = Coupon::find($id);

        if ($coupon) {
            $coupon->delete();
            return redirect(route('couponIndex'))->with('success', 'Field Deleted Successfully');
        } else {
            return redirect(route('couponIndex'))->with('error', 'Field not found');
        }
    }

    public function couponEdit($id){
        $couponEdit= Coupon::find($id);
        $coupon = Coupon::all();
        $restro = Restro::all();
        return view('frontend.coupon_edit', ['couponEdit'=>$couponEdit, 'coupon'=>$coupon, 'restro'=>$restro]);
    }

    public function couponUpdate(Request $request)
    {
        // Validation rules
        $rules = [
            'restaurant' => 'required',
            'code' => 'required',
            'start_from' => 'required|date',
            'upto' => 'required|date',
        ];

        // Custom error messages
       //  $messages = [
       //      'contactNo.digits' => 'The contact number must be exactly 10 digits.',
       //      'contactNo.max' => 'The contact number must not exceed 10 digits.',
       //  ];

        // Validate the request
        $validator = Validator::make($request->all(), $rules);

        // Check for validation errors
        if ($validator->fails()) {
            return redirect()->route('couponIndex') // Replace 'your.form.route' with the actual route name
                ->withErrors($validator)
                ->withInput();
        }

        Coupon::where('id',$request->id)->update([
            'restaurant_id'=>$request->restaurant,
            'code'=>$request->code,
            'dstype'=>$request->dstype,
            'value'=>$request->value,
            'start_from'=>$request->start_from,
            'upto'=>$request->upto,
            'min_cost'=>$request->min_cost,

            ]
        );


        return redirect(route('couponIndex'))->with('success','Successfully Updated !');
        // return redirect(route('couponIndex'))->with('success', 'Field Added Successfully');
    }



// to update status active or inactive

public function update_coupon_status($id){

    //get product status with the help of product ID
    $product = DB::table('coupon')
    ->select('status')
    ->where('id', '=', $id)
    ->first();

    //check user status

    if($product->status=='1'){
        $status='0';

    }else{
        $status='1';
    }

    //Update product status
   $values = array('status'=>$status);
   DB::table('coupon')->where('id', $id)->update($values);

   session()->flash('msg', 'Menu status has been updated successfully.');
   return redirect('couponIndex');
}



}
