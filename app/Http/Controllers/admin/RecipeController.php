<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\Category;
use Illuminate\Support\Facades\DB;


class RecipeController extends Controller
{
    public function index(){
        // $recipe = Recipe::all();
        // return view('admin.add-recipe', ['recipe'=>$recipe]);

        $recipes = Recipe::all();
        $category = Category::all();
return view('admin.add-recipe', ['recipes'=>$recipes, 'category'=>$category]);

    }

    public function recipeStore(Request $request)
    {

        //    dd($request->all());
            $request->validate([
            'category'=>'required',
            'recipe'=>'required',
            'price'=>'nullable',
            'image'=>'nullable',
            'description'=>'required',

        ]);
        // $file = $request->file('banner');
        // $filename = time() . '.' . $file->getClientOriginalExtension();
        // $file->move(public_path('banner/'), $filename);

        $filename = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('recipe/'), $filename);
        }

        // $food = implode(',', $request->input('food'));

        // to allow food nullable
        // $food = $request->input('food');
        // if ($food !== null && is_array($food)) {
        //     $food = implode(',', $food);
        // }

        // Fetch restaurant_id and city_id from the authenticated user
        $restaurant_id = auth()->user()->restro_id; // Assuming 'restro_id' is the foreign key in the User model
        $city_id = auth()->user()->restro->city;


        $data = [
            'image' => $filename,
            'category_id' => $request->input('category'),
            'restaurant_id' => $restaurant_id,
            'city_id' => $city_id,
            'recipe' => $request->input('recipe'),
            'price' => $request->input('price'),
            'description' => $request->input('description'),

        ];

        $recipe = Recipe::create($data);


        return redirect(route('add_recipe'))->with('success', 'Field Added Successfully');
    }

    public function recipeDestroy($id){
        $recipe = Recipe::find($id);

        if ($recipe) {
            $recipe->delete();
            return redirect(route('add_recipe'))->with('success', 'Field Deleted Successfully');
        } else {
            return redirect(route('add_recipe'))->with('error', 'Field not found');
        }
    }


    public function recipeEdit($id, Request $request){

        // dd($request->all());

        $recipeEdit= Recipe::find($id);
        $recipeAll  = Recipe::all();

        $category = Category::all();


        return view('admin.add-recipe_edit', ['recipeEdit'=>$recipeEdit, 'recipeAll'=>$recipeAll, 'category'=>$category]);
    }


public function recipeUpdate(Request $request)
{

    // dd($request->all());
    // Validation rules
    // $rules = [
    //     'restaurant' => 'required|regex:/^[\pL\s\-]+$/u|max:255|unique:users,name',
    //     'code' => 'required',
    //     'start_from' => 'required|date',
    //     'upto' => 'required|date',
    // ];

    $request->validate([
        'category'=>'required',
        'recipe'=>'required',
        'price'=>'nullable',
        'image'=>'nullable',
        'description'=>'required',

    ]);
    // Custom error messages
   //  $messages = [
   //      'contactNo.digits' => 'The contact number must be exactly 10 digits.',
   //      'contactNo.max' => 'The contact number must not exceed 10 digits.',
   //  ];

    // Validate the request
    // $validator = Validator::make($request->all(), $rules);

    // Check for validation errors
    // if ($validator->fails()) {
    //     return redirect()->route('restroIndex') // Replace 'your.form.route' with the actual route name
    //         ->withErrors($validator)
    //         ->withInput();
    // }

    $filename = null;

    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('recipe/'), $filename);
     }

    Recipe::where('id',$request->id)->update([
        'category_id'=>$request->category,
        'recipe'=>$request->recipe,
        'price'=>$request->price,
        'description'=>$request->description,
        'image'=>$filename,
        ]
    );


    return redirect(route('add_recipe'))->with('success','Successfully Updated !');
}


// to update status active or inactive

public function update_recipe_status($id){

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

   session()->flash('msg', 'Recipe status has been updated successfully.');
   return redirect('add_recipe');
}


}
