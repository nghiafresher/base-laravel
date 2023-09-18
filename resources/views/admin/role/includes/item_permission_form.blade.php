@if($permissions)
    <div class="row">
        @foreach($permissions as $model => $groupPermission)
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ $model }}</h3>
                    </div>
                    <div class="card-body">
                        @foreach($groupPermission as $permission)
                            @php
                                $checked = false;
                                if(isset($role) && $role->permissions->isNotEmpty()) {
                                   if($role->permissions->contains('id', $permission->id)) {
                                       $checked = true;
                                   }
                                }
                            @endphp
                            <div class="form-group">
                                <input type="checkbox" name="permission_ids[]" value="{{ $permission->id }}" {{ $checked ? 'checked' : '' }} data-bootstrap-switch data-on-color="success">
                                <label for="name">{{ $permission->name }}<span class=""> - {{ $permission->display_name }}</span></label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif

