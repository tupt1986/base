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
        flash()->overlay('Thay đổi quyền truy cập tài khoản <b>'.$user->username.'</b> thành công.','Thay đổi quyền truy cập.');
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
        flash()->overlay('Thông tin tài khoản <b>'.$user->username.'</b> đã thay đổi thành công.','Thay đổi thông tin người dùng.');
        return redirect('/users');
    }

    public function resetpassword($id){
        $user = User::findOrFail($id);
        $user -> password = bcrypt('123456');
        $user -> update();
        flash()->overlay('Mật khẩu tài khoản <b>'.$user->username.'</b> đã được đặt về mặc định là 123456. ','Thiết lập lại mật khẩu');
        return redirect('/users');
    }

    public function destroy($id){
        $user = User::findOrFail($id);
        $user -> delete();
        flash()->overlay('Tài khoản <b>'.$user->username.'</b> đã được xóa thành công. ','Xóa tài khoản');
        return redirect('/users');
    }

    public function create(){
        return view('user.create');
    }

    public function store(Request $request){
        $user = new User;
        $user -> name = $request['name'];
        $user -> username = $request['username'];
        $user -> password = bcrypt('123456');

        $user -> save();
        $user->roles() -> attach(Role::where('name','User')->first());

        flash()->overlay('Tài khoản <b>'.$user->username.'</b> đã được thêm mới thành công. ','Thêm mới tài khoản');
        return redirect('/users');
    }
}
