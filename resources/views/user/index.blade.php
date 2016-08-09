<?php
/**
 * Created by PhpStorm.
 * User: tupt1
 * Date: 06/08/2016
 * Time: 11:43 CH
 */
?>
@extends('layouts.app')
@section('content')
<table>
    <thead>
    <tr>
        <th>stt</th>
        <th>Ho ten</th>
        <th>Tai khoan</th>
        <th>user</th>
        <th>manager</th>
        <th>admin</th>
        <th>action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <td>{{$user->id}}</td>
            <td>{{$user->name}}</td>
            <td>{{$user->username}}</td>
            <td><input type="checkbox" {{$user->hasRole('User') ? 'checked' : ''}} name="role_user"> </td>
            <td><input type="checkbox" {{$user->hasRole('Manager') ? 'checked' : ''}} name="role_manager"></td>
            <td><input type="checkbox" {{$user->hasRole('Admin') ? 'checked' : ''}} name="role_admin"></td>
            <td>action</td>
        </tr>
    @endforeach
    </tbody>
</table>

@endsection
