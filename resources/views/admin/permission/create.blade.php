@extends('admin.layouts.index')
@section('content')
    <div class="content-wrapper" style="min-height: 1345.31px;">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        @include('common.message')
                        <h1>Quyền</h1>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-6">

                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Thêm quyền</h3>
                            </div>
                            @include('admin.permission.form', ['routeForm' => $routeForm])
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
@endsection


