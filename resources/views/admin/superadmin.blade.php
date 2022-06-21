@extends('admin.layouts.app')
@section('body-container')
    <div class="right_col" role="main">
        <div class="page-title">
            <div class="title_left">
                <div class="page-body">
                    <div class="row">
                        <!-- task, page, download counter  start -->
                        <div class="col-sm-12 col-md-4 text-center text-white">
                            <div class="card">
                                <div class="row">
                                    <div class="col-12">
                                        <h4 class="text-warning">{{ $total_branch_curr }}</h4>
                                        <h6 class="text-muted">Branch Add this Month </h6>
                                    </div>
                                </div>
                                <div class="card-footer bg-danger ">
                                    Total Branch: {{ $total_branch }}
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-4 text-center text-white">
                            <div class="card">
                                <div class="row">
                                    <div class="col-12">
                                        <h4 class="text-warning">{{ $total_branch_curr }}</h4>
                                        <h6 class="text-muted">Branch Add this Month </h6>
                                    </div>
                                </div>
                                <div class="card-footer bg-danger ">
                                    Total Branch: {{ $total_branch }}
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
