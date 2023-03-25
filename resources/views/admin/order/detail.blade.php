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
        <div class="card-header font-weight-bold">
            Chi tiết đơn hàng
        </div>
        <div class="card-body">
            <div class="order_code">
                <p><span class="text-primary"><i class="fa-solid fa-barcode"></i></span> Mã đơn hàng</p>
                <p class="text-primary font-weight-bold">{{ $order->order_code }}</p>
            </div>
            <div class="info-client">
                <p><span class="text-primary"><i class="fa-solid fa-circle-exclamation"></i></span> Thông tin khách hàng</p>
                <p class="text-primary font-weight-bold">{{ $order->order_code }}</p>
                <p class="font-weight-bold">{{ $order->fullname }}</p>
                <p class="phone">{{ $order->phone }}</p>
                <p class="email">{{ $order->email }}</p>
            </div>
            <div class="address">
                <p><span class="text-primary"><i class="fa-sharp fa-solid fa-location-dot"></i></span> Địa chỉ nhận hàng</p>
                <p class="addresss">{{ $order->address }}, {{ $order->ward->name }}, {{ $order->district->name }}, {{ $order->province->name }}</p>
            </div>
            <div class="payment-method">
                <p><span class="text-primary"><i class="fa-solid fa-money-bill-transfer"></i></span> Phương thức thanh toán</p>
                <p>{{ $order->payment_method=='home'?'Thanh toán tại nhà.':'Thanh toán tại cửa hàng.' }}</p>
            </div>
            <div class="note" style="border-bottom:1px solid #eae7e7">
                <p><span class="text-primary"><i class="fa-solid fa-file"></i></span> Ghi chú</p>
                <p class="notes">{{ $order->note }}</p>
            </div>
            <div class="status-order">
            <form action="{{ route('actionDetail',['id'=>$order->id]) }}" method="post">
                @csrf
                <p><span class="text-primary"><i class="fa-brands fa-jedi-order"></i></span> Trạng thái đơn hàng</p>
                <div class="form-group mb-0 mr-1  d-inline-block">
                    <select name="status"  class="form-control">
                        @php
                            $list_act = ['pending'=>'Đang sử lý','success'=>'Thành công','shipping'=>'Đang vận chuyển'];
                        @endphp
                        @foreach ($list_act as $k=>$v)
                           <option value="{{ $k }}" {{ $k==$order->status_order?'selected':'' }}>{{ $v }}</option> 
                        @endforeach
                    </select>
                
                </div>
                <input type="submit" class="btn btn-primary d-inline-block" name="btn_status" value="Cập nhật đơn hàng" >
            </form>
            </div>
            <div class="detail-product my-5">
                <h4 class="text-primary">Sản phẩm đơn hàng</h4>
                <table class="table table-reponsive">
                    <thead>
                        <tr>
                            <th scope="col">STT</th>
                            <th scope="col">Ảnh sản phẩm</th>
                            <th scope="col">Tên sản phẩm</th>
                            <th scope="col">Đơn giá</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $t=0;
                        @endphp
                        @foreach (json_decode($order->info_order) as $item)
                        @php
                            $t++;
                        @endphp
                           <tr>
                            <td>{{ $t }}</td>
                            <td class="thumb-item" style="border: 1px solid #cfcbcb;width: 135px;height: 135px;"><img src="{{ url("{$item->options->thumbnail}") }}" class="thumb-item" alt=""></td>
                            <td style="width: 500px; font-size:17px">{{ $item->name }}</td>
                            <td style="width: 130px;">{{ number_format($item->price) }}đ</td>
                            <td style="width: 110px;">{{ $item->qty }}</td>
                            <td>{{ number_format($item->subtotal) }}đ</td>
                        </tr> 
                        @endforeach
                        
                        
                    </tbody>
                </table>

            </div>
            <div class="total-order">
                <h4 class="text-primary">Giá trị đơn hàng</h4>
                <p>Tổng số lượng : <span class="font-weight-bold">{{ $order->count_qty }}</span></p>
                <p>Tổng đơn hàng : <span class="font-weight-bold">{{ $order->order_total }}đ</span></p>
            </div>
        </div>
    </div>
</div>
@endsection