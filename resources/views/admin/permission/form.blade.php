<form action="{{ $routeForm }}" method="POST">
    @csrf
    <div class="card-body">
        <div class="form-group">
            <label for="name">Định danh<span class="text-danger">*</span></label>
            <input type="text" name="name" value="{{ old('name', isset($permission) ? $permission->name : '') }}" disabled class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Họ và tên">
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
