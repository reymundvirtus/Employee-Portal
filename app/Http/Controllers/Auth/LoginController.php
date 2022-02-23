<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    //? display the register page when your not loggedin
    public function __construct() {

        $this->middleware(['guest']);
    }

    //? displaying the login page
    public function index() {

        return view('auth.login');
    }

    //? this will validate the user from login page and once it is correct it sign the user and redirect to dasboard page
    public function store(Request $request) {

        //? validation
        // $this->validate($request, [
        //     'email' => 'required|email',
        //     'password' => 'required',
        // ]);
        
        //? sign the user in
        if (!auth()->attempt($request->only('email', 'password', 'role_id'), $request->remember)) {
            return back()->with('status', 'Invalid login details');
        }

        //? redirect after sign in based on roles
        if (Auth::user()->role_id == 1) {
            return redirect()->route('admin');
        } elseif (Auth::user()->role_id == 2) {
            return redirect()->route('manager');
        } elseif (Auth::user()->role_id == 3) {
            return redirect()->route('cashier');
        }
        // return redirect()->route('admin'); //! to be change with admin page
    }
}