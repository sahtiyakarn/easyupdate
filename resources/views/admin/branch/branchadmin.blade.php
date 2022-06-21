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
    {{-- <!-- bootstrap-wysiwyg -->
    <link href="{{ asset('assets/vendors/google-code-prettify/bin/prettify.min.css') }}" rel="stylesheet">
    <!-- Select2 -->
    <link href="{{ asset('assets/vendors/select2/dist/css/select2.min.css') }}" rel="stylesheet">
    <!-- Switchery -->
    <link href="{{ asset('assets/vendors/switchery/dist/switchery.min.css') }}" rel="stylesheet">
    <!-- starrr -->
    <link href="{{ asset('assets/vendors/starrr/dist/starrr.css') }}" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="{{ asset('assets/vendors/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet"> --}}
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
                    <h4>Branch Details </h4>
                </div>

                <div class="title_right">
                    <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                        <div class="input-group">
                            <input type="text" class="form-control" value="Add New Branch" readonly>
                            <span class="input-group-btn">
                                <button class="btn btn-secondary" type="button" data-toggle="modal"
                                    data-target=".bs-example-modal-sm">Go!</button>
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
                                                    {{-- <th>Photo</th> --}}
                                                    <th>ID</th>
                                                    <th>Is_Admin</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Branch Name</th>
                                                    <th>Type</th>
                                                    <th>Contact</th>
                                                    <th>Address</th>
                                                    <th>District</th>
                                                    <th>State</th>
                                                    <th>Photo</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($branchdetails as $item)
                                                    <tr>
                                                        {{-- <td class="text-lowercase"><img
                                                                src="{{ asset('admin_profile_photo/' . $item->profile_photo) }}"
                                                                alt="{{ $item->profile_photo }}" style="width: 3em;">
                                                        </td> --}}
                                                        <td> {{ $item->id }}</td>
                                                        <td>{{ $item->is_admin ? 'Admin' : 'Staff' }}</td>
                                                        <td>{{ $item->name }}</td>
                                                        <td class="text-lowercase">{{ $item->email }}</td>
                                                        <td>{{ $item->branch_name }}</td>
                                                        <td>{{ $item->branch_type }}</td>
                                                        <td>{{ $item->contact }}</td>
                                                        <td>{{ $item->address }}</td>
                                                        <td>{{ $item->district }}</td>
                                                        <td>{{ $item->state }} {{ $item->country }}</td>
                                                        <td class="text-lowercase"><img
                                                                src="{{ asset('admin_profile_photo/' . $item->profile_photo) }}"
                                                                alt="{{ $item->profile_photo }}" style="width: 3em;">
                                                        </td>
                                                        <td>

                                                            <button class="btn btn-info btn-xs" id="editBranch"
                                                                data-toggle="modal" data-target="#bs-example-modal-sm-edit"
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

<!-- Add Branch Modal -->
<form action="{{ route('branchstore') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-body">
                    <label for="fullname">Full Name * :</label>
                    <input type="text" class="form-control form-control-sm" name="branch_admin_name" required />

                    <label for="email">Email * :</label>
                    <input type="email" class="form-control form-control-sm" name="branch_email"
                        data-parsley-trigger="change" required />

                    {{-- <label>Is Admin *:</label>
                    <p>
                        Yes:
                        <input type="radio" class="flat" name="gender" id="genderM" value="M" checked=""
                            required /> No:
                        <input type="radio" class="flat" name="gender" id="genderF" value="F" />
                    </p> --}}
                    <label for="fullname">Branch Name * :</label>
                    <input type="text" class="form-control form-control-sm" name="branch_name" required />

                    {{-- <label>Hobbies (2 minimum):</label>
                    <p style="padding: 5px;">
                        <input type="checkbox" name="hobbies[]" id="hobby1" value="ski" data-parsley-mincheck="2"
                            required class="flat" /> Skiing
                        <br />

                        <input type="checkbox" name="hobbies[]" id="hobby2" value="run" class="flat" /> Running
                        <br />

                        <input type="checkbox" name="hobbies[]" id="hobby3" value="eat" class="flat" />
                        Eating
                        <br />

                        <input type="checkbox" name="hobbies[]" id="hobby4" value="sleep" class="flat" />
                        Sleeping
                        <br />
                    <p> --}}

                    <label for="heard">Branch Type *:</label>
                    <select name="branch_type" class="form-control form-control-sm" required>
                        <option value="">Choose..</option>
                        <option value="Institute">Institute</option>
                        <option value="School">School</option>
                        <option value="Coaching">Coaching</option>
                    </select>

                    <label for="message">address :</label>
                    <textarea required="required" class="form-control form-control-sm" name="branch_address" data-parsley-trigger="keyup"
                        data-parsley-minlength="20" data-parsley-maxlength="100"
                        data-parsley-minlength-message="Come on! You need to enter at least a 20 caracters long comment.."
                        data-parsley-validation-threshold="10"></textarea>
                    <label for="heard">Branch State *:</label>
                    <select id="branch_state" name="branch_state" class="form-control form-control-sm" required>
                        <option value="">Choose..</option>
                        @foreach ($state as $item)
                            <option value="{{ $item->state_name }}">{{ $item->state_name }}</option>
                        @endforeach
                    </select>
                    <label for="heard">Branch District *:</label>
                    <select id="branch_district" name="branch_district" class="form-control form-control-sm">
                        <option value="">Choose..</option>
                    </select>
                    <label for="fullname">Branch Contact * :</label>
                    <input type="text" class="form-control form-control-sm"
                        data-inputmask="'mask' : '999-999-9999'" name="branch_contact">
                    <label for="fullname">Upload Image :</label>
                    <input type="file" class="form-control form-control-sm" name="branch_profile_photo">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-xs btn-round"
                        data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-xs btn-round">Save changes</button>
                </div>

            </div>
        </div>
    </div>
</form>
<!-- Add Branch Modal -->

<!-- Edit Branch Modal -->
<form action="{{ route('branchupate') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="modal fade" id="bs-example-modal-sm-edit" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <input type="hidden" name="edit_id" id="edit_id">
                <div class="modal-body">
                    <label for="fullname">Full Name * :</label>
                    <input type="text" class="form-control form-control-sm" id="branch_admin_name"
                        name="branch_admin_name" required />

                    <label for="email">Email * :</label>
                    <input type="email" class="form-control form-control-sm" name="branch_email" id="branch_email"
                        data-parsley-trigger="change" required />

                    {{-- <label>Is Admin *:</label>
                    <p>
                        Yes:
                        <input type="radio" class="flat" name="gender" id="genderM" value="M" checked=""
                            required /> No:
                        <input type="radio" class="flat" name="gender" id="genderF" value="F" />
                    </p> --}}
                    <label for="fullname">Branch Name * :</label>
                    <input type="text" class="form-control form-control-sm" name="branch_name" id="branch_name"
                        required />

                    {{-- <label>Hobbies (2 minimum):</label>
                    <p style="padding: 5px;">
                        <input type="checkbox" name="hobbies[]" id="hobby1" value="ski" data-parsley-mincheck="2"
                            required class="flat" /> Skiing
                        <br />

                        <input type="checkbox" name="hobbies[]" id="hobby2" value="run" class="flat" /> Running
                        <br />

                        <input type="checkbox" name="hobbies[]" id="hobby3" value="eat" class="flat" />
                        Eating
                        <br />

                        <input type="checkbox" name="hobbies[]" id="hobby4" value="sleep" class="flat" />
                        Sleeping
                        <br />
                    <p> --}}

                    <label for="heard">Branch Type *:</label>
                    <select name="branch_type"id="branch_type" class="form-control form-control-sm" required>
                        <option value="">Choose..</option>
                        <option value="Institute">Institute</option>
                        <option value="School">School</option>
                        <option value="Coaching">Coaching</option>
                    </select>

                    <label for="message">address :</label>
                    <textarea required="required" class="form-control form-control-sm" name="branch_address" id="branch_address"
                        data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100"
                        data-parsley-minlength-message="Come on! You need to enter at least a 20 caracters long comment.."
                        data-parsley-validation-threshold="10"></textarea>
                    <label for="heard">Branch State *:</label>
                    <select id="branch_state_edit" name="branch_state_edit" class="form-control form-control-sm"
                        required>
                        @foreach ($state as $item)
                            <option value="{{ $item->state_name }}">{{ $item->state_name }}</option>
                        @endforeach
                    </select>
                    <label for="heard">Branch District *:</label>
                    <select id="branch_district_edit" name="branch_district_edit"
                        class="form-control form-control-sm">
                        @foreach ($district as $item)
                            <option value="{{ $item->district_name }}">{{ $item->district_name }}
                            </option>
                        @endforeach
                    </select>
                    <label for="fullname">Branch Contact * :</label>
                    <input type="text" class="form-control form-control-sm"
                        data-inputmask="'mask' : '999-999-9999'" name="branch_contact"id="branch_contact">
                    <label for="fullname">Upload Image :</label>
                    <input type="file" class="form-control form-control-sm" name="branch_profile_photo">
                    <br>
                    <img src="" alt="branch_profile_photo_show" id="branch_profile_photo_show"
                        name="branch_profile_photo_show" class="img-fluid" width="70px">


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-xs btn-round"
                        data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-xs btn-round">Save changes</button>
                </div>

            </div>
        </div>
    </div>
</form>
<!-- Edit Branch Modal -->
