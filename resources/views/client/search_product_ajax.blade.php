@if (count($list_product_ajax) > 0)
    <ul class="list__product_ajax">
        @foreach ($list_product_ajax as $item)
            <li class="product_ajax_item">
                <a href="{{ route('productDetail',$item->slug) }}" class="ajax-thumb"><img src="{{ url($item->feature_img_path) }}" alt=""></a>
                <a href="{{ route('productDetail',$item->slug) }}" class="ajax_desc">
                    <div class="ajax_title">{{ $item->name }}</div>
                    <span class="ajax-price">{{ number_format($item->price) }}đ</span>
                </a>
            </li>
        @endforeach    
    </ul>    
@else
<ul class="list__product_ajax">
    <li class="product_ajax_item">Không tìm thấy sản phẩm nào.</li> 
</ul> 
@endif
