<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class CrudModel extends Model
{
    use HasFactory;

    public function scopeRetrieveUser() {

        $result = DB::select('SELECT users.id, roles.role_name, roles.role_id, users.first_name, users.last_name, users.email, users.password, users.created_at, users.creator_id AS encoder_id,
        (SELECT users.first_name FROM users WHERE id = encoder_id) AS encoder FROM users, roles
        WHERE users.role_id = roles.role_id');

        return $result;
    }

    public function DeleteUser($request) {

        $user_id = $request->input('user_id');

        $result = DB::delete('DELETE FROM users WHERE id = ?', [$user_id]);
        return $result;
    }

    public function UpdateUser($request) {

        $user_id = $request->input('user_id');
        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name');
        $email = $request->input('email');
        $password = Hash::make($request->input('password'));

        $result = DB::update('UPDATE users SET first_name = ?, last_name = ?, email = ?, password = ? WHERE id = ?', [$first_name, $last_name, $email, $password, $user_id]);

        return $result;
    }

    public function scopeCountData() {

        $result = DB::select('SELECT COUNT(id) AS ID FROM users');
        return $result;
    }
}
