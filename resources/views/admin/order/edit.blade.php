@extends('layouts.admin')
@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Cập nhật thông tin khách hàng
        </div>
        <div class="card-body">
            <form action="{{ route('update_order',$order->id) }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="fullname" class="text-strong">Họ tên khách hàng</label>
                    <input class="form-control" type="text" name="fullname" id="fullname" value="{{ $order->fullname }}">
                            @error('fullname')
                            <small class="text-danger">{{ $message }}</small>  
                            @enderror
                </div>
                <div class="form-group">
                    <label for="phone" class="text-strong">Số điện thoại</label>
                    <input class="form-control" type="tel" name="phone" id="phone" maxlength="10" value="{{ $order->phone }}">
                    @error('phone')
                      <small class="text-danger">{{ $message }}</small>  
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input class="form-control" type="text" name="email" value="{{ $order->email }}" id="email">
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="t" class="text-strong">Ghi chú</label>
                    <textarea name="note" class="form-control" id="t" cols="20" rows="10">{{ $order->note }}</textarea>
                    @error('note')
                        <small class="text-danger">{{ $message }}</small>  
                    @enderror
                </div>

                <button type="submit" name="btn_update" value="Cập nhật" class="btn btn-primary">Cập nhật</button>
            </form>
        </div>
    </div>
</div>
@endsection