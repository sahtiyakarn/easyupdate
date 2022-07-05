@extends('admin.layouts.app')
@section('mycss')
    <!-- Datatables -->
    <link href="{{ asset('assets/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css') }}"
        rel="stylesheet">
    <link href="{{ asset('assets/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css') }}"
        rel="stylesheet">
    <link href="{{ asset('assets/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css') }}" rel="stylesheet">
    <!-- iCheck -->
    <link href="{{ asset('assets/vendors/iCheck/skins/flat/green.css') }}" rel="stylesheet">
@endsection
@section('myjs')
    <!-- Datatables -->
    <script src="{{ asset('assets/vendors/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>

    <script src="{{ asset('assets/vendors/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/datatables.net-buttons/js/buttons.print.min.js') }}"></script>

    <script src="{{ asset('assets/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js') }}"></script>

    <script src="{{ asset('assets/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js') }}"></script>
    <script src="{{ asset('assets/vendors/datatables.net-scroller/js/dataTables.scroller.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/jszip/dist/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/pdfmake/build/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/pdfmake/build/vfs_fonts.js') }}"></script>
    <!-- iCheck -->
    <script src="{{ asset('assets/vendors/iCheck/icheck.min.js') }}"></script>
    <!-- jquery.inputmask -->
    <script src="{{ asset('assets/vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js') }}"></script>
    <!-- Barnch js -->
    <script src="{{ asset('js/branch.js') }}"></script>
    <script>
        var APP_URL = {!! json_encode(url('/')) !!}
        $(document).ready(function() {
            $('#datatable-responsive').DataTable({
                order: [
                    [0, 'desc']
                ],
            });
        });
    </script>
@endsection
@section('body-container')
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h4>Admission Details </h4>
                </div>

                <div class="title_right">
                    <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                        <div class="input-group">
                            <input type="text" class="form-control" value="Add New Branch Staff" readonly>
                            <span class="input-group-btn">
                                <button class="btn btn-secondary" type="button" data-toggle="modal"
                                    data-target="#staff-modal">Go!</button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel">
                        <div class="x_content">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card-box table-responsive">
                                        <table id="datatable-responsive"
                                            class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
                                            width="100%">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Reg</th>
                                                    <th>Admission Date</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Photo</th>
                                                    <th>Time</th>
                                                    <th>Course</th>
                                                    <th>guardion_name</th>
                                                    <th>mother_name</th>
                                                    <th>address</th>
                                                    <th>contact_no</th>
                                                    <th>Fee</th>
                                                    <th>qualification</th>
                                                    <th>birth_date</th>
                                                    <th>gender</th>
                                                    <th>fee_no</th>
                                                    <th>fee_information</th>
                                                    <th>is_active</th>
                                                    <th>Comment</th>
                                                    <th>Set No</th>
                                                    <th class="text-right no-sort">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($studentname as $item)
                                                    <tr>
                                                        <td> {{ $item->id }}</td>
                                                        <td>{{ $item->registration }}</td>
                                                        <td> {{ $item->admission_date }}</td>
                                                        <td>{{ $item->name }}</td>

                                                        <td class="text-lowercase">{{ $item->email }}</td>
                                                        <td class="text-lowercase"><img
                                                                src="{{ asset('admin_profile_photo/' . $item->profile_photo) }}"
                                                                alt="{{ $item->profile_photo }}" style="width: 3em;">
                                                        </td>
                                                        <td>
                                                            <a href="{{ url('admission_edit/' . Crypt::encrypt($item->id)) }}"
                                                                class="btn btn-info btn-xs">
                                                                <i class="fa fa-pencil"></i> </a>

                                                            <a href="#" class="btn btn-danger btn-xs"><i
                                                                    class="fa fa-trash-o"></i> </a>
                                                        </td>
                                                        <td> {{ $item->batch_time }}</td>
                                                        <td>
                                                            @php
                                                                preg_match('#\((.*?)\)#', $item->course, $match);
                                                                $course_name = isset($match[1]) ? $match[1] : null;
                                                            @endphp
                                                            {{ $course_name ? $course_name : $item->course }}
                                                        </td>
                                                        <td>{{ $item->guardion_name }}</td>
                                                        <td>{{ $item->mother_name }}</td>

                                                        <td> {{ $item->address }}</td>
                                                        <td>{{ $item->contact_no }}</td>
                                                        <td> {{ $item->fee }}</td>
                                                        <td> {{ $item->qualification }}</td>
                                                        <td>{{ $item->birth_date }}</td>
                                                        <td>{{ $item->gender }}</td>
                                                        <td>{{ $item->fee_no }}</td>
                                                        <td> {{ $item->fee_information }}</td>
                                                        <td> {{ $item->is_active }}</td>
                                                        <td>{{ $item->usercomment->comment }}</td>
                                                        <td>{{ $item->userseat->seat_no }}</td>

                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
