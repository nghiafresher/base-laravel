@extends('admin.layouts.index')
@section('content')
    <div class="content-wrapper" style="min-height: 1302.12px;">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Quyền</h1>
                        @can('create', \App\Models\Permission::class)
                            <a href="{{ route('admin.permission.create') }}" type="button" class="btn btn-info btn-sm mt-3">Thêm mới</a>
                        @endcan
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Danh sách</h3>
                                <div class="card-tools">
                                    <div class="input-group input-group-sm" style="width: 150px;">
                                        <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-default">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body table-responsive p-0">
                                <table class="table table-head-fixed text-nowrap">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Định danh</th>
                                        <th>Tên hiển thị</th>
                                        <th>Model</th>
                                        <th>Mô tả</th>
                                        <th>Hành động</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($permissions as $item)
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->display_name }}</td>
                                            <td>{{ $item->model_name }}</td>
                                            <td>{{ $item->description }}</td>
                                            <td>
                                                @can('update', $item)
                                                    <a href="{{ route('admin.permission.edit', $item->id) }}" class="mr-2" title="Sửa">
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
