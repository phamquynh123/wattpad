<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
<select name="selected" class="selectRole" class="btn bg-info waves-effect" data-userId={{ $user_id }}>
    <option value=""> --- Chọn Vai trò --- </option>
    @foreach($allRole as $value)
        <option value="{{$value->name}}" data-roleId="{{ $value->id }}">{{ $value->display_name }}</option>
    @endforeach
</select>
