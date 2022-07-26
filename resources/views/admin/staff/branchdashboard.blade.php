@extends('admin.layouts.app')
@section('body-container')
<div class="right_col" role="main">
    <div class="page-title">
        <div class="title_left">
            <div class="page-body">
                <div class="row">
                    <!-- task, page, download counter  start -->
                    @if (Auth::guard('admin')->user()->is_admin == '2')
                    <div class="col-sm-12 col-md-4 text-center text-white p-3">
                        <div class="card">
                            <div class="row">
                                <div class="col-12 ">
                                    <h4 class="text-warning">{{ $total_branch_curr }}</h4>
                                    <h6 class="text-muted">Branch Add this Month </h6>
                                </div>
                            </div>
                            <div class="card-footer bg-danger ">
                                Total Branch: {{ $total_branch }}
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="col-sm-12 col-md-4 text-center text-white p-3">
                        <div class="card">
                            <div class="row">
                                <div class="col-12">
                                    <h4 class="text-warning">{{ $staffdetails_curr }}</h4>
                                    <h6 class="text-muted"> Add this Month </h6>
                                </div>
                            </div>
                            <div class="card-footer bg-danger ">
                                Total Branch: {{ $total_staff }}
                            </div>
                        </div>
                    </div>

                    <!-- task, page, download counter  end -->

                </div>
            </div>
        </div>
    </div>
</div>
@endsection