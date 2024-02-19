<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Restro;
use App\Models\Category;
use App\Models\City;

use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    public function index(){
    $menu = Menu::all();
    $restro = Restro::all();
    $category = Category::all();
    $city = City::all();

    return view('frontend.menu', ['menu'=> $menu, 'restro'=>$restro, 'category'=>$category, 'city'=>$city]);
    }

    public function menuStore(Request $request)
    {

        //    dd($request->all());
            $request->validate([
            'city'=>'required',
            'restaurant'=>'nullable',
            'category'=>'required',
            'recipe'=>'required',
            'price'=>'nullable',
            'food'=>'nullable|array',
            'image'=>'nullable',
            // 'description'=>'required',

        ]);


        $filename = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('recipe/'), $filename);
        }

        // to allow food nullable
        $food = $request->input('food');
        if ($food !== null && is_array($food)) {
            $food = implode(',', $food);
        }



        $data = [
            'image' => $filename,
            'city_id'=>$request->input('city'),
            'restaurant_id' => $request->input('restaurant'),
            'category_id' => $request->input('category'),
            'recipe' => $request->input('recipe'),
            'price' => $request->input('price'),
            'description' => $request->input('description'),
            'food' => $food,

        ];

        $menu = Menu::create($data);


        return redirect(route('menuIndex'))->with('success','Menu added successfully');
    }

    public function menuDestroy($id){
        $menu = Menu::find($id);

        if ($menu) {
            $menu->delete();
            return redirect(route('menuIndex'))->with('success', 'Field Deleted Successfully');
        } else {
            return redirect(route('menuIndex'))->with('error', 'Field not found');
        }
    }


    public function menuEdit($id, Request $request){

        // dd($request->all());

        $menuEdit= Menu::find($id);
        $menuAll  = Menu::all();
        $restro = Restro::all();
        $category = Category::all();
        $city = City::all();

        // $category = Category::all();

        $decodedFood = json_decode($menuEdit->food, true);

        return view('frontend.menuEdit', [
            'menuEdit' => $menuEdit,
            'menuAll' => $menuAll,
            'restro' => $restro,
            'category' => $category,
            'city'=>$city,
            'decodedFood' => $decodedFood, // Pass the decoded food array to the view


        // return view('frontend.menuEdit', ['menuEdit'=>$menuEdit, 'menuAll'=>$menuAll, 'restro'=>$restro, 'category'=>$category]);
    ]);
}

    public function menuUpdate(Request $request){

        $request->validate([
            'restaurant' => 'required',
            'city' => 'required',
            'category' => 'required',
            'recipe' => 'required',
            'price' => 'required',
            // 'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        // Find the existing menu item
        $menu = Menu::find($request->id);

        $filename = null;
        if ($request->hasFile('image')){
            $file = $request -> file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('recipe/'), $filename);

            $menu->image = $filename;
        }


Menu::where('id', $request->id)->update([
    'restaurant_id'=>$request->restaurant,
    'city_id' =>$request->city,
    'category_id'=>$request->category,
    'recipe'=>$request->recipe,
    'price'=>$request->price,
    'food'=>$request->food,
    'image'=>$filename,
    'description'=>$request->description,
]);

return redirect(route('menuIndex'))->with('success','successfully updated !');
    }




// to fetch restaurant based on city
public function getRestaurants($cityId): JsonResponse
{
    $restaurants = Restro::where('city', $cityId)->get(['id', 'restaurant']);
    return response()->json($restaurants);
}



// to update status active or inactive

public function update_menu_status($id){

    //get product status with the help of product ID
    $product = DB::table('recipe')
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
   DB::table('recipe')->where('id', $id)->update($values);

   session()->flash('msg', 'Menu status has been updated successfully.');
   return redirect('menu');
}


}


