@extends('layouts.admin')
@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Thêm quyền
        </div>
        <div class="card-body">
            <form action="{{ url('admin/permission/store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name" class="text-strong">Tên quyền</label>
                    <input class="form-control" type="text" name="name" id="name" value="{{ old('name') }}">
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group my-md-4">
                    <label for="display_name" class="text-strong">Mô tả quyền</label>
                    <input class="form-control" type="text" name="display_name" id="display_name" value="{{ old('display_name') }}">
                    @error('display_name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group my-md-4">
                    <label for="key-code"><strong>Nhập key_code</strong>(action_module). Ví dụ: Danh sách sản phẩm -> key_code=list_product, Danh sách danh mục sản phẩm -> key_code=list_category_product</label>
                    <input class="form-control" type="text" name="key_code" id="key-code" value="{{ old('key_code') }}">
                    @error('key_code')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                
                <div class="form-group my-md-4">
                    <label for="" class="text-strong">Chọn module cha</label>
                    <select class="form-control" name="module_parent" id="">
                        <option value="0" selected>Là module cha mới nếu không chọn</option>
                        @foreach ($module_parent as $moduleItem)
                            <option value="{{ $moduleItem->id }}">{{ $moduleItem->name }}</option>
                        @endforeach
                    </select>
                </div>
                {{-- <div class="row">
                    @foreach (config('permissions.module_childrent') as $mudule_childrent)
                        <div class="col-md-3">
                            <label class="text-strong">
                                <input type="checkbox" name="module_childrent[]" value="{{ $mudule_childrent }}" id="">
                                {{ $mudule_childrent }}
                            </label>
                        </div>
                    @endforeach    
                </div> --}}
                <button type="submit" class="btn btn-primary" name="btn_update" value="thêm">Thêm mới</button>
            </form>
        </div>
    </div>
</div>
@endsection