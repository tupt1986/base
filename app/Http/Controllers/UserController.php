<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;

class UserController extends Controller
{
    //
    public function index()
    {
        $users = User::all();
        return view("user.index")->with("users", $users);;
    }
}
