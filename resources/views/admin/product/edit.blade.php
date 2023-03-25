@extends('layouts.admin')
@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Thêm sản phẩm
        </div>
        <div class="card-body">
            <form action="{{ route('updateProduct',$product->id) }}" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="title" class="text-strong hello">Tên sản phẩm</label>
                            <input class="form-control" type="text" name="name" id="title" value="{{ $product->name }}" onkeyup="ChangeToSlug();">
                                 @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                 @enderror
                        </div>
                        <div class="form-group">
                            <label for="slug" class="text-strong">Link slug rút gọn</label>
                            <input class="form-control" type="text" name="slug" value="{{ $product->slug }}" id="slug">
                                @error('slug')
                                        <small class="text-danger">{{ $message }}</small>
                                @enderror
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                            <div class="form-group">
                                <label for="price" class="text-strong">Giá</label>
                                <input class="form-control" type="number" min="0" name="price" value="{{ $product->price }}" id="price">
                                    @error('price')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                            </div>
                            <div class="form-group">
                                <label for="discount" class="text-strong">Giá cũ(Có thể cập nhật sau)</label>
                                <input class="form-control" type="number" min="0" name="price_old" value="{{ $product->price_old }}" id="discount">
                            </div>

                           </div> 
                           <div class="col-md-6">
                                <div class="form-group">
                                    <label for="num" class="text-strong">Số lượng sản phẩm trong kho</label>
                                    <input class="form-control" type="number" name="num" min="0" max="1000" value="{{ $product->num }}" id="num">
                                </div>     

                           </div> 
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                            <div class="form-group py-md-3">
                                <label for="avater" class="text-strong">Ảnh đại diện(Có thể đổi ảnh đại diện.)</label>
                                <input type="file" name="avtar" id="avater">
                                    @error('avtar')
                                        <br><small class="text-danger">{{ $message }}</small>
                                    @enderror 
                            </div> 
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="shoWthumb-pro"><img src="{{ url("{$product->feature_img_path }") }}" alt=""></div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="col-6">
                        <div class="row">
                           <div class="col-md-6">
                            <div class="form-group">
                                <label for="" class="text-strong">Trạng thái</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="exampleRadios1" value="0" {{ $product->status==0?'checked':'' }} >
                                    <label class="form-check-label" for="exampleRadios1">
                                        Chờ duyệt
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="exampleRadios2" {{ $product->status==1?'checked':'' }} value="1">
                                    <label class="form-check-label" for="exampleRadios2">
                                        Công khai
                                    </label>
                                </div>
                            </div>
                            
                           </div> 
                           <div class="col-md-6">
                                <div class="form-group">
                                    <label for="product-cat" class="text-strong">Danh mục sản phẩm</label>
                                    <select class="form-control" id="product-cat" name="cat_id">
                                        <option value="">Chọn danh mục</option>
                                        @foreach ($list_cat as $item)
                                            <option value="{{ $item->id }}" {{ $item->id==$product->category_id?'selected':'' }}>{{ str_repeat('---',$item->level).$item->cat_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                           </div> 
                        </div>
                        
                        <div class="row my-md-5"> 
                            <div class="col-md-12">
                             <div class="form-group">
                                 @error('file')
                                    <small class="text-danger">{{ $message }}</small>
                                 @enderror
                                 <label for="upload_file_product" class="text-strong form-label d-block mb-md-4 h">Ảnh mô tả(Hiện tại chức năng chỉ có hiển thị ảnh chưa thể cập nhật lại ảnh hay xóa ảnh.)</label>
                                 <input type="file" class="form-control d-none" name="file[]" id="upload_file_product" multiple disabled>
                                 <div class="list-img d-flex flex-wrap">
                                     <label for="upload_file_product" class="form-label mb-0"><i class="fa-solid fa-plus border border-primary rounded h3 mt-1" style="padding:35px 40px"></i></label>
                                     <!-- Hiển thị ảnh đã upload -->
                                     {{-- <div class="item-thumb"><div class="before-delete"></div><img src="http://localhost/Project-Laravel/ismart/admin/public/uploads/post-1.jpg" alt="" ><i class="fa-solid fa-circle-xmark closee"></i></div>
                                     <div class="item-thumb"><div class="before-delete"></div><img src="http://localhost/Project-Laravel/ismart/admin/public/uploads/post-1.jpg" alt="" ><i class="fa-solid fa-circle-xmark closee"></i></div> --}}
                                        @if (!empty($product->list_img_product))
                                              @foreach (json_decode($product->list_img_product) as $item)
                                            <div class="item-thumb"><div class="before-delete"></div><img class="img-thumbnail p-0" data-id="{{ $item->id }}" src="{{ url("{$item->name}") }}" alt="" ></div> 
                                           @endforeach
                                        @endif
                                      
                                         
                                 </div>
                                 @error('file')
                                     <small class="text-danger">{{ $message }}</small>
                                 @enderror
                             </div>
                            </div> 
                         </div>
                    </div>
                </div>


                <div class="form-group my-md-5">
                    <label for="intro1" class="text-strong">Chi tiết sản phẩm</label>
                    <textarea name="content" class="form-control textarea" id="" cols="30" rows="15">{{ $product->content }}</textarea>
                         @error('content')
                             <small class="text-danger">{{ $message }}</small>
                         @enderror
                </div>
                <div class="form-group">
                    <label for="intro2" class="text-strong">Mô tả sản phẩm</label>
                    <textarea name="desc" class="form-control textarea" id="" cols="30" rows="15">{{ $product->desc }}</textarea>
                         @error('desc')
                           <small class="text-danger">{{ $message }}</small>
                        @enderror
                </div>
                <div class="row">
                    <div class="col-md-4">
                       <div class="form-check form-group">
                    <input type="checkbox" name="productTop[]" value="topWatch" id="productTop-1" {{ $product->topwatch=='topWatch'?'checked':'' }}>
                    <label for="productTop-1" class="text-strong">Sản phẩm nổi bật</label>
                </div>
                <div class="form-check form-group">
                    <input type="checkbox" name="productTop[]" value="topSale" id="productTop-2" {{ $product->topsale=='topSale'?'checked':'' }}>
                    <label for="productTop-2" class="text-strong">Sản phẩm bán chạy</label>
                </div> 
                    </div>
                    <div class="col-md-8">
                      <div class="form-group">
                    <label for="brand" class="text-strong">Sản phẩm thuộc hãng</label>
                    <select class="form-control" id="brand" name="brand_id">
                        <option value="">Chọn danh mục</option>
                        @foreach ($list_brand as $item)
                            <option value="{{ $item->id }}" {{ $item->id==$product->brand_id?'selected':'' }}>{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>  
                    </div>
                </div>
                
                
                <button type="submit" name="btn-update" value="Cập nhật" class="btn btn-primary">Cập nhật</button>
            </form>
        </div>
    </div>
</div>
@endsection