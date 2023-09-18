@extends('admin.layouts.index')
@section('content')
    <div class="content-wrapper" style="min-height: 1302.12px;">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Người dùng</h1>
                        @can('create', \App\Models\User::class)
                            <a href="{{ route('admin.user.create') }}" type="button" class="btn btn-info btn-sm mt-3">Thêm mới</a>
                        @endcan
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        @include('common.message')

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Danh sách</h3>
                                <div class="card-tools">
                                    <div class="input-group input-group-sm">
                                        <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-default">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body table-responsive p-0" style="height: 300px;">
                                <table class="table table-head-fixed text-nowrap">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Họ và tên</th>
                                        <th>Email</th>
                                        <th>Số điện thoại</th>
                                        <th>Ngày tạo</th>
                                        <th>Hành động</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($users as $model)
                                        <tr>
                                            <td>{{ $model->id }}</td>
                                            <td>{{ $model->name }}</td>
                                            <td>{{ $model->email }}</td>
                                            <td>{{ $model->phone }}</td>
                                            <td>{{ $model->created_at }}</td>
                                            <td>
                                                @can('update', $model)
                                                    <a href="{{ route('admin.user.edit', $model->id) }}" class="mr-2" title="Sửa">
                                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                    </a>
                                                @endcan
{{--                                                <a href="" title="Xóa">--}}
{{--                                                    <i class="fa fa-trash text-danger" aria-hidden="true"></i>--}}
{{--                                                </a>--}}
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </section>

    </div>
@endsection
