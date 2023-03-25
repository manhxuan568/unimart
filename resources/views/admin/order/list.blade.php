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
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h5 class="m-0 ">Danh sách đơn hàng</h5>
            <div class="form-search form-inline">
                <form action="">
                    <input type="text" class="form-control form-search" name="keyWord" placeholder="Tìm theo tên khách hàng">
                    <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary">
                </form>
                @if (request()->input('keyWord'))
                    <div class="key-word">Tìm kiếm tên khách hàng từ khóa: <strong style="color: #333">{{ request()->input('keyWord') }}</strong></div>
                @endif
            </div>
        </div>
        <div class="card-body">
            <div class="analytic">
                <a href="{{ route('list_oredr',['status'=>'pending']) }}" class="text-primary">Chờ xử lý<span class="text-muted">({{ $count_pending }})</span></a>
                <a href="{{ route('list_oredr',['status'=>'success']) }}" class="text-primary">Thành công<span class="text-muted">({{ $count_success }})</span></a>
                <a href="{{ route('list_oredr',['status'=>'shipping']) }}" class="text-primary">Đang vận chuyển<span class="text-muted">({{ $count_shipping }})</span></a>
                <a href="{{ route('list_oredr',['status'=>'trash']) }}" class="text-primary">Đơn hủy được lưu trữ<span class="text-muted">({{ $count_trash }})</span></a>
            </div>
            <form action="{{ url('admin/order/action') }}" method="post">
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
                        <th>
                            <input type="checkbox" name="checkall">
                        </th>
                        <th scope="col">#</th>
                        <th scope="col">Mã</th>
                        <th scope="col">Khách hàng</th>
                        <th scope="col">Sản phẩm</th>
                        <th scope="col">Tổng đơn</th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col">Thời gian</th>
                        <th scope="col">Chi tiết</th>
                        <th scope="col">Tác vụ</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($list_order)>0)
                    @php
                        $t=0;
                    @endphp
                    @foreach ($list_order as $order)
                    @php
                        $t++; 
                    @endphp 
                    <tr>
                        <td>
                            <input type="checkbox" name="list_check[]" value="{{ $order->id }}">
                        </td>
                        <td>{{ $t }}</td>
                        <td>{{ $order->order_code }}</td>
                        <td>
                            {{ $order->fullname }} <br>
                            {{ $order->phone }} <br>
                            {{ $order->email }}
                        </td>
                        <td>
                            @foreach (json_decode($order->info_order) as $item)
                             <div  class="title" style="width:261px"><span class="text-primary font-weight-bold">x {{ $item->qty }}</span>-{{ $item->name }}</div> 
                            @endforeach
                        </td>
                        <td>{{ $order->order_total }}₫</td>
                        <td style="width:120px">
                            @if ($order->status_order == 'pending')
                                <span class="badge badge-warning">Đang xử lý</span>
                            @endif
                            @if ($order->status_order == 'success')
                                <span class="badge badge-success">Thành công</span>
                            @endif
                            @if ($order->status_order == 'shipping')
                                <span class="badge badge-primary">Đang vận chuyển</span>
                            @endif
                            @if ($order->status_order == 'cancel')
                                <span class="badge badge-dark">Đơn bị hủy</span>
                            @endif
                        </td>
                        <td style="width:120px">{{ $order->created_at }}</td>
                        @if ($order->status_order != 'cancel')
                        <td><a href="{{ route('orderDetail',$order->id) }}" class="font-weight-bold">Chi tiết</a></td> 
                        @else
                        <td>Khôi phục để xem</td>
                        @endif
                        
                        <td>
                            @can('edit-order')
                            <a href="{{ route('editOrder',$order->id) }}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>                                
                            @endcan
                            @can('delete-order')
                            <a href="{{ route('deleteOrder',$order->id) }}" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete" onclick="return confirm('Bạn có muốn xóa đơn hàng này?')"><i class="fa fa-trash"></i></a>
                            @endcan
                        </td>
                    </tr>
                   @endforeach
                   @else
                        <tr><td colspan="8" class="bg-white">Không có bản ghi nào.</td></tr>  
                    @endif
                </tbody>
            </table>
            </form>
            {{ $list_order->links() }}
        </div>
    </div>
</div>
@endsection