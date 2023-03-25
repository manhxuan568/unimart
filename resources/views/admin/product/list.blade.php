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
            <div class="form-search form-inline">
                <form action="">
                    <input type="text" class="form-control form-search" name="keyWord" placeholder="Tên sản phẩm">
                    <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary">
                </form>
                @if (request()->input('keyWord'))
                    <div class="key-word">Tìm kiếm tên sản phẩm với từ khóa: <strong style="color: #333">{{ request()->input('keyWord') }}</strong></div>
                @endif
            </div>
        </div>
        <div class="card-body">
                <div class="add-url">
                    <a href="{{ url('admin/product/add') }}" class="btn btn-success text-white ri" type="button">Thêm mới</a>
                </div>
            <div class="analytic">
                <a href="{{ route('get_status',['status'=>'publish']) }}" class="text-primary">Công khai<span class="text-muted">({{ $count_publish }})</span></a>
                <a href="{{ route('get_status',['status'=>'pending']) }}" class="text-primary">Chờ duyệt<span class="text-muted">( {{ $count_pending }} )</span></a>
                <a href="{{ route('get_status',['status'=>'trash']) }}" class="text-primary">Thùng rác<span class="text-muted">({{ $count_trash }})</span></a>
                <a href="{{ route('get_status',['status'=>'topWatch']) }}" class="text-primary">Sản phẩm nổi bật<span class="text-muted">({{ $count_topWatch }})</span></a>
                <a href="{{ route('get_status',['status'=>'topSale']) }}" class="text-primary">Sản phẩm bán chạy<span class="text-muted">({{ $count_topSale }})</span></a>
            </div>
            <form action="{{ route('action') }}" method="POST">
                @csrf
            <div class="form-action form-inline py-3">
                <select class="form-control mr-1" id="act" name="act">
                    <option value="">Chọn</option>
                    @foreach ($list_act as $k=>$v)
                       <option value="{{ $k }}">{{ $v }}</option> 
                    @endforeach
                </select>
                <input type="submit" name="btn-act" value="Áp dụng" class="btn btn-primary">
            </div>
            <table class="table table-striped table-checkall">
                <thead>
                    <tr>
                        <th scope="col">
                            <input name="checkall" type="checkbox">
                        </th>
                        <th scope="col">#</th>
                        <th scope="col">Ảnh</th>
                        <th scope="col">Tên sản phẩm</th>
                        <th scope="col">Giá</th>
                        <th scope="col">Danh mục</th>
                        <th scope="col">Ngày tạo</th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col">Tác vụ</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($list_product) >0)
                    
                        @php
                            $t=0;
                        @endphp
                        @foreach ($list_product as $item)
                        @php
                        $t++;
                        @endphp
                            <tr class="">
                            <td>
                                <input type="checkbox" name="list_check[]" class="check" value="{{ $item->id }}">
                            </td>
                            <td>{!! $t !!}</td>
                            <td class="thumb-item"><img src="{{ url("{$item->feature_img_path}") }}" alt=""></td>
                            <td><a href="#" class="title-product" title="{{ $item->name }}">{{ $item->name }}</a></td>
                            <td>{{ number_format($item->price) }}đ</td>
                            <td><span class="badge badge-warning">{{ $item->cat_name }}</span></td>
                            <td>{{ $item->created_at }}</td>
                            <td>@if ($item->num > 0)
                            <span class="badge badge-success">Còn hàng({{ $item->num }})</span>
                            @else
                            <span class="badge badge-dark">Hết hàng</span>  
                            @endif 
                            </td>
                            <td>
                                @can('edit-product',$item->id)
                                   <a href="{{ route('editProduct',$item->id) }}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>                                   
                                @endcan
                                @can('delete-product',$item->id)
                                   <a href="{{ route('deleteProduct',$item->id) }}" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete" onclick="return confirm('Bạn có muốn chuyển sản phẩm vào thùng rác?')"><i class="fa fa-trash"></i></a>                                   
                                @endcan
                            </td>
                        </tr>
                        @endforeach
                    
                    @else
                        <tr><td colspan="9"><div>Không có bản ghi nào.</div></td></tr>
                    @endif
                    
                    
                    
                    
                </tbody>
            </table>
            </form>
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
            {{ $list_product->links() }}
        </div>
    </div>
</div>
@endsection