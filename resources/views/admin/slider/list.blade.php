@extends('layouts.admin')
@section('content')
<div id="content" class="container-fluid">
    <div class="card">
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
        @if (session('alert-check'))
                   <div class="alert alert-danger alert-dismissible fade show" role="alert">
                      {{ session('alert-check') }}
                      <button type="submit" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times</span></button>
                    </div> 
        @endif       
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h5 class="m-0 ">Danh sách sản phẩm</h5>
            <div class="add-ur">
                <a href="{{ url('admin/slider/add') }}" class="btn btn-success text-white ri" type="button">Thêm mới</a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('action') }}" method="POST">
                @csrf
            <table class="table table-striped table-checkall">
                <thead>
                    <tr>
                        {{--  --}}
                        <th scope="col">#</th>
                        <th scope="col">Ảnh</th>
                        <th scope="col">Tên slider</th>
                        <th scope="col">Mô tả</th>
                        <th scope="col">Link</th>
                        <th scope="col">Ngày tạo</th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col">Tác vụ</th>
                    </tr>
                </thead>
                <tbody>
                        @php
                            $t=0;
                        @endphp
                        @foreach ($sliders as $item)
                        @php
                        $t++;
                        @endphp
                            <tr class="">
                            {{-- <td>
                                <input type="checkbox" name="list_check[]" class="check" value="{{ $item->id }}">
                            </td> --}}
                            <td>{{ $t }}</td>
                            <td class="thumb-slider"><img src="{{ url("{$item->thumb_slider}") }}" alt=""></td>
                            <td><a href="#">{{ $item->name }}</a></td>
                            <td>{{ $item->slider_desc }}</td>
                            <td>{{ $item->link }}</td>
                            <td>{{ $item->created_at }}</td>
                            <td>@if ($item->status==0)
                                <span class="badge badge-primary">{{ status($item->status) }}</span>
                                @else
                                <span class="badge badge-success">{{ status($item->status) }}</span>  
                                @endif 
                            </td>
                            <td>
                                @can('edit-slider')
                                    <a href="{{ route('edit_slider',$item->id) }}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>                                   
                                @endcan
                                @can('delete-slider')
                                    <a href="{{ route('delete_slider',$item->id) }}" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete" onclick="return confirm('Bạn có muốn chuyển sản phẩm vào thùng rác?')"><i class="fa fa-trash"></i></a>                                    
                                @endcan
                            </td>
                        </tr>
                        @endforeach
                </tbody>
            </table>
            </form>
        </div>
    </div>
</div>
@endsection