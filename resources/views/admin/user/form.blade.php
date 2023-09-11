@include('common.message')
<form action="{{ $routeForm }}" method="POST">
    @csrf
    <div class="card-body">
        <div class="form-group">
            <label for="name">Họ và tên <span class="text-danger">*</span></label>
            <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Họ và tên">
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="email">Email <span class="text-danger">*</span></label>
            <input type="text" name="email" value="{{ old('email') }}" class="form-control" id="email" placeholder="Email">
            @error('email')
               <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="phone">Số điện thoại</label>
            <input type="text" name="phone" value="{{ old('phone') }}" class="form-control" id="phone" placeholder="Số điện thoại">
            @error('phone')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="password">Mật khẩu</label>
            <input type="password" name="password" class="form-control" id="password" placeholder="Mật khẩu">
            @error('password')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="re_password">Nhập lại mật khẩu</label>
            <input type="password" name="re_password" class="form-control" id="re_password" placeholder="Mật khẩu">
            @error('re_password')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="image">Ảnh đại diện</label>
            <div class="input-group">
                <div class="custom-file">
                    <input type="file" name="image" class="custom-file-input" id="image">
                    <label class="custom-file-label" for="image">Ảnh đại diện</label>
                </div>
            </div>
            @error('image')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Lưu</button>
    </div>
</form>
