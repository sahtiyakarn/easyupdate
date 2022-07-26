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
<script src="{{ asset('js/staff.js') }}"></script>
<script>
    var APP_URL = {!! json_encode(url('/')) !!}
</script>

<script>
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
                <h4>staff Details </h4>
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
                                                {{-- <th>Is_Admin</th> --}}
                                                <th>Name</th>
                                                <th>Email</th>
                                                {{-- <th>Branch Name</th> --}}
                                                {{-- <th>Type</th> --}}
                                                <th>Contact</th>
                                                <th>Address</th>
                                                <th>District</th>
                                                <th>State</th>
                                                <th>Photo</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($staffdetails as $item)
                                            <tr>
                                                <td> {{ $item->id }}</td>
                                                {{-- <td>{{ $item->is_admin ? 'Admin' : 'Staff' }}</td> --}}
                                                <td>{{ $item->name }}</td>
                                                <td class="text-lowercase">{{ $item->email }}</td>
                                                {{-- <td>{{ $item->branch_name }}</td> --}}
                                                {{-- <td>{{ $item->branch_type }}</td> --}}
                                                <td>{{ $item->contact }}</td>
                                                <td>{{ $item->address }}</td>
                                                <td>{{ $item->district }}</td>
                                                <td>{{ $item->state }} {{ $item->country }}</td>
                                                <td class="text-lowercase"><img
                                                        src="{{ asset('admin_profile_photo/' . $item->profile_photo) }}"
                                                        alt="{{ $item->profile_photo }}" style="width: 3em;">
                                                </td>
                                                <td>

                                                    <button class="btn btn-info btn-xs" id="editStaff"
                                                        data-toggle="modal" data-target="#staff-modal-edit"
                                                        value="{{ Crypt::encrypt($item->id) }}">
                                                        <i class="fa fa-pencil"></i> </button>

                                                    <a href="#" class="btn btn-danger btn-xs"><i
                                                            class="fa fa-trash-o"></i> </a>
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
            </div>
        </div>
    </div>
</div>
@endsection

<!-- Add Staff Modal -->
<form action="{{ route('staffstore') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="modal fade" id="staff-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-body">
                    <label for="fullname">Staff id * :</label>
                    <input type="text" class="form-control form-control-sm" name="staff_id" id="staff_id" required
                        value="{{ $last_id }}" readonly />

                    <label for="fullname">Staff Full Name * :</label>
                    <input type="text" class="form-control form-control-sm" name="staff_admin_name"
                        id="staff_admin_name" required />

                    <label for="email">Staff Email * :</label>
                    <input type="email" class="form-control form-control-sm" name="staff_email" id="staff_email"
                        data-parsley-trigger="change" required />

                    <label for="message">Staff Address :</label>
                    <textarea required="required" class="form-control form-control-sm" name="staff_address"
                        data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100"
                        data-parsley-minlength-message="Come on! You need to enter at least a 20 caracters long comment.."
                        data-parsley-validation-threshold="10"></textarea>
                    <label for="heard">Staff State *:</label>
                    <select id="staff_state" name="staff_state" class="form-control form-control-sm" required>
                        <option value="">Choose..</option>
                        @foreach ($state as $item)
                        <option value="{{ $item->state_name }}">{{ $item->state_name }}</option>
                        @endforeach
                    </select>
                    <label for="heard">Staff District *:</label>
                    <select id="staff_district" name="staff_district" class="form-control form-control-sm">
                        <option value="">Choose..</option>
                    </select>
                    <label for="fullname">Staff Contact * :</label>
                    <input type="text" class="form-control form-control-sm" data-inputmask="'mask' : '999-999-9999'"
                        name="staff_contact">
                    <label for="fullname">Upload Image :</label>
                    <input type="file" class="form-control form-control-sm" name="staff_profile_photo">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-xs btn-round" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-xs btn-round">Save changes</button>
                </div>

            </div>
        </div>
    </div>
</form>
<!-- Add Staff Modal -->

<!-- Edit Staff Modal -->
<form action="{{ route('staffupate') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="modal fade" id="staff-modal-edit" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <input type="hidden" name="edit_id" id="edit_id">
                <div class="modal-body">
                    <label for="fullname">Staff Full Name * :</label>
                    <input type="text" class="form-control form-control-sm" id="staff_admin_name1"
                        name="staff_admin_name1" required />

                    <label for="email">Staff Email * :</label>
                    <input type="email" class="form-control form-control-sm" name="staff_email1" id="staff_email1"
                        data-parsley-trigger="change" required />




                    <label for="message">Staff Address :</label>
                    <textarea required="required" class="form-control form-control-sm" name="staff_address"
                        id="staff_address" data-parsley-trigger="keyup" data-parsley-minlength="20"
                        data-parsley-maxlength="100"
                        data-parsley-minlength-message="Come on! You need to enter at least a 20 caracters long comment.."
                        data-parsley-validation-threshold="10"></textarea>
                    <label for="heard">Staff State *:</label>
                    <select id="staff_state_edit" name="staff_state_edit" class="form-control form-control-sm" required>
                        @foreach ($state as $item)
                        <option value="{{ $item->state_name }}">{{ $item->state_name }}</option>
                        @endforeach
                    </select>
                    <label for="heard">Staff District *:</label>
                    <select id="staff_district_edit" name="staff_district_edit" class="form-control form-control-sm">
                        @foreach ($district as $item)
                        <option value="{{ $item->district_name }}">{{ $item->district_name }}
                        </option>
                        @endforeach
                    </select>
                    <label for="fullname">Staff Contact * :</label>
                    <input type="text" class="form-control form-control-sm" data-inputmask="'mask' : '999-999-9999'"
                        name="staff_contact" id="staff_contact">
                    <label for="fullname">Upload Image :</label>
                    <input type="file" class="form-control form-control-sm" name="staff_profile_photo">
                    <br>
                    <img src="" alt="staff_profile_photo_show" id="staff_profile_photo_show"
                        name="staff_profile_photo_show" class="img-fluid" width="70px">


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-xs btn-round" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-xs btn-round">Save changes</button>
                </div>

            </div>
        </div>
    </div>
</form>
<!-- Edit Staff Modal -->