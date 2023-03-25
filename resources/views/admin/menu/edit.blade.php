@extends('layouts.admin')
@section('content')
<div id="content" class="container-fluid">
    <div class="row">
        <div class="col-4">
            <div class="card">
                <div class="card-header font-weight-bold">
                    Cập nhật menu
                </div>
                <div class="card-body">
                    <form action="{{ route('update_menu', $menu->id) }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="name">Tên menu</label>
                            <input class="form-control" type="text" name="name" id="title" value="{{ $menu->name }}" onkeyup="ChangeToSlug();">
                            @error('name')
                              <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="slug">Link Slug</label>
                            <input class="form-control" type="text" name="slug" id="slug" value="{{ $menu->slug }}" >
                            @error('slug')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        {{-- <div class="form-group">
                            <label for="slug">Position(number)</label>
                            <input class="form-control" type="number" min="1" name="position" id="position" value="" >
                            @error('position')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div> --}}
                        <div class="form-group">
                            <label for="">Danh mục cha(không chọn đồng nghĩa là danh mục cha)</label>
                            <select class="form-control" id="" name="parent_id">
                                <option value="0">Chọn danh mục</option>
                                @foreach ($menu_parent as $parent)
                                    <option value="{{ $parent->id }}" {{ $parent->id==$menu->parent_id?'selected':''}}>{{ str_repeat('---', $parent->level).$parent->name }}</option>
                                @endforeach
                            </select>
                            @error('parent_id')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Trạng thái</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="exampleRadios1" value="0" {{ $menu->status== 0?'checked':''}}>
                                <label class="form-check-label" for="exampleRadios1">
                                    Chờ duyệt
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="exampleRadios2" value="1" {{ $menu->status == 1?'checked':''}}>
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