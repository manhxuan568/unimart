@extends('layouts.admin')
@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Thêm bài viết
        </div>
        <div class="card-body">
            <form action="{{ url('admin/post/store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name" class="text-strong">Tiêu đề bài viết</label>
                    <input class="form-control" type="text" name="title" id="title" value="{{ old('title') }}" onkeyup="ChangeToSlug();">
                            @error('title')
                            <small class="text-danger">{{ $message }}</small>  
                            @enderror
                </div>
                <div class="form-group">
                    <label for="slug" class="text-strong">Link slug bài viết</label>
                    <input class="form-control" type="text" name="slug" id="slug" value="{{ old('slug') }}">
                    @error('slug')
                      <small class="text-danger">{{ $message }}</small>  
                    @enderror
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="slug" class="text-strong">Chọn ảnh đại diện bài viết</label>
                            <input class="form-control-file" type="file" name="thumb_post" id="slug" value="" >
                            @error('thumb_post')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="parent_id" class="text-strong">Danh mục bài viết</label><br>
                            @error('category_id')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <select class="form-control" id="parent_id" name="category_id">
                                <option value="" selected>Chọn</option>
                                @foreach ($list_cat as $cat)
                                    <option value="{{ $cat->id }}">{{ str_repeat('---',$cat->level).$cat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="textarea" class="text-strong">Nội dung bài viết</label>
                    <textarea name="content" class="form-control textarea" id="textarea" cols="30" rows="10">{{ old('content') }}</textarea>
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