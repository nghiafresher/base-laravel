<form action="{{ $routeForm }}" method="POST">
    @csrf
    <div class="card-body">
        <div class="form-group">
            <label for="name">Định danh<span class="text-danger">*</span></label>
            <input type="text" name="name" {{ isset($permission) ? 'disabled' : '' }} value="{{ old('name', isset($permission) ? $permission->name : '') }}" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Họ và tên">
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="email">Tên hiển thị<span class="text-danger">*</span></label>
            <input type="text" name="display_name" value="{{ old('display_name', isset($permission) ? $permission->display_name : '') }}" class="form-control" id="display_name" placeholder="Tên hiển thị">
            @error('display_name')
               <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="model_name">Model<span class="text-danger">*</span></label>
            <select class="form-control select2" name="model_name" id="model_name" style="width: 100%;">
                <option selected="selected">--Chọn Model--</option>
                @if($models)
                    @foreach($models as $name)
                        <option value="{{ $name }}" {{ isset($permission) && $permission->model_name == $name ? 'selected' : '' }}>{{ $name }}</option>
                    @endforeach
                @endif
            </select>
            @error('model_name')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="phone">Mổ tả ngắn</label>
            <textarea name="description" class="form-control" id="description" placeholder="Mô tả ngắn">{{ old('description', isset($permission) ? $permission->description : '') }}</textarea>
            @error('description')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="card-footer">
        <button type="submit" class="btn btn-info">Lưu</button>
    </div>
</form>
