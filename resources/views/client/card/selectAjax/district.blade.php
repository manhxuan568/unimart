
<option value="" disabled selected>Chọn Quận/Huyện</option>
@foreach ($list_district_by_province as $item)
    <option value="{{ $item->id }}">{{ $item->name }}</option>
@endforeach
                                   