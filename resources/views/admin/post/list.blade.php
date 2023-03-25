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
        @if (session('alert'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    {{ session('alert') }}
                    <button type="submit" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times</span></button>
                </div> 
        @endif
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h5 class="m-0 ">Danh sách bài viết</h5>
            <div class="form-search form-inline">
                <form action="">
                    <input type="text" class="form-control form-search" name="keyWord" placeholder="Tên bài viết">
                    <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary">
                </form>
                @if (request()->input('keyWord'))
                    <div class="key-word">Tìm kiếm tên bài viết với từ khóa: <strong style="color: #333">{{ request()->input('keyWord') }}</strong></div>
                @endif
            </div>
        </div>
        <div class="card-body">
            <div class="add-url">
                <a href="{{ url('admin/post/add') }}" class="btn btn-success text-white ri" type="button">Thêm mới</a>
            </div>
            <div class="analytic">
                <a href="{{ route('post_status','pending') }}" class="text-primary">Chờ duyệt<span class="text-muted">({{ $count_pending }})</span></a>
                <a href="{{ route('post_status','publish') }}" class="text-primary">Công khai<span class="text-muted">({{ $count_publish }})</span></a>
                <a href="{{ route('post_status','trash') }}" class="text-primary">Thùng rác<span class="text-muted">({{ $count_trash }})</span></a>
            </div>
            <form action="{{ route('action_post') }}" method="post">
                @csrf
                <div class="form-action form-inline py-3">
                    <select class="form-control mr-1" name="act" id="">
                        <option value="">Chọn</option>
                        @foreach ($list_act as $k=>$v)
                            <option value="{{ $k }}">{{ $v }}</option>
                        @endforeach
                        
                    </select>
                    <input type="submit" name="btn-act" value="Áp dụng" class="btn btn-primary">
                    @error('act')
                            <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <table class="table table-striped table-checkall">
                    <thead>
                        <tr>
                            <th scope="col">
                                <input name="checkall" type="checkbox">
                            </th>
                            <th scope="col">#</th>
                            <th scope="col">Ảnh</th>
                            <th scope="col">Tiêu đề</th>
                            <th scope="col">Danh mục</th>
                            <th scope="col">Người tạo</th>
                            <th scope="col">Ngày tạo</th>
                            <th scope="col">Tác vụ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($posts) >0)
                            
                            @php
                            $t=0;
                            @endphp
                            @foreach ($posts as $post)
                                @php
                                    $t++;
                                @endphp
                                    <tr>
                                        <td>
                                            <input type="checkbox" name="list_check[]" value="{{ $post->id }}">
                                        </td>
                                        <td scope="row">{{ $t }}</td>
                                        <td class="thumb-item"><img src="{{ url("{$post->thumb_post}") }}" alt="{{ $post->title }}"></td>
                                        <td ><a href="" class="title" title="{{ $post->title }}">{{ $post->title }}</a></td>
                                        <td><span class="badge badge-primary">{{ $post->category->name }}</span></td>
                                        <td>{{ $post->user->name }}</td>
                                        <td>{{ $post->created_at }}</td>
                                        <td>
                                            @can('edit-post',$post->id)
                                                <a href="{{ route('edit_post', $post->id) }}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>                                               
                                            @endcan
                                            @can('delete-post')
                                                <a href="{{ route('delete_post', $post->id) }}" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete" onclick="return confirm('Bạn có chắc chắn muốn xía menu này?')"><i class="fa fa-trash"></i></a>                                                
                                            @endcan
                                        </td>

                                    </tr>
                            @endforeach

                        @else
                        <tr class="bg-white"><td colspan="8">Không có bản ghi nào.</td></tr>
                        @endif
                        
                        
        
                    </tbody>
                </table>
            </form>    
            {{ $posts->links() }}
        </div>
    </div>
</div>
@endsection