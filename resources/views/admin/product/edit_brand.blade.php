@extends('layouts.admin')
@section('content')
<div id="content" class="container-fluid">
    <div class="row">
        <div class="col-4">
            <div class="card">
                <div class="card-header font-weight-bold">
                    Cập nhật hãng sản phẩm
                </div>
                <div class="card-body">
                    <form action="{{ route('update_brand',$item->id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name" class="text-strong">Tên Hãng</label>
                            <input class="form-control" type="text" name="name" id="title" value="{{ $item->name }}" onkeyup="ChangeToSlug();">
                            @error('name')
                              <small class="text-danger">{{ $message }}</small>  
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="name" class="text-strong">Link slug rút gọn</label>
                            <input class="form-control" type="text" value="{{ $item->slug }}" name="slug" id="slug">
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



                        <button type="submit" name="btn-update" value="Cập nhật" class="btn btn-primary">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection