<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\Role;

class UserController extends Controller
{
    /**
     * @return $this
     * show tất cả user
     */
    public function index()
    {
        $users = User::all();
        flash()->overlay('Modal Message', 'Modal Title');
        return view("user.index")->with("users", $users);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * thay đổi quyền truy cập user
     */
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


    /**
     * @param $id
     * @return $this
     * Lấy thông tin chèn vào form thay đổi người dùng
     */
    public function edit($id){
        $user = User::findOrFail($id);
        return view("user.edit")->with("user", $user);
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * Lưu thay đổi thông tin người dùng
     */
    public function update($id, Request $request){
        $user = User::findOrFail($id);
        $user -> update($request->all());
        return redirect('/users');
    }

    public function resetpassword($id){
        $user = User::findOrFail($id);
        $user -> password = bcrypt('123456');
        $user -> update();
        return redirect('/users');
    }

    public function destroy($id){
        $user = User::findOrFail($id);
        $user -> delete();
        return redirect('/users');
    }
}
