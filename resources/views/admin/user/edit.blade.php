@extends('layouts.admin')
@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Thêm người dùng
        </div>
        <div class="card-body">
            <form action="{{ route('update_user', $user->id) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Họ và tên</label>
                    <input class="form-control" type="text" name="fullname" value="{{ $user->name }}" id="name">
                    @error('fullname')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input class="form-control" type="text" name="email" value="{{ $user->email }}" id="email" disabled>
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Mật khẩu mới</label>
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
                    <select class="form-control select2-init" name="role_id[]" id="" multiple>
                        <option value=""></option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}" {{ $rolefoUser->contains('id',$role->id)?'selected':'' }}>{{ $role->name }}</option>
                        @endforeach
                        
                    </select>
                </div>

                <button type="submit" name="btn_update" class="btn btn-primary" value="Cập nhật">Cập nhật</button>
            </form>
        </div>
    </div>
</div> 
@endsection