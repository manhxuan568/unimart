@extends('layouts.admin')
@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Thêm trang
        </div>
        <div class="card-body">
            <form action="{{ url('admin/page/store') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="title" class="text-strong">Tiêu đề trang</label>
                    <input class="form-control" type="text" name="title" id="title" onkeyup="ChangeToSlug();">
                            @error('title')
                            <small class="text-danger">{{ $message }}</small>  
                            @enderror
                </div>
                <div class="form-group">
                    <label for="slug" class="text-strong">Link slug trang</label>
                    <input class="form-control" type="text" name="slug" id="slug">
                    @error('slug')
                      <small class="text-danger">{{ $message }}</small>  
                    @enderror
                </div>
                <div class="form-group">
                    <label for="t" class="text-strong">Nội dung trang</label>
                    <textarea name="content" class="form-control textarea" id="t" cols="30" rows="10"></textarea>
                    @error('content')
                        <small class="text-danger">{{ $message }}</small>  
                    @enderror
                </div>
                <div class="form-group">
                    <label for="" class="text-strong">Trạng thái</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="exampleRadios1" value="0" checked>
                        <label class="form-check-label" for="exampleRadios1">
                            Chờ duyệt
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="exampleRadios2" value="1">
                        <label class="form-check-label" for="exampleRadios2">
                            Công khai
                        </label>
                    </div>
                </div>

                <button type="submit" name="btn_add" value="Thêm mới" class="btn btn-primary">Thêm mới</button>
            </form>
        </div>
    </div>
</div>
@endsection