@extends('layouts.admin')
@section('content')
<div id="content" class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header font-weight-bold">
                    Edit Roles
                </div>
                <div class="card-body">
                    <form action="{{ route('update_role',$role->id ) }}" method="post">
                        @csrf
                            <div class="form-group">
                                <label for="name" class="text-strong">Tên vai trò</label>
                                <input class="form-control" type="text" name="name" id="name" value="{{ $role->name }}" placeholder="Nhập tên vai trò">
                                @error('name')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="role" class="text-strong">Mô tả vai trò</label>
                                <textarea name="display_name" class="form-control text_strong" id="role" cols="20" rows="5">{{ $role->display_name }}</textarea>
                                @error('display_name')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="text-strong">
                                        <input type="checkbox" name="" class="checkAll" id="">
                                         CheckAll
                                    </label>
                                   
                                </div>
                            </div>
                            @foreach ($permisssionParent as $permisssionParentitem)
                                <div class="row no-gutters">                               
                                    <div class="card col-md-12 my-3 px-0">
                                        <div class="card-header-success card-header">
                                            <label>
                                            <input type="checkbox" class="checkbox_wrapper">
                                            Module {{ $permisssionParentitem->name }}
                                            </label>
                                        </div>
                                        <div class="row px-3 childrent-item">
                                            @foreach ($permisssionParentitem->permissionChildrent as $permissionChildrentItem)
                                                <div class="card-body col-3">
                                                    <h5 class="card-title">
                                                        <label>
                                                            <input type="checkbox" name="permission_id[]" 
                                                            value="{{ $permissionChildrentItem->id }}" 
                                                            class="checkbox_childrent" 
                                                            {{ $permissionCheck->contains('id',$permissionChildrentItem->id)?'checked':'' }}
                                                            >
                                                        </label>
                                                        {{ $permissionChildrentItem->name }}
                                                    </h5>
                                                </div> 
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            
                            
                        <button type="submit" name="btn-edit" class="btn btn-primary" value="Cập nhật">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection