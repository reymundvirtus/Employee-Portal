<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class ManagerController extends Controller
{
    public function __construct() {

        $this->middleware('auth');
    }

    public function index() {
        $roles = DB::select('SELECT * FROM roles');
        
        return view('manager.index', ['roles' => $roles]);
    }
}
