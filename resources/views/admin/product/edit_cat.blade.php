@extends('layouts.admin')
@section('content')
<div id="content" class="container-fluid">
    <div class="row">
        <div class="col-4">
            <div class="card">
                @if (session('status'))
                   <div class="alert alert-success">{{ session('status') }}</div> 
                @endif
                <div class="card-header font-weight-bold">
                    Cập nhật danh mục
                </div>
                <div class="card-body">
                    <form action="{{ route('update_cat',$cat->id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Tên danh mục</label>
                            <input class="form-control" type="text" name="name" id="title" value="{{ $cat->cat_name }}" onkeyup="ChangeToSlug();">
                            @error('name')
                              <small class="text-danger">{{ $message }}</small>  
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="slug" class="text-strong">Link slug</label>
                            <input class="form-control" type="text" name="slug" value="{{ $cat->slug }}" id="slug">
                        </div>
                        {{-- <div class="form-group">
                            <label for="parent_id">Danh mục cha</label>
                            <select class="form-control" id="parent_id" name="parent_id">
                                <option>Chọn danh mục</option>
                                <option value="0" selected>Danh mục cha mới</option>
                                @foreach ($list_cat as $cat)
                                    <option value="{{ $cat->id }}">{{ str_repeat('---',$cat->level).$cat->cat_name }}</option>
                                @endforeach
                            </select>
                        </div> --}}
                        <div class="form-group">
                            <label for="">Trạng thái</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="exampleRadios1" value="0" {{ ($cat->parent==0)?'checked':'' }} >
                                <label class="form-check-label" for="exampleRadios1">
                                    Chờ duyệt
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="exampleRadios2" value="1" {{ ($cat->parent==1)?'checked':'' }}>
                                <label class="form-check-label" for="exampleRadios2">
                                    Công khai
                                </label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary" name="btn-update" value="Cập nhật">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection