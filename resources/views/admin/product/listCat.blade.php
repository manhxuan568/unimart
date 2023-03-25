@extends('layouts.admin')
@section('content')
<div id="content" class="container-fluid">
    <div class="row">
        <div class="col-4">
            <div class="card">
                @if (session('status'))
                   <div class="alert alert-success">{{ session('status') }}</div> 
                @endif
                <div class="card-header font-weight-bold">
                    Danh mục sản phẩm
                </div>
                <div class="card-body">
                    <form action="{{ url('admin/product/addcat') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Tên danh mục</label>
                            <input class="form-control" type="text" name="name" id="title" onkeyup="ChangeToSlug();">
                            @error('name')
                              <small class="text-danger">{{ $message }}</small>  
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="slug" class="text-strong">Link slug</label>
                            <input class="form-control" type="text" name="slug" id="slug">
                        </div>
                        <div class="form-group">
                            <label for="parent_id">Danh mục cha</label>
                            <select class="form-control" id="parent_id" name="parent_id">
                                <option>Chọn danh mục</option>
                                <option value="0" selected>Danh mục cha mới</option>
                                @foreach ($list_cat as $cat)
                                    <option value="{{ $cat->id }}">{{ str_repeat('---',$cat->level).$cat->cat_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Trạng thái</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="exampleRadios1" value="0" checked>
                                <label class="form-check-label" for="exampleRadios1">
                                    Chờ duyệt
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="exampleRadios2" value="1">
                                <label class="form-check-label" for="exampleRadios2">
                                    Công khai
                                </label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary" name="btn-add" value="Thêm mới">Thêm mới</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="card">
                @if (session('delete'))
                   <div class="alert alert-danger alert-dismissible fade show" role="alert">
                      {{ session('delete') }}
                      <button type="submit" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times</span></button>
                    </div> 
                @endif
                @if (session('update'))
                   <div class="alert alert-success alert-dismissible fade show" role="alert">
                      {{ session('update') }}
                      <button type="submit" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times</span></button>
                    </div> 
                @endif
                <div class="card-header font-weight-bold">
                    Danh sách
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên danh mục</th>
                                <th scope="col">Slug</th>
                                <th scope="col">Trạng thái</th>
                                <th scope="col">Tác vụ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $t=0;
                            @endphp
                            @foreach ($list_cat as $cat)
                            @php
                             $t++;   
                            @endphp                          
                               <tr>
                                <th scope="row">{{ $t }}</th>
                                <td>{{ str_repeat('---',$cat->level).$cat->cat_name }}</td>
                                <td>{{ $cat->slug }}</td>
                                <td>{{ status($cat->status) }}</td>
                                <td>
                                    @can('edit-category-product')
                                        <a href="{{ route('edit_cat', $cat->id) }}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>                                        
                                    @endcan
                                    @can('delete-category-product')
                                        <a href="{{ route('delete_cat', $cat->id) }}" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete" onclick="return confirm('Bạn có chắc chắn muốn xía menu này?')"><i class="fa fa-trash"></i></a>                                       
                                    @endcan
                                </td>
                            </tr> 
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection