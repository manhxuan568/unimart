@extends('layouts.admin')
@section('content')
<div id="content" class="container-fluid">
    @if (session('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('status') }}
                <button type="submit" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times</span></button>
            </div> 
    @endif
        @if (session('alert'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{ session('alert') }}
                <button type="submit" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times</span></button>
            </div> 
        @endif
    <div class="card">
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h5 class="m-0 ">Danh sách menu</h5>
            <div class="add-ur">
                <a href="{{ url('admin/menu/add') }}" class="btn btn-success text-white ri" type="button">Thêm mới</a>
            </div>
        </div>
        <div class="card-body">
            {{-- <div class="analytic">
                <a href="" class="text-primary">Trạng thái 1<span class="text-muted">(10)</span></a>
                <a href="" class="text-primary">Trạng thái 2<span class="text-muted">(5)</span></a>
                <a href="" class="text-primary">Trạng thái 3<span class="text-muted">(20)</span></a>
            </div>
            <div class="form-action form-inline py-3">
                <select class="form-control mr-1" id="">
                    <option>Chọn</option>
                    <option>Tác vụ 1</option>
                    <option>Tác vụ 2</option>
                </select>
                <input type="submit" name="btn-search" value="Áp dụng" class="btn btn-primary">
            </div> --}}
            <table class="table table-striped table-checkall">
                <thead>
                    <tr>
                        {{-- <th>
                            <input type="checkbox" name="checkall">
                        </th> --}}
                        <th scope="col">#</th>
                        <th scope="col">Tên Menu</th>
                        <th scope="col">Link</th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col">Người tạo</th>
                        <th scope="col">Ngày tạo</th>
                        <th scope="col">Tác vụ</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $t=0;
                    @endphp
                    @foreach ($menus as $menu)
                    @php
                        $t++;
                    @endphp
                       <tr>
                        {{-- <td>
                            <input type="checkbox" class="check">
                        </td> --}}
                        <th scope="row">{{ $t }}</th>
                        <td>{{ str_repeat('---', $menu->level).$menu->name }}</td>
                        <td>{{ $menu->slug }}</td>
                        <td>@if ($menu->status==0)
                            <span class="badge badge-primary">{{ status($menu->status) }}</span>
                            @else
                            <span class="badge badge-success">{{ status($menu->status) }}</span>  
                            @endif 
                        </td>
                        <td>{{ $menu->user->name }}</td>
                        <td>{{ $menu->created_at }}</td>
                        <td>
                            @can('edit-menu')
                                <a href="{{ route('edit_menu', $menu->id) }}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                            @endcan
                            @can('delete-menu')
                                <a href="{{ route('delete_menu', $menu->id) }}" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete" onclick="return confirm('Bạn có chắc chắn muốn xía menu này?')"><i class="fa fa-trash"></i></a>
                            @endcan
                        </td>
                    </tr> 
                    @endforeach
                    
                </tbody>
            </table>
            {{-- <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Previous">
                            <span aria-hidden="true">Trước</span>
                            <span class="sr-only">Sau</span>
                        </a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                        </a>
                    </li>
                </ul>
            </nav> --}}
        </div>
    </div>
</div>
@endsection