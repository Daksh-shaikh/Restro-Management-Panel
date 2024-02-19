<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\AdminLogin;
use App\Models\User;

// use Illuminate\Support\Facades\Auth;


class AdminLoginController extends Controller
{
    public function index(){
    return view('login');
}

public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    // dd($request->all());

    if (Auth::attempt($credentials)) {
        // Authentication passed...

        $user = Auth::user();
        $role = $user->role;

        // dd($role);

        if ($role == 'admin') {
            // Admin user
            return view('admin.dashboard');
        } elseif ($role == 'superadmin') {
            // Regular user
            return view('frontend.dashboard');
        }
    } else {
        // Incorrect username or password, show an error message.
        return view('login')->with(['error' => 'Incorrect username or password']);
    }
}

// public function login(Request $request)
// {
//     // dd($request->all());
//     $email = $request->input('email');
//     $password = $request->input('password');
//     $user = User::where('email', $email)->first();

//     if ($user && password_verify($password, $user->password)) {
//         // Credentials are correct, you can redirect to a different view or perform some actions here.
//         // $Home = Home::all();
//         return view('admin.dashboard');
//     } else {
//         // Incorrect username or password, show an error message.
//         return view('admin.dashboard')->with('error', 'Incorrect username or password');
//     }
// }

// public function login(Request $request, $email = null, $password = null)
// {
//     // dd($request->all());
//     // If email and password are provided as parameters, use them.
//     if ($email !== null && $password !== null) {
//         $user = User::where('email', $email)->first();

//         // if ($user && password_verify($password, $user->password)) {
//         //     // Credentials are correct, perform login actions.
//         //     // You may use Auth::login() or any other authentication method here.
//         //     return view('admin.dashboard');
//         // } else {
//         //     // Incorrect username or password, show an error message.
//         //     return view('admin.dashboard')->with('error', 'Incorrect username or password');
//         // }

//         if ($user && password_verify($password, $user->password)) {
//                     // Credentials are correct, you can redirect to a different view or perform some actions here.
//                     // $Home = Home::all();
//                     return view('admin.dashboard');
//                 } else {
//                     // Incorrect username or password, show an error message.
//                     return view('admin.dashboard')->with('error', 'Incorrect username or password');
//                 }
//     }

//     // Continue with your regular login logic.
// }


public function logout()
{
    Auth::logout();

    return redirect('/');
}
}
