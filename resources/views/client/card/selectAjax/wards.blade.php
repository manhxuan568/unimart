<option value="" disabled selected>Chọn Phường/Xã</option>
   @foreach ($list_wards_by_district as $item)
       <option value="{{ $item->id }}">{{ $item->name }}</option>
   @endforeach
    