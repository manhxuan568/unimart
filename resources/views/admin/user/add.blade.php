@extends('layouts.admin')
@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Thêm người dùng
        </div>
        <div class="card-body">
            <form action="{{ url('admin/user/store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Họ và tên</label>
                    <input class="form-control" type="text" name="fullname" id="name">
                    @error('fullname')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input class="form-control" type="text" name="email" id="email">
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Mật khẩu</label>
                    <input class="form-control" type="password" name="password" id="email">
                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Xác nhận mật khẩu</label>
                    <input class="form-control" type="password" name="password_confirmation" id="email">
                </div>
                
                <div class="form-group">
                    <label for="">Nhóm quyền</label>
                    <select name="role_id[]" class="form-control select2-init" id="" multiple>
                        <option value=""></option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" name="btn_add" class="btn btn-primary" value="Thêm mới">Thêm mới</button>
            </form>
        </div>
    </div>
</div> 
@endsection