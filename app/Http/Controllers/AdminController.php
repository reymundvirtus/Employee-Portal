<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\CrudModel;
use Illuminate\Support\Facades\DB;


class AdminController extends Controller
{
    public function __construct() {

        $this->middleware('auth');
    }

    public function index() {
        $roles = DB::select('SELECT * FROM roles');
        
        return view('admin.index', ['roles' => $roles]);
    }

    public function retrieve_data() {

        $user = CrudModel::RetrieveUser();

        return response()->json($user);
    }

    public function delete_data(Request $request) {

        $result = new CrudModel();
        $result->DeleteUser($request);
        return response()->json($result);
    }

    public function update_data(Request $request) {

        $result = new CrudModel();
        $result->UpdateUser($request);
        return response()->json($result);
    }

    public function count_data() {

        $result = CrudModel::CountData();
        return response()->json($result);
    }
}
