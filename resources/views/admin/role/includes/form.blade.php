<div class="card-body">
    <div class="form-group">
        <label for="name">Định danh<span class="text-danger">*</span></label>
        <input type="text" name="name" value="{{ old('name', isset($role) ? $role->name : '') }}"
               class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Định danh">
        @error('name')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="display_name">Tên vai trò <span class="text-danger">*</span></label>
        <input type="text" name="display_name" value="{{ old('display_name', isset($role) ? $role->display_name : '') }}"
               class="form-control" id="display_name" placeholder="Tên vai trò">
        @error('display_name')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="phone">Mổ tả ngắn</label>
        <textarea name="description" class="form-control" id="description"
                  placeholder="Mô tả ngắn">{{ old('description', isset($role) ? $role->description : '') }}</textarea>
        @error('description')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
</div>
