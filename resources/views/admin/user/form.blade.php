<form action="{{ $routeForm }}" method="POST">
    @csrf
    <div class="row">
        <div class="col-md-6">

            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">{{ $titlePage }}</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Họ và tên <span class="text-danger">*</span></label>
                        <input type="text" name="name" value="{{ old('name', isset($user) ? $user->name : '') }}" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Họ và tên">
                        @error('name')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email <span class="text-danger">*</span></label>
                        <input type="text" name="email" value="{{ old('email', isset($user) ? $user->email : '') }}" class="form-control" id="email" placeholder="Email">
                        @error('email')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="phone">Số điện thoại</label>
                        <input type="text" name="phone" value="{{ old('phone', isset($user) ? $user->phone : '') }}" class="form-control" id="phone" placeholder="Số điện thoại">
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
                    {{--    <div class="form-group">--}}
                    {{--        <label for="image">Ảnh đại diện</label>--}}
                    {{--        <div class="input-group">--}}
                    {{--            <div class="custom-file">--}}
                    {{--                <input type="file" name="image" class="custom-file-input" id="image">--}}
                    {{--                <label class="custom-file-label" for="image">Ảnh đại diện</label>--}}
                    {{--            </div>--}}
                    {{--        </div>--}}
                    {{--        @error('image')--}}
                    {{--        <div class="text-danger">{{ $message }}</div>--}}
                    {{--        @enderror--}}
                    {{--    </div>--}}
                </div>
            </div>

        </div>
    </div>
    @if($roles)
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Vai trò</h3>
                    </div>
                    <div class="card-body">
                        @foreach($roles as $role)
                            @php
                                $checked = false;
                                if(isset($user) && $user->roles) {
                                    if($user->roles->contains('id', $role->id)) {
                                        $checked = true;
                                    }
                                }
                            @endphp
                            <div class="form-group">
                                <input type="checkbox" name="role_ids[]" {{ $checked ? 'checked' : '' }} value="{{ $role->id }}" data-bootstrap-switch data-on-color="success">
                                <label class="ml-1" for="name">{{ $role->name }} - {{ $role->display_name }}</label>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="card-footer">
        <button type="submit" class="btn btn-info">Cập nhật</button>
    </div>
</form>


