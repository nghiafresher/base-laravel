@extends('admin.layouts.index')
@section('content')
    <div class="content-wrapper" style="min-height: 1345.31px;">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        @include('common.message')
                        <h1>Người dùng</h1>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                @include('admin.user.form', ['titlePage' => 'Sửa người dùng', 'user' => $user])
            </div>
        </section>

    </div>
@endsection

