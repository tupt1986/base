<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\Role;

class UserController extends Controller
{
    //
    public function index()
    {
        $users = User::all();
        return view("user.index")->with("users", $users);;
    }

    public function assignRoles(Request $request){
        $user = User::where('username', $request['username'])->first();
        $user ->roles()->detach();
        if($request['role_user']){
            $user->roles() -> attach(Role::where('name','User')->first());
        }
        if($request['role_manager']){
            $user->roles() -> attach(Role::where('name','Manager')->first());
        }
        if($request['role_admin']){
            $user->roles() -> attach(Role::where('name','Admin')->first());
        }
        return redirect()->back();
    }

}
