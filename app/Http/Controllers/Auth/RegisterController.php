<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{    
    // public function __construct() {

    //     $this->middleware('auth');
    // }
    
    //? this will store to model to database the user who signup or register
    public function store(Request $request) {
        //? after validation we store user in db
        User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'role_id' => $request->role_id,
            'password' => Hash::make($request->password),
            'creator_id' => auth()->user()->id
        ]);

        auth()->attempt($request->only('email', 'password'));
        auth()->logout();

        //?  after storing in db we redirect the user
        return redirect()->route('login'); //! to be change with admin page
    }
}
