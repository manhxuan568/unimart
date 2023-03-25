@extends('layouts.admin')
@section('content')
<div id="content" class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header font-weight-bold">
                    Add Roles
                </div>
                <div class="card-body">
                    <form action="{{ url('admin/role/store') }}" method="post">
                        @csrf
                            <div class="form-group">
                                <label for="name" class="text-strong">Tên vai trò</label>
                                <input class="form-control" type="text" name="name" id="name" value="{{ old('name') }}" placeholder="Nhập tên vai trò">
                                @error('name')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="role" class="text-strong">Mô tả vai trò</label>
                                <textarea name="display_name" class="form-control text_strong" id="role" cols="20" rows="5">{{ old('display_name') }}</textarea>
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
                                                            <input type="checkbox" name="permission_id[]" value="{{ $permissionChildrentItem->id }}" class="checkbox_childrent">
                                                        </label>
                                                        {{ $permissionChildrentItem->name }}
                                                    </h5>
                                                </div> 
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            
                            
                        <button type="submit" name="btn-add" class="btn btn-primary" value="Thêm mới">Thêm mới</button>
                    </form>
                </div>
            </div>
        </div>
        {{-- <div class="col-8">
            <div class="card">
                <div class="card-header font-weight-bold">
                    Danh mục
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">First</th>
                                <th scope="col">Last</th>
                                <th scope="col">Handle</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Jacob</td>
                                <td>Thornton</td>
                                <td>@fat</td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>Larry</td>
                                <td>the Bird</td>
                                <td>@twitter</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div> --}}
    </div>

</div>
@endsection