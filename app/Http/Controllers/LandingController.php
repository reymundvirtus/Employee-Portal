<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingController extends Controller
{
    //? display the register page when your not loggedin
    public function __construct() {

        $this->middleware(['guest']);
    }
    
    public function index() {

        return view('landing');
    }
}
