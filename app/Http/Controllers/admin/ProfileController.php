<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\View;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Restro;
use App\Models\City;
use App\Models\Days;
use App\Models\TimeSlot;
use App\Models\Category;

class ProfileController extends Controller
{

// public function showProfile($id)
// {
//     $restro = Restro::where('email', $email)->firstOrFail();
//     $days = Days::all(); // You may need to retrieve the days differently based on your logic
//     $timeSlots = TimeSlot::where('restro_id', $restro->id)->get();

//     return view('admin.profile',  [
//         'restro' => $restro,
//         'days' => $days,
//         'timeSlots' => $timeSlots,
//     ]);
// }

public function showProfile($id)
{

    // $restro = Restro::findOrFail($id);
    $restro = Restro::with('city_name')->findOrFail($id);
    $days = Days::all();
    $timeSlots = TimeSlot::where('restro_id', $restro->id)->get()->keyBy('days_id')->toArray();

    // Dump and inspect the $timeSlots array
    // dd($timeSlots);


    return view('admin.profile', [
        'restro' => $restro,
        'days' => $days,
        'timeSlots' => $timeSlots,
    ]);

}

// use Illuminate\Http\Request;

public function updateProfile(Request $request, $id)
{
    // Validate the form data
    $request->validate([
        'city' => 'required|string',
        'restaurant' => 'required|string',
        'address' => 'required|string',
        'latitude' => 'required',
        'longitude' => 'required',
        'contact_person' => 'required|string',
        'mobilenumber' => 'required|string',
        'email' => 'required|email',
        'password' => 'nullable|min:6', // Add any password validation rules
        'avg_cooking_time' => 'required|string',
        'banner' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'food' => 'nullable|array', // Add any validation rules for food checkbox
        'details' => 'required|string',
        // Add any validation rules for other fields
    ]);

    // Update the restaurant data
    $restro = Restro::findOrFail($id);
    $restro->city = $request->input('city');
    $restro->restaurant = $request->input('restaurant');
    $restro->address = $request->input('address');
    $restro->latitude = $request->input('latitude');
    $restro->longitude = $request->input('longitude');
    $restro->contact_person = $request->input('contact_person');
    $restro->mobilenumber = $request->input('mobilenumber');
    $restro->email = $request->input('email');

    // Check if a new password is provided
    if ($request->has('password')) {
        $restro->password = bcrypt($request->input('password'));
    }

    $restro->avg_cooking_time = $request->input('avg_cooking_time');

    // Handle banner upload if a new file is provided
    if ($request->hasFile('banner')) {
        $bannerPath = $request->file('banner')->store('banners', 'public');
        $restro->banner = $bannerPath;
    }

    $restro->food = implode(',', $request->input('food', [])); // Convert array to comma-separated string
    $restro->details = $request->input('details');

    // Save the changes
    $restro->save();

    // Update the time slots
    foreach ($request->input('days', []) as $dayId) {
        $isClosed = $request->has("is_close_$dayId");
        $openAt = $isClosed ? null : $request->input("open_at_$dayId");
        $closeAt = $isClosed ? null : $request->input("close_at_$dayId");

        // Find or create the time slot for the day
        $timeSlot = TimeSlot::updateOrCreate(
            ['restro_id' => $restro->id, 'days_id' => $dayId],
            ['is_close' => $isClosed, 'open_at' => $openAt, 'close_at' => $closeAt]
        );
    }

    return redirect()->route('showProfile', ['id' => $restro->id])->with('success', 'Profile updated successfully');
}

}
