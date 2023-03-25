@extends('layouts.admin')
@section('content')
<div id="content" class="container-fluid">
    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-header font-weight-bold">
                    Cập nhập slider
                </div>
                <div class="card-body">
                    <form action="{{ route('update_slider',$slider->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name" class="text-strong">Tên slider</label>
                            <input class="form-control" type="text" name="name" value="{{ $slider->name }}" id="title">
                            @error('name')
                              <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="slug" class="text-strong">Ảnh slider</label>
                            <input class="form-control-file" type="file" name="thumb_slider" id="slug" value="" >
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="shoWthumb-pro"><img src="{{ url("{$slider->thumb_slider}") }}" alt=""></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="link" class="text-strong">Link</label>
                            <input class="form-control" type="text" name="link" id="link" value="{{ $slider->link }}" >
                            @error('link')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="slug" class="text-strong">Mô tả slider</label>
                            <textarea name="slider_desc" id="" class="form-control" cols="30" rows="5">{{ $slider->slider_desc }}</textarea>
                            @error('slider_desc')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Trạng thái</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="exampleRadios1" value="0" {{ $slider->status==0?'checked':'' }}>
                                <label class="form-check-label" for="exampleRadios1">
                                    Chờ duyệt
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="exampleRadios2" value="1" {{ $slider->status==1?'checked':'' }}>
                                <label class="form-check-label" for="exampleRadios2">
                                    Công khai
                                </label>
                            </div>
                        </div>
                        <button type="submit" name="btn-update" class="btn btn-primary" value="Cập nhật">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection