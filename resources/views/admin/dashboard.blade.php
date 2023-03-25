@extends('layouts.admin')
@section('content')
<style>
    .title{
        width: 360px;
    }
</style>
<div class="container-fluid py-5">
    <div class="row">
        <div class="col">
            <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                <div class="card-header">ĐƠN HÀNG THÀNH CÔNG</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $count_success }}</h5>
                    <p class="card-text">Đơn hàng giao dịch thành công</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
                <div class="card-header">ĐANG XỬ LÝ</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $count_pending }}</h5>
                    <p class="card-text">Số lượng đơn hàng đang xử lý</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card text-white bg-warning mb-3" style="max-width: 18rem;">
                <div class="card-header">ĐANG VẬN CHUYỂN</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $count_shipping }}</h5>
                    <p class="card-text">Số lượng đơn hàng đang xử lý</p>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                <div class="card-header">DOANH SỐ</div>
                <div class="card-body">
                    <h5 class="card-title">{{ number_format(totalDashboard($list_order_success))  }} vnđ</h5>
                    <p class="card-text">Doanh số hệ thống</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
                <div class="card-header">ĐƠN HÀNG HỦY</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $count_trash }}</h5>
                    <p class="card-text">Số đơn bị hủy trong hệ thống</p>
                </div>
            </div>
        </div>
    </div>
    <!-- end analytic  -->
    <div class="card">
        <div class="card-header font-weight-bold">
            ĐƠN HÀNG MỚI
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Mã</th>
                        <th scope="col">Khách hàng</th>
                        <th scope="col">Danh sách sản phẩm</th>
                        <th scope="col">Tổng tiền</th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col">Thời gian tạo</th>
                        <th scope="col">Chi tiết</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $t=0;
                    @endphp
                    @foreach ($list_order as $order)
                    @php
                        $t++; 
                    @endphp    
                        <tr>
                            <td scope="row">{{ $t }}</td>
                            <td>{{ $order->order_code }}</td>
                            <td>
                                {{ $order->fullname }} <br>
                                {{ $order->phone }} <br>
                                {{ $order->email }}
                            </td>
                            <td>
                            @foreach (json_decode($order->info_order) as $item)
                             <div  class="title"><span class="text-primary font-weight-bold">x {{ $item->qty }}</span>-{{ $item->name }}</div> 
                            @endforeach
                            </td>
                            <td>{{ $order->order_total }}₫</td>
                            <td>
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
                            <td style="max-width: 8rem;">{{ $order->created_at }}</td>
                            <td>
                                <a href="{{ route('orderDetail',$order->id) }}">Chi tiết</a>
                                {{-- <a href="#" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                                <a href="#" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a> --}}
                            </td>
                        </tr>
                    @endforeach
                    
                    
                </tbody>
            </table>
            {{ $list_order->links() }}
        </div>
    </div>

</div>
@endsection