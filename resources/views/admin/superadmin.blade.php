@extends('admin.layouts.app')
@section('body-container')
<div class="right_col" role="main">
    <div class="page-title">
        <div class="title_left">
            <h4>{{ $web_title}} </h4>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <!-- task, page, download counter  start -->
        @if (Auth::guard('admin')->user()->is_admin == '3')
        <div class="col-sm-12 col-md-4 text-center text-white">
            <div class="card">
                <div class="row">
                    <div class="col-12">
                        <h4 class="text-warning p-3">{{ $total_branch_curr }}</h4>
                        <h6 class="text-muted">Branch Add this Month </h6>
                    </div>
                </div>
                <div class="card-footer bg-danger ">
                    <h2>Total Branch : {{ $total_branch }}</h2>

                </div>
            </div>
        </div>
        @endif
        @if (Auth::guard('admin')->user()->is_admin == '2')
        <div class="col-sm-12 col-md-4 text-center text-white">
            <div class="card">
                <div class="row">
                    <div class="col-12">
                        <h4 class="text-warning p-3">{{ $total_staff_curr }}</h4>
                        <h6 class="text-muted">Staff Add this Month </h6>
                    </div>
                </div>
                <div class="card-footer bg-danger ">
                    <h2>Total Staff : {{ $total_staff }}</h2>

                </div>
            </div>
        </div>
        @endif
        <div class="col-sm-12 col-md-4 text-center text-white">
            <div class="card">
                <div class="row">
                    <div class="col-12">
                        <h4 class="text-warning p-3">{{ $total_user_curr }}</h4>
                        <h6 class="text-muted">User Add this Month </h6>
                    </div>
                </div>
                <div class="card-footer bg-danger ">
                    <h2>Total User : {{ $total_user }}</h2>

                </div>
            </div>
        </div>

        <!-- task, page, download counter  end -->

    </div>
</div>
@endsection
