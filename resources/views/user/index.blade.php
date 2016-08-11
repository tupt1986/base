<?php
/**
 * Created by PhpStorm.
 * User: tupt1
 * Date: 06/08/2016
 * Time: 11:43 CH
 */
?>
@extends('layouts.index')
@section('title', 'QUẢN TRỊ NGƯỜI DÙNG')

@section('content')
    <div class="headline">
        <h2 class="heading-sm">Danh sách người dùng - quyền truy cập</h2>
    </div>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>STT</th>
                <th>Họ và tên</th>
                <th>Tài khoản đăng nhập</th>
                <th>Quyền người dùng</th>
                <th>Quyền quản lý</th>
                <th>Quyền quản trị</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <form action="{{route('user.assignroles')}}" method="post">
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->username}}<input type="hidden" name="username" value="{{$user->username}}"> </td>
                    <td><input type="checkbox" {{$user->hasRole('User') ? 'checked' : ''}} name="role_user" id="role_user"></td>
                    <td><input type="checkbox" {{$user->hasRole('Manager') ? 'checked' : ''}} name="role_manager" id="role_manager"></td>
                    <td><input type="checkbox" {{$user->hasRole('Admin') ? 'checked' : ''}} name="role_admin" id="role_admin"></td>
                    {{csrf_field()}}
                    <td>
                        <button type="submit" class="btn btn-success btn-xs">Thay đổi quyền</button>
                        <button type="button" class="btn btn-success btn-xs" onclick="window.open('{{url('/users/'.$user->id)}}', '_self')">Chỉnh sửa thông tin</button>
                        <button type="button" class="btn btn-success btn-xs">Xóa</button>
                    </td>
                </form>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
