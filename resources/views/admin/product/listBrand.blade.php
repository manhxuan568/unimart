@extends('layouts.admin')
@section('content')
<div id="content" class="container-fluid">
    <div class="row">
        <div class="col-4">
            <div class="card">
                @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('status') }}
                    <button type="submit" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times</span></button>
                    </div> 
                @endif
                <div class="card-header font-weight-bold">
                    Thêm hãng sản phẩm
                </div>
                <div class="card-body">
                    <form action="{{ url('admin/product/brand/add') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name" class="text-strong">Tên Hãng</label>
                            <input class="form-control" type="text" name="name" id="title" onkeyup="ChangeToSlug();">
                            @error('name')
                              <small class="text-danger">{{ $message }}</small>  
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="name" class="text-strong">Link slug rút gọn</label>
                            <input class="form-control" type="text" name="slug" id="slug">
                        </div>
                        {{-- <div class="form-group">
                            <label for="">Danh mục cha</label>
                            <select class="form-control" id="">
                                <option>Chọn danh mục</option>
                                <option>Danh mục cha mới</option>
                                <option>Danh mục 2</option>
                                <option>Danh mục 3</option>
                                <option>Danh mục 4</option>
                            </select>
                        </div> --}}
                        {{-- <div class="form-group">
                            <label for="">Trạng thái</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                                <label class="form-check-label" for="exampleRadios1">
                                    Chờ duyệt
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
                                <label class="form-check-label" for="exampleRadios2">
                                    Công khai
                                </label>
                            </div>
                        </div> --}}



                        <button type="submit" name="btn-add" value="Thêm mới" class="btn btn-primary">Thêm mới</button>
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
                    Danh sách hãng sản phẩm
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên</th>
                                <th scope="col">Slug</th>
                                <th scope="col">Người tạo</th>
                                <th scope="col">Tác vụ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $t=0;
                            @endphp
                            @foreach ($list_brand as $item)
                            @php
                                $t++;
                            @endphp
                            <tr>
                                <th scope="row">{{ $t }}</th>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->slug }}</td>
                                <td>{{ $item->creator }}</td>
                                <td>
                                    @can('edit-brand-product')
                                        <a href="{{ route('edit_brand', $item->id) }}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>                                       
                                    @endcan
                                    @can('delete-brand-product')
                                        <a href="{{ route('delete_brand', $item->id) }}" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete" onclick="return confirm('Bạn có chắc chắn muốn xóa hãng này?')"><i class="fa fa-trash"></i></a>                                       
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