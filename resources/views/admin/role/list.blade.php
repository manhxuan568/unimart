@extends('layouts.admin')
@section('content')
<div id="content" class="container-fluid">
    @if (session('status'))
                   <div class="alert alert-success alert-dismissible fade show" role="alert">
                      {{ session('status') }}
                      <button type="submit" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times</span></button>
                    </div> 
    @endif
    <div class="card">
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h5 class="m-0 ">Danh sách vai trò</h5>
            <div class="form-search form-inline">
                <form action="#">
                    <input type="" class="form-control form-search" placeholder="Tìm kiếm">
                    <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary">
                </form>
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
                        <th scope="col">Tên vai trò</th>
                        <th scope="col">Mô tả vai trò</th>
                        {{-- <th scope="col">Trạng thái</th>
                        <th scope="col">Người tạo</th> --}}
                        {{-- <th scope="col">Ngày tạo</th> --}}
                        <th scope="col">Tác vụ</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $t=0;
                    @endphp
                    @foreach ($Roles as $role)
                    @php
                        $t++;
                    @endphp
                       <tr>
                        {{-- <td>
                            <input type="checkbox" class="check">
                        </td> --}}
                        <th scope="row">{{ $t }}</th>
                        <td>{{ $role->name }}</td>
                        <td>{{ $role->display_name }}</td>
                        {{-- <td>{{ $role->created_at }}</td> --}}
                        {{-- <td>{{ $menu->creator }}</td>
                        <td>{{ $menu->created_at }}</td> --}}
                        <td>
                            <a href="{{ route('edit_role', $role->id) }}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                            <a href="{{ route('delete_role', $role->id) }}" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete" onclick="return confirm('Bạn có chắc chắn muốn xía menu này?')"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr> 
                    @endforeach
                    
                </tbody>
            </table>
       
            {{ $Roles->links() }}
        </div>
    </div>
</div>
@endsection