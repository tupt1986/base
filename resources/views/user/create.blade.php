@extends('layouts.index')
@section('title')
<i class="icon-user-follow"></i> THÊM MỚI NGƯỜI DÙNG
@endsection

@section('content')
    <div class="headline">
        <h2 class="heading-sm">Thông tin người dùng thêm mới</h2>
    </div>

    <div class="row">
        <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
            <form action="{{url('/users/create')}}" class="reg-page" method="post" name="adduser" id="adduser" >
                {{csrf_field()}}
                <div class="input-group margin-bottom-20">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <input type="text" placeholder="Họ tên" class="form-control" id ='name' name ='name'>
                </div>
                <div class="input-group margin-bottom-20">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <input type="text" placeholder="Tên đăng nhập" class="form-control" id ='username' name ='username' >
                </div>
                <div align='center'>
                    <input type="submit" name="add" value="Thêm mới"class="btn-u" width="100px"/>
                    <input type="button" name="back" value="Quay lại"class="btn-u" width="100px" onclick="window.open('{{url('/users')}}', '_self')"/>
                </div>
            </form>
        </div>
    </div>
@endsection
