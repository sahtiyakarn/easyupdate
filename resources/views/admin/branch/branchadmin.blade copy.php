@extends('admin.layouts.app')
@section('extracss')
<!-- animation nifty modal window effects css -->
<link rel="stylesheet" type="text/css" href="{{ asset('files/assets/css/component.css') }}">
<!-- jquery file upload Frame work -->
<link href="{{ asset('files/assets/pages/jquery.filer/css/jquery.filer.css') }}" type="text/css" rel="stylesheet" />
<link href="{{ asset('files/assets/pages/jquery.filer/css/themes/jquery.filer-dragdropbox-theme.css') }}" type="text/css" rel="stylesheet" />
<!-- Data Table Css -->
<link rel="stylesheet" type="text/css" href="{{ asset('files/bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('files/assets/pages/data-table/css/buttons.dataTables.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('files/bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('files/assets/pages/data-table/extensions/responsive/css/responsive.dataTables.css') }}">
@endsection
@section('extrajs')
<!-- jquery file upload js -->
<script src="{{ asset('files/assets/pages/jquery.filer/js/jquery.filer.min.js') }}"></script>
<script src="{{ asset('files/assets/pages/filer/custom-filer.js') }}" type="text/javascript"></script>
<script src="{{ asset('files/assets/pages/filer/jquery.fileuploads.init.js') }}" type="text/javascript"></script>
<!-- Model animation js -->
<script src="{{ asset('files/assets/js/classie.js') }}"></script>
{{-- <script src="{{ asset('files/assets/js/modalEffects.js') }}"></script> --}}
<!-- Barnch js -->
<!-- <script src="{{ asset('js/branch.js') }}"></script> -->
<!-- data-table js -->
<script src="{{ asset('files/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('files/bower_components/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('files/assets/pages/data-table/js/jszip.min.js') }}"></script>
<script src="{{ asset('files/assets/pages/data-table/js/pdfmake.min.js') }}"></script>
<script src="{{ asset('files/assets/pages/data-table/js/vfs_fonts.js') }}"></script>
<script src="{{ asset('files/assets/pages/data-table/extensions/responsive/js/dataTables.responsive.min.js') }}">
</script>
<script src="{{ asset('files/bower_components/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('files/bower_components/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('files/bower_components/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('files/bower_components/datatables.net-responsive/js/dataTables.responsive.min.js') }}">
</script>
<script src="{{ asset('files/bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}">
</script>
<!-- Custom js -->
<script src="{{ asset('files/assets/pages/data-table/extensions/responsive/js/responsive-custom.js') }}"></script>
<script>
    var APP_URL = {
        !!json_encode(url('/')) !!
    }
</script>
@endsection
@section('body-container')
<div class="page-body">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>Product List</h5>
                    <button type="button" class="btn btn-sm btn-round btn-primary waves-effect waves-light f-right d-inline-block md-trigger" data-toggle="modal" data-target="#Modal-branch">
                        <i class="icofont icofont-plus m-r-5"></i>
                        Add Branch </button>
                </div>
                <div class="card-block">
                    {{-- <table id="res-config" class="table-bordered table-hover table-striped text-capitalize"
                            style="width: 100%"> --}}
                    <table id="res-config" class="display">
                        <thead>
                            <tr>
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
                                <td>
                                    {{ $item->id }}
                                    <br>
                                    <span>
                                        {{ $item->is_admin ? 'Admin' : 'Staff' }}
                                    </span>
                                </td>
                                <td>{{ $item->is_admin ? 'Admin' : 'Staff' }}</td>
                                <td>{{ $item->name }}</td>
                                <td class="text-lowercase">{{ $item->email }}</td>
                                <td>{{ $item->branch_name }}</td>
                                <td>{{ $item->branch_type }}</td>
                                <td>{{ $item->contact }}</td>
                                <td>{{ $item->address }}</td>
                                <td>{{ $item->district }}</td>
                                <td>{{ $item->state }} {{ $item->country }}</td>
                                <td class="text-lowercase"><img src="{{ asset('admin_profile_photo/' . $item->profile_photo) }}" alt="{{ $item->profile_photo }}" style="width: 5em;">
                                </td>
                                <td>

                                    <button type="button" id="editBranch" class="tabledit-edit-button btn-primary waves-effect waves-light" value="{{ Crypt::encrypt($item->id) }}" data-toggle="modal" data-target="#edit_branch">
                                        <span class="icofont icofont-ui-edit"></span></button>
                                    <button type="button" class="tabledit-delete-button  btn-danger waves-effect waves-light" style=""><span class="icofont icofont-ui-delete"></span></button>
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
<!--  Start Model start-->
<form action="{{ route('branchstore') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="modal fade modal-flex" id="Modal-branch" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="md-content">
                <h3 class="f-26">Add Branch</h3>
                <div class="form-material">
                    <div class="material-group">
                        <div class="material-addone">
                            <i class="icofont icofont-gift"></i>
                        </div>
                        <div class="form-group form-primary">
                            <input type="text" name="branch_admin_name" class="form-control">
                            <span class="form-bar"></span>
                            <label class="float-label">Branch Admin Name</label>
                        </div>
                    </div>
                    <div class="material-group">
                        <div class="material-addone">
                            <i class="icofont icofont-gift"></i>
                        </div>
                        <div class="form-group form-primary">
                            <input type="text" name="branch_email" class="form-control">
                            <span class="form-bar"></span>
                            <label class="float-label">Branch Email</label>
                        </div>
                    </div>
                    <div class="material-group">
                        <div class="material-addone">
                            <i class="icofont icofont-cur-dollar"></i>
                        </div>
                        <div class="form-group form-primary">
                            <input type="text" name="branch_name" class="form-control">
                            <span class="form-bar"></span>
                            <label class="float-label text-capitalize">branch name</label>
                        </div>
                    </div>
                    <div class="form-group form-primary">
                        <select id="hello-single" name="branch_type" class="form-control stock">
                            <option value="">---- Branch Type ----</option>
                            <option value="Institute">Institute</option>
                            <option value="School">School</option>
                            <option value="Coaching">Coaching</option>
                        </select>
                        <span class="form-bar"></span>
                    </div>
                    <div class="material-group">
                        <div class="material-addone">
                            <i class="icofont icofont-cur-dollar"></i>
                        </div>
                        <div class="form-group form-primary">
                            <input type="text" name="branch_contact" class="form-control">
                            <span class="form-bar"></span>
                            <label class="float-label text-capitalize">Branch Contact</label>
                        </div>
                    </div>
                    <div class="material-group">
                        <div class="material-addone">
                            <i class="icofont icofont-cur-dollar"></i>
                        </div>
                        <div class="form-group form-primary">
                            <input type="text" name="branch_address" class="form-control">
                            <span class="form-bar"></span>
                            <label class="float-label text-capitalize">branch address</label>
                        </div>
                    </div>
                    <div class="material-group">
                        <div class="material-addone">
                            <i class="icofont icofont-cur-dollar"></i>
                        </div>
                        <div class="form-group form-primary">
                            <select id="branch_state" name="branch_state" class="form-control stock">
                                <option value="">---- Branch State ----</option>
                                @foreach ($state as $item)
                                <option value="{{ $item->state_name }}">{{ $item->state_name }}</option>
                                @endforeach
                            </select>
                            <span class="form-bar"></span>
                            <label class="float-label text-capitalize">Branch State</label>
                        </div>
                    </div>
                    <div class="form-group form-primary">
                        <select id="branch_district" name="branch_district" class="form-control stock">
                            <option value="">---- Branch District ----</option>
                        </select>
                        <span class="form-bar"></span>
                    </div>
                    <div class="md-group-add-on form-group form-primary">
                        <span class="md-add-on-file">
                            <button class="btn btn-success waves-effect waves-light">File</button>
                        </span>
                        <div class="md-input-file">
                            <input type="file" class="" name="branch_profile_photo" id="branch_profile_photo">
                            <input type="text" class="md-form-control md-form-file form-control" placeholder="No Choosen FIle">
                            <span class="form-bar"></span>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary waves-effect m-r-20 f-w-600 d-inline-block save_btn">Save</button>
                        <a href="#" data-dismiss="modal" class="btn btn-primary">Close</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="md-overlay"></div>
        <!-- Add Contact Ends Model end-->
    </div>
</form>
<!-- /end  Modal -->

<!--  edit Model start-->
<form action="{{ route('branchupate') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="modal fade modal-flex" id="edit_branch" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <input type="hidden" name="edit_id" id="edit_id">
            <div class="md-content">
                <h3 class="f-26">Edit Branch</h3>
                <div class="form-material">
                    <div class="material-group">
                        <div class="material-addone">
                            <i class="icofont icofont-gift"></i>
                        </div>
                        <div class="form-group form-primary">
                            <input type="text" name="branch_admin_name" id="branch_admin_name" class="form-control">
                            <span class="form-bar"></span>
                            <label class="float-label">Branch Admin Name</label>
                        </div>
                    </div>
                    <div class="material-group">
                        <div class="material-addone">
                            <i class="icofont icofont-gift"></i>
                        </div>
                        <div class="form-group form-primary">
                            <input type="text" name="branch_email" id="branch_email" class="form-control">
                            <span class="form-bar"></span>
                            <label class="float-label">Branch Email</label>
                        </div>
                    </div>
                    <div class="material-group">
                        <div class="material-addone">
                            <i class="icofont icofont-cur-dollar"></i>
                        </div>
                        <div class="form-group form-primary">
                            <input type="text" name="branch_name" id="branch_name" class="form-control">
                            <span class="form-bar"></span>
                            <label class="float-label text-capitalize">branch name</label>
                        </div>
                    </div>
                    <div class="material-group">
                        <div class="material-addone">
                            <i class="icofont icofont-cur-dollar"></i>
                        </div>
                        <div class="form-group form-primary">
                            <select name="branch_type" id="branch_type" class="form-control stock">
                                <option value="Institute">Institute</option>
                                <option value="School">School</option>
                                <option value="Coaching">Coaching</option>
                            </select>
                            <span class="form-bar"></span>
                            <label class="float-label text-capitalize">branch Type</label>
                        </div>
                    </div>
                    <div class="material-group">
                        <div class="material-addone">
                            <i class="icofont icofont-cur-dollar"></i>
                        </div>
                        <div class="form-group form-primary">
                            <input type="text" name="branch_contact" id="branch_contact" class="form-control">
                            <span class="form-bar"></span>
                            <label class="float-label text-capitalize">Branch Contact</label>
                        </div>
                    </div>
                    <div class="material-group">
                        <div class="material-addone">
                            <i class="icofont icofont-cur-dollar"></i>
                        </div>
                        <div class="form-group form-primary">
                            <input type="text" name="branch_address" id="branch_address" class="form-control">
                            <span class="form-bar"></span>
                            <label class="float-label text-capitalize">branch address_</label>
                        </div>
                    </div>
                    <div class="material-group">
                        <div class="material-addone">
                            <i class="icofont icofont-cur-dollar"></i>
                        </div>
                        <div class="form-group form-primary">
                            <select id="branch_state_edit" name="branch_state_edit" class="form-control stock">
                                @foreach ($state as $item)
                                <option value="{{ $item->state_name }}">{{ $item->state_name }}</option>
                                @endforeach
                            </select>
                            <span class="form-bar"></span>
                            <label class="float-label text-capitalize">Branch State</label>
                        </div>
                    </div>
                    <div class="material-group">
                        <div class="material-addone">
                            <i class="icofont icofont-cur-dollar"></i>
                        </div>
                        <div class="form-group form-primary">
                            <select id="branch_district_edit" name="branch_district_edit" class="form-control stock">
                                @foreach ($district as $item)
                                <option value="{{ $item->district_name }}">{{ $item->district_name }}
                                </option>
                                @endforeach
                            </select>
                            <span class="form-bar"></span>
                            <label class="float-label text-capitalize">Branch District</label>
                        </div>
                    </div>
                    <div class="md-group-add-on form-group form-primary">
                        <span class="md-add-on-file">
                            <button class="btn btn-success waves-effect waves-light">File</button>
                        </span>
                        <div class="md-input-file">
                            <input type="file" class="" name="branch_profile_photo" id="branch_profile_photo">
                            <input type="text" class="md-form-control md-form-file form-control" placeholder="No Choosen FIle">
                            <span class="form-bar"></span>
                        </div>
                    </div>

                    <div class="form-group form-primary">
                        <img src="" alt="branch_profile_photo_show" id="branch_profile_photo_show" name="branch_profile_photo_show" class="img-fluid" width="70px">
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary waves-effect m-r-20 f-w-600 d-inline-block save_btn">Save</button>
                        <a href="#" data-dismiss="modal" class="btn btn-primary">Close</a>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="md-overlay"></div> --}}
        <!-- Add Contact Ends Model end-->
    </div>
</form>
<!-- /edit  Modal -->
@endsection