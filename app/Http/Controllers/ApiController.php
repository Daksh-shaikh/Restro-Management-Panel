<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\City;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Restro;
use App\Models\Recipe;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\Menu;
use App\Models\DeliveryAddress;
use DB;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class ApiController extends Controller
{

    // public function registration(Request $request)
    // {
    //     $insert = User::create([


    //         'name' => $request->name,
    //         'password' => Hash::make($request->password),
    //         'mobnumber' => $request->mobnumber
    //     ]);

    //     if ($insert) {
    //         return response()->json(['status' => true, 'message' => 'Data Submitted Successfully']);
    //     } else {
    //         return response()->json(['status' => false, 'message' => 'Something error occurred']);
    //     }
    // }

    // public function user_check(Request $request)
    // {
    //     $user = User::where('mobilenumber', $request->mobilenumber)->first();

    //     if ($user && Hash::check($request->password, $user->password)) {
    //         return response()->json(['status' => true, 'user' => $user]);
    //     } else {
    //         return response()->json(['status' => false, 'message' => 'User Not Found']);
    //     }
    // }


    // public function user_registration(Request $request)
    // {

    //     $user = User::where('contact', '=', $request->contact)->first(); //check already exist
    //     if (isset($user) && $user != null) {
    //         //   return $user;
    //         return response()->json(['status' => false, 'data' => $user]); //return already exist user
    //     } else {
    //         // dd(1);
    //         //create new user
    //         $insert = User::create([

    //             'contact' => $request->contact,


    //         ]);

    //         return response()->json(['status' => true, 'data' => $insert]);
    //     }
	//  }


    public function user_registration(Request $request)
    {

        $user = User::where('contact', '=', $request->contact)->first(); //check already exist
        if (isset($user) && $user != null) {
            //   return $user;
            return response()->json(['status' => false, 'data' => $user]); //return already exist user
        } else {
            // dd(1);
            //create new user
            $insert = User::create([
				'name' => $request->name,
                'contact' => $request->contact,
                'role'=>'user',

            ]);

            return response()->json(['status' => true, 'data' => $insert]);
        }
	 }



    public function get_user(Request $request)
    {
        $get_user = User::find($request->id);
        if ($get_user) {
            return response()->json(['status' => true, 'data' => $get_user]);
        } else {
            return response()->json(['status' => false, 'message' => 'User not found']);
        }
    }




    public function send_mobile_verify_otp(Request $request)
    {

         $otp = rand(1000, 9999);
        $name = 'Sir/Mam';
       $msg = 'Dear ' . $name . ', Your OTP is ' . $otp . '. Send
           by WEBMEDIA';
        $msg = urlencode($msg);
        $to = $request->contact;
       // $user->mobile;
        //$request->mobile;
        $data1 = "uname=habitm1&pwd=habitm1&senderid=WMEDIA&to=" .
            $to . "&msg=" . $msg .
            "&route=T&peid=1701159196421355379&tempid=1707161527969328476";
        $ch = curl_init('http://bulksms.webmediaindia.com/sendsms?');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);
        return response()->json($otp);

    }


// this updation of data needs to pass path with id

//     public function updateUser(Request $request, $id)
// {
//     $user = User::find($id);

//     if (!$user) {
//         return response()->json(['status' => false, 'message' => 'User not found']);
//     }

//     // Update user data
//     $user->update([
//         'name' => $request->input('name', $user->name),
//         'password' => Hash::make($request->input('password', $user->password)),
//         'contact' => $request->input('contact', $user->contact),
//         'gender' => $request->input('gender', $user->gender),
//         'email' => $request->input('email', $user->email),
//         'address' => $request->input('address', $user->address),
//     ]);

//     return response()->json(['status' => true, 'message' => 'User data updated successfully']);
// }



//updated api dont need to pass id
public function updateUser(Request $request)
    {
        $updateUser = User::where('id', $request->id)->orderby('id', 'desc')->first();
        if ($updateUser) {
            $updateUser->update([
                'name' => $request->name,
				'password' => $request->password,
                'contact' => $request->contact,
                'email' => $request->email,
                'gender' => $request->gender,
                'address' => $request->address,
            ]);
        }
        if ($updateUser->id) {
            return response()->json(['status' => true, 'message' => 'Data Updated Successfully']);
        } else {
            return response()->json(['status' => false, 'message' => 'Something Error Occure At Server']);
        }
    }



public function getCity(Request $request)
{
    $city = new City();
    $data = $city->all();

    return response()->json(['status' => true, 'message' => 'All data retrieved successfully', 'data' => $data], 200);
}

public function getBanner(Request $request)
{
    $banner = new Banner();
    $data = $banner->all();

    return response()->json(['status' => true, 'message' => 'All data retrieved successfully', 'data' => $data], 200);
}

public function getCategory(Request $request)
{
    $category = new Category();
    $data = $category->all();

    return response()->json(['status' => true, 'message' => 'All data retrieved successfully', 'data' => $data], 200);
}



public function get_coupon(Request $request)
{
    $coupon = Coupon::
    where('restaurant_id', $request->restaurant_id)

    // join is used to show category name without this it will only show category id.
    ->join('restro','restro.id','=','coupon.restaurant_id')
    ->select('coupon.*','restro.restaurant')
    ->get();
    if($coupon)
    {
        return response()->json(['status'=>true,'data'=>$coupon]);
    }else{
        return response()->json(['status'=>false,'message'=>'data not found']);
    }
}




public function get_recipe(Request $request)
{
    $recipe = Recipe::
    where('category_id', $request->category_id)

    // join is used to show category name without this it will only show category id.
    ->join('category','category.id','=','recipe.category_id')
    ->select('recipe.*','category.category')
    ->get();
    if($recipe)
    {
        return response()->json(['status'=>true,'data'=>$recipe]);
    }else{
        return response()->json(['status'=>false,'message'=>'data not found']);
    }
}



public function getCart(Request $request)
{
    $added_time_data = Cart::where('user_id', $request->user_id)
        ->where('order_id', null)
        ->get();

    $added_time_ids = $added_time_data->pluck('recipe_id')->toArray();

    $items = Menu::whereIn('id', $added_time_ids)->get();

    foreach ($items as $item) {
        $cardData = $added_time_data->firstWhere('recipe_id', $item->id);

        if ($cardData) {
            $recipe_price = $cardData->quantity * $item->price;
            Cart::where('user_id', $request->user_id)
                ->where('recipe_id', $item->id)
                ->update([
                    'recipe_name' => $item->recipe,
                    'recipe_price' => $recipe_price,
                ]);
        }
    }

    $get_cart = Cart::where('cart.user_id', $request->user_id)
        ->where('order_id', null)
        ->select('cart.order_id', 'cart.recipe_id', 'cart.restro_id', 'cart.coupon_code_id', 'cart.recipe_name', 'cart.recipe_price', 'cart.quantity',  'recipe.recipe', 'restro.restaurant')
        ->leftjoin('restro', 'restro.id', '=', 'cart.restro_id')
        ->leftjoin('recipe', 'recipe.id', '=', 'cart.recipe_id')
       ->groupBy('cart.id', 'cart.order_id', 'cart.recipe_id', 'cart.restro_id', 'cart.coupon_code_id', 'cart.recipe_name', 'cart.recipe_price', 'cart.quantity', 'recipe.recipe', 'restro.restaurant')

		// Include 'recipe_price' in the GROUP BY clause
        ->where('user_id', $request->user_id)
        ->get();

    $grand_total = DB::table('cart')
        ->where('cart.user_id', $request->user_id)
        ->where('order_id', null)
        ->sum('recipe_price');

    if ($get_cart) {
        return response()->json(['status' => true, 'data' => $get_cart, 'grand_total' => $grand_total]);
    } else {
        return response()->json(['status' => false, 'message' => 'data not found']);
    }
}



public function addToCart(Request $request)
{



    // Delete existing records for the user and restaurant combination
    $delete = Cart::where('user_id', $request->user_id)
        ->where('restro_id', $request->restro_id)
        ->where('order_id', null)
        ->delete();

    $item = explode(',', $request->recipe_id);
    $quantity = explode(',', $request->quantity);

    $insert = false;

    for ($i = 0; $i < count($item); $i++) {
        if (isset($request->recipe_id[$i])) {
            $item_details = Menu::where('id', $item[$i])->select('recipe', 'price')->first();

            $insert = Cart::create([
                'user_id' => $request->user_id,
                'restro_id' => $request->restro_id,
                'recipe_id' => $item[$i],
                'recipe_name' => $item_details->recipe,
                'quantity' => $quantity[$i],
                'recipe_price' => $quantity[$i] * $item_details->price, // Corrected column name
                'restro_status' => 'Your order is Pending',
                // 'status'=>'Your order is Pending',
                'verify' => 1
            ]);
        }
    }


    if ($insert) {
        return response()->json(['status' => true, 'message' => 'data has been submitted']);
    } else {
        return response()->json(['status' => false, 'message' => 'data not found']);
    }
}


public function remove_cart(Request $request)
            {
                $remove = cart::where('recipe_id', $request->recipe_id)
                ->where('restro_id', $request->restro_id)
               ->delete();

               if ($remove) {
                   return response()->json(['status' => true, 'message' => 'Data Deleted Successfully']); //array
                } else {
                   return response()->json(['status' => false, 'message' => 'User Not Found']); //array
                }
           }






public function postOrder(Request $request){

	//dd($request->all());
    $insert = Order::create([
        'order_id2' => 'OD'.time(),
        'restro_id' => $request->restro_id,
        'total' => $request->total,
      //  'discount'=>$request->discount,
        'payment_mode'=>$request->payment_mode,
        'address'=>$request->address,
        'delivery_type'=>$request->delivery_type,
       // 'delivery_charges'=>$request->delivery_charges,
       'contact_number'=>$request->contact,
      //  'alternate_number'=>$request->alternate_number,
        //'coupon_code'=>$request->coupon_code,
       // 'assign_delivery'=>$request->assign_delivery,
         // 'user_id'=>$request->user_id,
     //   'approval'=>$request->approval,
        'order_date'=>$request->order_date,
        'status'=> "Your order is Pending", //Just massage to show
        // 'restro_status'=> "Your order is Pending",
        'verify' => 1
    ]);

$insert->user_id = $request->user_id;
$insert->save();

    $cart_update = Cart :: where('user_id',$request->user_id)
    ->where('order_id',null)
    ->update([
        'order_id'=>$insert->id,
    ]);

    if($insert) {
        return response()->json(['status' => true, 'message' => 'data has been submitted']);
    } else {
        return response()->json(['status' => false, 'message' => 'data not found']);
    }
    }


// get order against user id and order id

public function get_order_history(Request $request)
{
   $get_allorder_by_user_id = DB::table('order')
    ->leftjoin('cart', 'cart.order_id', '=', 'order.id')
    ->leftjoin('restro', 'restro.id', '=', 'order.restro_id')
    ->where('order.user_id', $request->user_id)
    ->orwhere('order_id2', $request->order_id)
    ->select('order.id', 'order.total as grand_total','order.created_at', 'order.order_date','order.status','order.order_id2', 'restro.restaurant',
    'restro.address',  'cart.recipe_price', 'cart.recipe_name','cart.quantity')
    ->orderBy('order.id','desc') // Optional: Order the results by order ID
    ->get();


// dd($get_allorder_by_user_id);


// Group the results by order ID
$groupedOrders = $get_allorder_by_user_id->groupBy('id');
// Transform the grouped results
$item_list_against_userid = $groupedOrders->map(function ($orders) {
    return [
        'id' => $orders->first()->id,
        'order_id2' => $orders->first()->order_id2,
        'grand_total' => $orders->first()->grand_total,
        'order_date' => $orders->first()->created_at,
        'recipe_price'=> $orders->first()->recipe_price,
        'restaurant' => $orders->first()->restaurant,
        'address'=> $orders->first()->address,
        'status' => $orders->first()->status,
        'cards' => $orders->map(function ($card) {
            return [
                'recipe_name' => $card->recipe_name,
                'quantity' => $card->quantity,
				'recipe_price'=>$card->recipe_price,
                // 'recipe_price' => $card->recipe_price,
            ];
        })->toArray(),
    ];

})->values()->all();
// dd($get_allorder_by_user_id);
if (!empty($item_list_against_userid)) {
    return response()->json(['status' => true, 'data' => $item_list_against_userid]);
} else {
    return response()->json(['status' => false, 'message' => 'Data not found']);
}
}

public function get_restro(Request $request)
{
    $restro = Restro::
    // where('category_id', $request->category_id)

    // join is used to show category name without this it will only show category id.
    leftjoin('city','city.id','=','restro.city')
    ->leftjoin('category','category.id','=','restro.category')
    ->select('restro.*','category.category', 'city.city')
    ->get();
    if($restro)
    {
        return response()->json(['status'=>true,'data'=>$restro]);
    }else{
        return response()->json(['status'=>false,'message'=>'data not found']);
    }
}



public function get_restro_data(Request $request)
{
    $restro = Restro::
    // where('restro.category', $request->category_id)
    where('restro.city', $request->city_id)
    // join is used to show category name without this it will only show category id.
    ->leftjoin('city','city.id','=','restro.city')
    ->leftjoin('category','category.id','=','restro.category')
    ->select('restro.*','category.category', 'city.city')
    ->get();
    if($restro)
    {
        return response()->json(['status'=>true,'data'=>$restro]);
    }else{
        return response()->json(['status'=>false,'message'=>'data not found']);
    }
}


//----------------------------------------



public function get_restro_new(Request $request)
{
    $restro = Restro::
    where('restro.city', $request->city_id)

    // join is used to show category name without this it will only show category id.
    ->leftjoin('city','city.id','=','restro.city')
    ->leftjoin('category','category.id','=','restro.category')
    ->select('restro.*','category.category', 'city.city')
    ->get();
    if($restro)
    {
        return response()->json(['status'=>true,'data'=>$restro]);
    }else{
        return response()->json(['status'=>false,'message'=>'data not found']);
    }
}

//-----------------------------

public function getMenu(Request $request)
{
    $restaurantId = $request->input('restaurant_id');

    if (!$restaurantId) {
        return response()->json(['status' => false, 'message' => 'Restaurant ID not provided']);
    }

    $menu = Recipe::leftJoin('restro', 'restro.id', '=', 'recipe.restaurant_id')
    ->leftjoin('category','category.id','=','recipe.category_id')
        ->where('recipe.restaurant_id', $restaurantId) // Filter by restaurant_id
        ->select('recipe.*', 'restro.address', 'restro.restaurant', 'category.category')
        ->get();

    if ($menu->isNotEmpty()) {
        return response()->json(['status' => true, 'data' => $menu]);
    } else {
        return response()->json(['status' => false, 'message' => 'Data not found']);
    }
}



public function get_search_restro(Request $request)
{
    $get_restro = Restro::
        // where('city_id', $request->city_id)
        where('restaurant', 'like', '%' . $request->restaurant . '%')
        ->orderByRaw("CASE WHEN restaurant LIKE '{$request->restaurant}%' THEN 0 ELSE 1 END")
        ->orderBy('restaurant')
        ->get();

    if ($get_restro->isNotEmpty()) {
        return response()->json(['status' => true, 'data' => $get_restro]);
    } else {
        return response()->json(['status' => false, 'message' => 'Data not found']);
    }
}


// search menu against recipe alphabetically

public function get_search_menu(Request $request)
{
    $menu = Menu::
    // where('restaurant', 'like', '%' . $request->restaurant . '%')
    where('recipe', 'like', '%' . $request->recipe . '%')
    // where('category_id', $request->category_id)
    ->orderByRaw("CASE WHEN recipe LIKE '{$request->recipe}%' THEN 0 ELSE 1 END")
    ->orderBy('recipe')


    // join is used to show category name without this it will only show category id.
    ->join('restro','restro.id','=','recipe.restaurant_id')
    ->leftjoin('category','category.id','=','recipe.category_id')
    ->select('recipe.*','category.category', 'restro.restaurant')
    ->get();
    if($menu)
    {
        return response()->json(['status'=>true,'data'=>$menu]);
    }else{
        return response()->json(['status'=>false,'message'=>'data not found']);
    }
}


public function restro_login(Request $request)
{
    $user = Restro::where('email', $request->email)->first();
    if ($user && Hash::check($request->password, $user->password)) {
        return response()->json(['status' => true,  'message' => 'User Login Successfully', 'user' => $user,]);
    } else {
        return response()->json(['status' => false, 'message' => 'User Not Found']);
    }
}



public function getRestroOrder(Request $request)
{
    $restaurantId = $request->input('restro_id');

    if (!$restaurantId) {
        return response()->json(['status' => false, 'message' => 'Restaurant ID not provided']);
    }

    $restro_order = Order::leftJoin('cart', 'cart.order_id', '=', 'order.id')
    ->leftjoin('users','users.id','=','order.user_id')
        ->where('order.restro_id', $restaurantId) // Filter by restaurant_id
        ->select('order.id','order.user_id', 'order.total as grand_total', 'order.order_date','order.restro_status',
        'order.order_id2', 'cart.recipe_name', 'cart.recipe_price', 'cart.quantity', 'users.name', 'users.contact')
        ->orderBy('order.id','desc') // Optional: Order the results by order ID
        // 'restro.address', 'restro.restaurant', 'category.category')
        ->get();


// Group the results by order ID
$groupedOrders = $restro_order->groupBy('id');
// Transform the grouped results
$item_list_against_userid = $groupedOrders->map(function ($orders) {
    return [
        'id' => $orders->first()->id,
        'user_id' => $orders->first()->user_id,
         'grand_total' => $orders->first()->grand_total,
        'order_date' => $orders->first()->created_at,
        'status' => $orders->first()->restro_status,
        'order_id2'=> $orders->first()->order_id2,
        'name' => $orders->first()->name,
        'contact' => $orders->first()->contact,
        // 'address'=> $orders->first()->address,

        'cards' => $orders->map(function ($card) {
            return [
                'recipe_name' => $card->recipe_name,
                'quantity' => $card->quantity,
				'recipe_price'=>$card->recipe_price,
                // 'recipe_price' => $card->recipe_price,
            ];
        })->toArray(),
    ];

})->values()->all();
// dd($get_allorder_by_user_id);
if (!empty($item_list_against_userid)) {
    return response()->json(['status' => true, 'data' => $item_list_against_userid]);
} else {
    return response()->json(['status' => false, 'message' => 'Data not found']);
}
}

//------------------------------------

    // if ($order->isNotEmpty()) {
    //     return response()->json(['status' => true, 'data' => $order]);
    // } else {
    //     return response()->json(['status' => false, 'message' => 'Data not found']);
    // }



public function getRestroInfo(Request $request)
{

    $restroID= $request->input('id');
    $restro= Restro::where('id', $restroID)->get();

if($restro->isEmpty()){
    return response()->json(['status'=>false, 'message'=>'data not found']);
}
else{
    return response()->json(['status' => true, 'message' => 'All data retrieved successfully', 'data' => $restro], 200);

}}


//------------------------------------------------

//to accept order

public function accept_order(Request $request)
            {
                $accept_order = Order::where('order_id2', $request->order_id)->first();
                if ($accept_order->id) {
                    $accept_order->update([
                       // 'status'=>$request->status,
						'restro_status'=>'Pending Delivery Boy',
                        'status'=>'In Progress',
                    ]);
                    return response()->json(['status' => true, 'message' => 'Data Updated Successfully']);
                } else {
                    return response()->json(['status' => false, 'message' => 'Something Error Occure At Server']);
                }
            }

// public function accept_order(Request $request)
// {
//     $accept_order = Order::where('order_id2', $request->order_id)->first();

//     if ($accept_order) {
//         $accept_order->update([
//             'restro_status' => 'Pending Delivery Boy',
//             'status' => 'In Progress',
//         ]);

//         return response()->json(['status' => true, 'message' => 'Data Updated Successfully']);
//     } else {
//         return response()->json(['status' => false, 'message' => 'Something Error Occurred At Server']);
//     }
// }


//to cancel order

            public function cancel_order(Request $request){
                $cancel_order = Order::where('order_id2', $request->order_id)->first();
                if ($cancel_order->id) {
                    $cancel_order->update([
                       // 'status'=>$request->status,
                        'status'=>'Order Cancelled',
                        'restro_status'=>'Your Order is Cancelled',
                    ]);
                    return response()->json(['status' => true, 'message' => 'Data Updated Successfully']);
                } else {
                    return response()->json(['status' => false, 'message' => 'Something Error Occure At Server']);
                }
            }




            public function delivery_address(Request $request)
            {

                    $address = DeliveryAddress::create([
                        'user_id' => $request->input('user_id'),
                        'address_type' => $request->input('address_type'),
                        'contact_number' => $request->input('contact_number'),
                        'full_name' => $request->input('full_name'),
                        'landmark' => $request->input('landmark'),
                        'house_number' => $request->input('house_number'),
                        'address' => $request->input('address'),
                    ]);

                        return response()->json(['message' => 'Address added successfully', 'data' => $address], 201);

                    return response()->json(['message' => 'Error adding address', 'error' => $e->getMessage()], 500);
                }




public function get_delivery_address(Request $request)
{
    $delivey_address = DeliveryAddress::where('user_id', $request->user_id)
        // ->select('order.*')
        ->get();
        if($delivey_address)
        {
            return response()->json(['status'=>true,'data'=>$delivey_address]);
        }else{
            return response()->json(['status'=>false,'message'=>'data not found']);
        }


}



//Delivery Boy API




    public function delivery_registration(Request $request)
    {
        $insert = User::create([


            'name' => $request->name,
            'password' => Hash::make($request->password),
            'contact' => $request->contact,
            'address' =>$request->address,
            'email' =>$request->email,
            'role'=>'delivery',
        ]);

        if ($insert) {
            return response()->json(['status' => true, 'message' => 'Data Submitted Successfully']);
        } else {
            return response()->json(['status' => false, 'message' => 'Something error occurred']);
        }
    }

    public function delivery_check(Request $request)
    {
        $user = User::where('contact', $request->contact)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            return response()->json(['status' => true, 'user' => $user]);
        } else {
            return response()->json(['status' => false, 'message' => 'User Not Found']);
        }
    }

    public function get_delivery_boy_info(Request $request)
    {
        $get_delivery_boy_info = User::find($request->id);
        if ($get_delivery_boy_info) {
            return response()->json(['status' => true, 'data' => $get_delivery_boy_info]);
        } else {
            return response()->json(['status' => false, 'message' => 'User not found']);
        }
    }



// show records to delivery boy only if restro_status of order is 'In Progress'


public function get_delivery_order(Request $request)
{
    // Retrieve orders with related carts, delivery address, and restro
    $orders = Order::with(['carts', 'deliveryAddress', 'restro'])
       // ->where('status', 'In Progress')
		 ->where('restro_status', 'Pending Delivery Boy')
		 ->orwhere('restro_status', 'Order Accepted')
		->orwhere('delivery_status', 'Order Cooking')
        ->orwhere('delivery_status', 'Ready for Pickup')


        ->get();

    if ($orders->isNotEmpty()) {
        // Transform the results
        $item_list_against_userid = $orders->map(function ($order) {
            return [
                'id' => $order->id,
                'order_id2' => $order->order_id2,
                'order_date' => $order->order_date,
                'total' => $order->total,
                'payment_mode' => $order->payment_mode,
                'delivery_type' => $order->delivery_type,
                'delivery_charges' => $order->delivery_charges,
                'coupon_code' => $order->coupon_code,
				'status' => $order->delivery_status,
                'item' => $order->carts->map(function ($cart) {
                    return [
                        'recipe_name' => $cart->recipe_name,
                        'quantity' => $cart->quantity,
                        'recipe_price' => $cart->recipe_price,
                    ];
                })->toArray(),
                'pickup_address' => $order->restro->address, // Use the restro address as pickup address
                // 'user_name' => $order->full_name,
                // 'contact_number' => $order->contact_number,
                // 'landmark' => $order->landmark,
                // 'house_number' => $order->house_number,
                // 'address' => $order->address,
                'delivery_address' => [
                    'address_type' => $order->deliveryAddress->address_type,
                    'contact_number' => $order->deliveryAddress->contact_number,
                    'full_name' => $order->deliveryAddress->full_name,
                    'landmark' => $order->deliveryAddress->landmark,
                    'house_number' => $order->deliveryAddress->house_number,
                    'address' => $order->deliveryAddress->address,
                ],
            ];
        });

//---------------------------------------
  // Update the status of orders to 'Pending Delivery Boy'
  //$orderIds = $orders->pluck('id');
  //Order::whereIn('id', $orderIds)->update(['restro_status' => 'Pending Delivery Boy']);

//---------------------------------------


        return response()->json(['status' => true, 'data' => $item_list_against_userid]);
    } else {
        return response()->json(['status' => false, 'message' => 'No orders in progress']);
    }
}


// to accept order

// public function delivery_accept_order(Request $request)
//             {
//                 $accept_order = Order::where('order_id2', $request->order_id)->first();
//                 if ($accept_order->id) {
//                     $accept_order->update([
//                        // 'status'=>$request->status,
// 						'status'=>'In Progress',
//                     ]);
//                     return response()->json(['status' => true, 'message' => 'Data Updated Successfully']);
//                 } else {
//                     return response()->json(['status' => false, 'message' => 'Something Error Occure At Server']);
//                 }
//             }


// Accept order by delivery boy
public function delivery_accept_order(Request $request)
            {
                $accept_delivery_order = Order::where('order_id2', $request->order_id)->first();
                if ($accept_delivery_order->id) {
                    $accept_delivery_order->update([
                       // 'status'=>$request->status,
						'restro_status'=>'Order Accepted',
						 'status' =>'Order Accepted',
						'delivery_status'=>'In Progress',
                    ]);
                    return response()->json(['status' => true, 'message' => 'Data Updated Successfully']);
                } else {
                    return response()->json(['status' => false, 'message' => 'Something Error Occure At Server']);
                }
            }



//to cancel order

            public function delivery_cancel_order(Request $request){
                $cancel_order = Order::where('order_id2', $request->order_id)->first();
                if ($cancel_order->id) {
                    $cancel_order->update([
                       // 'status'=>$request->status,
                        'restro_status'=>'Pending Delivery Boy',
                        'status'=>'Your Order is Pending',
                    ]);
                    return response()->json(['status' => true, 'message' => 'Data Updated Successfully']);
                } else {
                    return response()->json(['status' => false, 'message' => 'Something Error Occure At Server']);
                }
            }


//to Pickup order

public function pickup_delivery_order(Request $request){
    $cancel_order = Order::where('order_id2', $request->order_id)->first();
    if ($cancel_order->id) {
        $cancel_order->update([
           // 'status'=>$request->status,
            'restro_status'=>'Order is Pickup',
            'status'=>'Order is Pickup',
        ]);
        return response()->json(['status' => true, 'message' => 'Data Updated Successfully']);
    } else {
        return response()->json(['status' => false, 'message' => 'Something Error Occure At Server']);
    }
}




//to Deliver order

public function delivered_delivery_order(Request $request){
    $cancel_order = Order::where('order_id2', $request->order_id)->first();
    if ($cancel_order->id) {
        $cancel_order->update([
           // 'status'=>$request->status,
            'restro_status'=>'Order Delivered',
            'status'=>'Order Delivered',
        ]);
        return response()->json(['status' => true, 'message' => 'Data Updated Successfully']);
    } else {
        return response()->json(['status' => false, 'message' => 'Something Error Occure At Server']);
    }
}


// API FOR KITCHEN




public function kitchen_registration(Request $request)
{
    $insert = User::create([
        'name' => $request->name,
        'password' => Hash::make($request->password),
        'contact' => $request->contact,
        // 'address' =>$request->address,
        'email' =>$request->email,
        'restro_id'=>$request->restro_id,
        'role'=>'kitchen',
    ]);

    if ($insert) {
        return response()->json(['status' => true, 'message' => 'Data Submitted Successfully']);
    } else {
        return response()->json(['status' => false, 'message' => 'Something error occurred']);
    }
}

public function get_all_restro(Request $request)
{
    try {
        // Fetch all restaurant names from the "restaurant" field in the "restro" table
        $restaurantNames = Restro::pluck('restaurant');

        // You can return the names as a JSON response
        return response()->json(['restaurant_names' => $restaurantNames], 200);
    } catch (\Exception $e) {
        // Handle any exceptions that may occur during the database query
        return response()->json(['error' => 'Unable to fetch restaurant names.'], 500);
    }

}

public function kitchen_check(Request $request)
{
    $user = User::where('contact', $request->contact)
    ->where('restro_id', $request->restro_id)
    ->get();

    if ($user && Hash::check($request->password, $user->password)) {
        return response()->json(['status' => true, 'user' => $user]);
    } else {
        return response()->json(['status' => false, 'message' => 'User Not Found']);
    }
}


// get kitchen info
public function get_kitchen_info(Request $request)
{
    $get_kitchen_info = User::find($request->id);
    if ($get_kitchen_info) {
        return response()->json(['status' => true, 'data' => $get_kitchen_info]);
    } else {
        return response()->json(['status' => false, 'message' => 'User not found']);
    }
}

// show records to kitchen only if status of order is 'Order Accepted'


public function get_kitchen_order(Request $request)
{
    // Retrieve orders with related carts, delivery address, and restro
    $orders = Order::with(['carts', 'deliveryAddress', 'restro'])
       // ->where('status', 'In Progress')
		// ->where('restro_status', 'Order Accepted')
		// ->orwhere('restro_status', 'Order Cooking')
		->where('delivery_status', 'In Progress')
		->orwhere('delivery_status', 'Order Cooking')

        ->get();

    if ($orders->isNotEmpty()) {
        // Transform the results
        $item_list_against_userid = $orders->map(function ($order) {
            return [
                'id' => $order->id,
                'order_id2' => $order->order_id2,
                'order_date' => $order->order_date,
                'total' => $order->total,
                'payment_mode' => $order->payment_mode,
                'delivery_type' => $order->delivery_type,
                'delivery_charges' => $order->delivery_charges,
                'coupon_code' => $order->coupon_code,
				'status' => $order->delivery_status,
                'item' => $order->carts->map(function ($cart) {
                    return [
                        'recipe_name' => $cart->recipe_name,
                        'quantity' => $cart->quantity,
                        'recipe_price' => $cart->recipe_price,
                    ];
                })->toArray(),
                'pickup_address' => $order->restro->address, // Use the restro address as pickup address
                // 'user_name' => $order->full_name,
                // 'contact_number' => $order->contact_number,
                // 'landmark' => $order->landmark,
                // 'house_number' => $order->house_number,
                // 'address' => $order->address,
                'delivery_address' => [
                    'address_type' => $order->deliveryAddress->address_type,
                    'contact_number' => $order->deliveryAddress->contact_number,
                    'full_name' => $order->deliveryAddress->full_name,
                    'landmark' => $order->deliveryAddress->landmark,
                    'house_number' => $order->deliveryAddress->house_number,
                    'address' => $order->deliveryAddress->address,
                ],
            ];
        });

//---------------------------------------
  // Update the status of orders to 'Pending Delivery Boy'
  //$orderIds = $orders->pluck('id');
  //Order::whereIn('id', $orderIds)->update(['restro_status' => 'Pending Delivery Boy']);

//---------------------------------------


        return response()->json(['status' => true, 'data' => $item_list_against_userid]);
    } else {
        return response()->json(['status' => false, 'message' => 'No orders in progress']);
    }
}



// Accept order by Kitchen
public function kitchen_accept_order(Request $request)
            {
                $accept_kitchen_order = Order::where('order_id2', $request->order_id)->first();
                if ($accept_kitchen_order->id) {
                    $accept_kitchen_order->update([
                       // 'status'=>$request->status,
						'restro_status'=>'Order Cooking',
						 'status' =>'Order Cooking',
                         'delivery_status'=>'Order Cooking',
                    ]);
                    return response()->json(['status' => true, 'message' => 'Data Updated Successfully']);
                } else {
                    return response()->json(['status' => false, 'message' => 'Something Error Occure At Server']);
                }
            }


//to cancel order

            public function kitchen_cancel_order(Request $request){
                $cancel_order = Order::where('order_id2', $request->order_id)->first();
                if ($cancel_order->id) {
                    $cancel_order->update([
                       // 'status'=>$request->status,
                        'restro_status'=>'Pending Delivery Boy',
						'status'=>'Your Order is Pending',
                    ]);
                    return response()->json(['status' => true, 'message' => 'Data Updated Successfully']);
                } else {
                    return response()->json(['status' => false, 'message' => 'Something Error Occure At Server']);
                }
            }


// Complete order by Kitchen
public function kitchen_order_completed(Request $request)
{
    $complete_kitchen_order = Order::where('order_id2', $request->order_id)->first();
    if ($complete_kitchen_order->id) {
        $complete_kitchen_order->update([
           // 'status'=>$request->status,
            'restro_status'=>'Ready for Pickup',
             'delivery_status'=>'Ready for Pickup',
             'kitchen_status'=>'Completed'
        ]);
        return response()->json(['status' => true, 'message' => 'Data Updated Successfully']);
    } else {
        return response()->json(['status' => false, 'message' => 'Something Error Occure At Server']);
    }
}




 }










    // public function registration(Request $request)
    // {
    //     $insert = User::create([


    //         'name' => $request->name,
    //         'password' => Hash::make($request->password),
    //         'mobnumber' => $request->mobnumber
    //     ]);

    //     if ($insert) {
    //         return response()->json(['status' => true, 'message' => 'Data Submitted Successfully']);
    //     } else {
    //         return response()->json(['status' => false, 'message' => 'Something error occurred']);
    //     }
    // }

    // public function user_check(Request $request)
    // {
    //     $user = User::where('mobilenumber', $request->mobilenumber)->first();

    //     if ($user && Hash::check($request->password, $user->password)) {
    //         return response()->json(['status' => true, 'user' => $user]);
    //     } else {
    //         return response()->json(['status' => false, 'message' => 'User Not Found']);
    //     }
    // }


    // public function user_registration(Request $request)
    // {

    //     $user = User::where('contact', '=', $request->contact)->first(); //check already exist
    //     if (isset($user) && $user != null) {
    //         //   return $user;
    //         return response()->json(['status' => false, 'data' => $user]); //return already exist user
    //     } else {
    //         // dd(1);
    //         //create new user
    //         $insert = User::create([

    //             'contact' => $request->contact,


    //         ]);

    //         return response()->json(['status' => true, 'data' => $insert]);
    //     }
	//  }

//-----------------------------------------------------------------------

// get restro details with city name and category name and not their id.
// public function get_restro(Request $request)
// {
//     $restro = Restro::with(['city_name', 'category_name'])->get();

//     if($restro->isNotEmpty()) {
//         // Transform the data to include city and category names
//         $transformedRestro = $restro->map(function ($restroItem) {
//             return [
//                 'id' => $restroItem->id,
//                 'city_name' => optional($restroItem->city_name)->city,
//                 'restaurant' => $restroItem->restaurant,
//                 'latitude' => $restroItem->latitude,
//                 'longitude' => $restroItem->longitude,
//                 'contact_person' => $restroItem->contact_person,
//                 'mobilenumber' => $restroItem->mobilenumber,
//                 'email' => $restroItem->email,
//                 'banner' => $restroItem->banner,
//                 'category_name' => optional($restroItem->category_name)->category,
//                 'food' => $restroItem->food,
//                 'details' => $restroItem->details,
//             ];
//         });

//         return response()->json(['status' => true, 'message' => 'All data retrieved successfully', 'data' => $transformedRestro]);
//     } else {
//         return response()->json(['status' => false, 'message' => 'Data not found']);
//     }
// }


//-----------------------------------------------------------------

//short way
// public function get_restro(Request $request)
// {
//     $restro = Restro::with(['city_name', 'category_name'])->get();

//     return $restro->isNotEmpty()
//         ? response()->json(['status' => true, 'message' => 'All data retrieved successfully', 'data' => $restro])
//         : response()->json(['status' => false, 'message' => 'Data not found']);
// }


//--------------------------------------------------------------------

//get restro data against restro id

// public function getRestro(Request $request)
// {
//     $restro = new Restro();
//     $data = $restro->all();

//     return response()->json(['status' => true, 'message' => 'All data retrieved successfully', 'data' => $data], 200);
// }



//---------------------------------------------------------------------

// get order against user id and order id


// public function getRestroOrder(Request $request)
// {
//     $order = Order::where('restro_id', $request->restro_id)
//     // ->select('order.*')
//     ->get();
//     if($order)
//     {
//         return response()->json(['status'=>true,'data'=>$order]);
//     }else{
//         return response()->json(['status'=>false,'message'=>'data not found']);
//     }
// }



//---------------------------------------------------------------------
// get order against user id and order id


// public function getRestroOrder(Request $request)
// {
//     $order = Order::where('restro_id', $request->restro_id)
//     // ->select('order.*')
//     ->get();
//     if($order)
//     {
//         return response()->json(['status'=>true,'data'=>$order]);
//     }else{
//         return response()->json(['status'=>false,'message'=>'data not found']);
//     }
// }





// -------------------------------------

// get restro details with city name and category name and not their id.
// public function get_restro(Request $request)
// {
//     $restro = Restro::with(['city_name', 'category_name'])->get();

//     if($restro->isNotEmpty()) {
//         // Transform the data to include city and category names
//         $transformedRestro = $restro->map(function ($restroItem) {
//             return [
//                 'id' => $restroItem->id,
//                 'city_name' => optional($restroItem->city_name)->city,
//                 'restaurant' => $restroItem->restaurant,
//                 'latitude' => $restroItem->latitude,
//                 'longitude' => $restroItem->longitude,
//                 'contact_person' => $restroItem->contact_person,
//                 'mobilenumber' => $restroItem->mobilenumber,
//                 'email' => $restroItem->email,
//                 'banner' => $restroItem->banner,
//                 'category_name' => optional($restroItem->category_name)->category,
//                 'food' => $restroItem->food,
//                 'details' => $restroItem->details,
//             ];
//         });

//         return response()->json(['status' => true, 'message' => 'All data retrieved successfully', 'data' => $transformedRestro]);
//     } else {
//         return response()->json(['status' => false, 'message' => 'Data not found']);
//     }
// }

//------------------------------------------------------------------------------------

//short way
// public function get_restro(Request $request)
// {
//     $restro = Restro::with(['city_name', 'category_name'])->get();

//     return $restro->isNotEmpty()
//         ? response()->json(['status' => true, 'message' => 'All data retrieved successfully', 'data' => $restro])
//         : response()->json(['status' => false, 'message' => 'Data not found']);
// }

//-------------------------------------------------------------------------
//get restro data against restro id

// public function getRestro(Request $request)
// {
//     $restro = new Restro();
//     $data = $restro->all();

//     return response()->json(['status' => true, 'message' => 'All data retrieved successfully', 'data' => $data], 200);
// }

//--------------------------------------------------------------------------


//get all recipes
// public function get_recipe(Request $request)
// {
//     $recipe = new Recipe();
//     $data = $recipe->all();

//     return response()->json(['status' => true, 'message' => 'All data retrieved successfully', 'data' => $data], 200);
// }




// public function get_order_status_(Request $request)
// {
//     // try {
//         $status = Order::where('order.status', 'In Progress')
//             ->leftJoin('cart', 'cart.order_id', '=', 'order.id') // Corrected the join condition
//             ->select(
//                 'order.id',
//                 'order.order_id2',
//                 'order.order_date',
//                 'order.total',
//                 'order.payment_mode',
//                 'order.delivery_type',
//                 'order.delivery_charges',
//                 'order.coupon_code',
//                 'cart.recipe_name',
//                 'cart.recipe_price',
//                 'cart.quantity',

//             )
//             ->get();

//         // Group the results by order ID
//         $groupedOrders = $status->groupBy('id');

//         // Transform the grouped results
//         $item_list_against_userid = $groupedOrders->map(function ($orders) {
//             return [
//                 'id' => $orders->first()->id,
//                 'order_id2' => $orders->first()->order_id2,
//                 'order_date' => $orders->first()->order_date,
//                 'total' => $orders->first()->total,
//                 'payment_mode' => $orders->first()->payment_mode,
//                 'delivery_type' => $orders->first()->delivery_type,
//                 'delivery_charges' => $orders->first()->delivery_charges,
//                 'coupon_code' => $orders->first()->coupon_code,

//                 'cards' => $orders->map(function ($card) {
//                     return [
//                         'recipe_name' => $card->recipe_name,
//                         'quantity' => $card->quantity,
//                         'recipe_price'=>$card->recipe_price,
//                         // 'recipe_price' => $card->recipe_price,
//                     ];
//                 })->toArray(),
//             ];

//         })->values()->all();

//         if (!empty($item_list_against_userid)) {
//             return response()->json(['status' => true, 'data' => $item_list_against_userid]);
//         } else {
//             return response()->json(['status' => false, 'message' => 'No orders in progress']);
//         }
//     // } catch (\Exception $e) {
//     //     return response()->json(['status' => false, 'message' => 'Something went wrong at the server']);
//     // }
// }

