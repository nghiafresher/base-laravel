@extends('admin.layouts.index')
@section('content')
    <div class="content-wrapper" style="min-height: 1345.31px;">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        @include('common.message')
                        <h1>Vai trò</h1>
                    </div>
                </div>
            </div>
        </section>
        <form action="{{ $routeForm }}" method="POST">
            @csrf
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title">Sửa vai trò</h3>
                                </div>
                                @include('admin.role.includes.form',  [
                                    'role' => $role
                                ])
                            </div>
                        </div>
                    </div>
                    @include('admin.role.includes.item_permission_form', [
                        'role' => $role,
                        'permissions' => $permissions
                    ])
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">Cập nhật</button>
                    </div>
                </div>
            </section>
        </form>
    </div>
@endsection

