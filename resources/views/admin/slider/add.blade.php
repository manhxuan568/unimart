@extends('layouts.admin')
@section('content')
<div id="content" class="container-fluid">
    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-header font-weight-bold">
                    Thêm slider
                </div>
                <div class="card-body">
                    <form action="{{ url('admin/slider/store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name" class="text-strong">Tên slider</label>
                            <input class="form-control" type="text" name="name" id="title">
                            @error('name')
                              <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="slug" class="text-strong">Ảnh slider</label>
                            <input class="form-control-file" type="file" name="thumb_slider" id="slug" value="" >
                            @error('slug')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="link" class="text-strong">Link</label>
                            <input class="form-control" type="text" name="link" id="link" value="" >
                            @error('link')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="slug" class="text-strong">Mô tả slider</label>
                            <textarea name="slider_desc" id="" class="form-control" cols="30" rows="5"></textarea>
                            @error('slider_desc')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Trạng thái</label>
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
                        <button type="submit" name="btn-add" class="btn btn-primary" value="Thêm mới">Thêm mới</button>
                    </form>
                </div>
            </div>
        </div>
        {{-- <div class="col-8">
            <div class="card">
                <div class="card-header font-weight-bold">
                    Danh mục
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">First</th>
                                <th scope="col">Last</th>
                                <th scope="col">Handle</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Jacob</td>
                                <td>Thornton</td>
                                <td>@fat</td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>Larry</td>
                                <td>the Bird</td>
                                <td>@twitter</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div> --}}
    </div>

</div>
@endsection