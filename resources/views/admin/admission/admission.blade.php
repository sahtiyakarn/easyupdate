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
    <!-- Switchery -->
    <link href="{{ asset('assets/vendors/switchery/dist/switchery.min.css') }}" rel="stylesheet">

    <style>
        input {
            outline: 1px solid;
        }

        select {
            outline: 1px solid;
        }

        #ui-datepicker-div {
            background-color: bisque;
            padding: 10px;
        }
    </style>
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
    <!-- Switchery -->
    <script src="{{ asset('assets/vendors/switchery/dist/switchery.min.js') }}"></script>
    <!-- Barnch js -->
    <script src="{{ asset('js/mycustom.js') }}"></script>
    <!-- ADmission js -->
    <script src="{{ asset('js/admission.js') }}"></script>
    <!-- Datepicker js -->
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
    <script>
        var APP_URL = {!! json_encode(url('/')) !!}
    </script>
@endsection
@section('body-container')
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h4>{{ $web_title }} </h4>
                </div>
                <div class="title_right">
                    <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                        <div class="input-group">
                            <input type="text" class="form-control" value="Add New Branch Student" readonly>
                            <span class="input-group-btn">
                                <button class="btn btn-secondary" type="button" data-toggle="modal"
                                    data-target="#Student-modal">Go!</button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="clearfix"></div>
            <form action="{{ route('admissionstore') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-12 col-sm-12 ">
                        <div class="x_panel">
                            <div class="x_content">
                                <div class="row">
                                    <div class="col-sm-12 col-md-4 mb-2">
                                        <label for="fullname">Student ID * :</label>
                                        <input type="text" class="form-control form-control-sm myborder"
                                            name="student_id" id="student_id" value="{{ $user->id ?? $id }}" />
                                    </div>
                                    <div class="col-sm-12 col-md-4 mb-2">
                                        <label for="fullname">Student Registration * :</label>
                                        <input type="text" class="form-control form-control-sm" name="registration"
                                            id="registration" value="{{ $user->registration ?? '' }}" />

                                    </div>
                                    <div class="col-sm-12 col-md-4 mb-2">
                                        <label for="fullname">Admission Date * :</label>
                                        <input type="text" name="admission_date" id="admission_date"
                                            value="{{ $user->admission_date ?? $today }}"
                                            class="form-control form-control-sm" />
                                    </div>
                                    <div class="col-sm-12 col-md-4 mb-2">
                                        <label for="fullname">Student Full Name * :</label>
                                        <input type="text" class="form-control form-control-sm myborder"
                                            name="Student_name" value="{{ $user->name ?? '' }}" />
                                    </div>
                                    <div class="col-sm-12 col-md-4 mb-2">
                                        <label for="fullname">Student Father's/Husbad's * :</label>
                                        <input type="text" class="form-control form-control-sm myborder"
                                            name="guardion_name" value="{{ $user->guardion_name ?? '' }}" />
                                    </div>
                                    <div class="col-sm-12 col-md-4 mb-2">
                                        <label for="fullname">Student Mother's name * :</label>
                                        <input type="text" class="form-control form-control-sm" name="mother_name"
                                            value="{{ $user->mother_name ?? '' }}" />
                                    </div>
                                    <div class="col-sm-12 col-md-4 mb-2">
                                        <label for="email">Student Email * :</label>
                                        <input type="email" class="form-control form-control-sm" name="email"
                                            value="{{ $user->email ?? '' }}" />
                                    </div>
                                    <div class="col-sm-12 col-md-4 mb-2">
                                        <label for="message">Student Address :</label>
                                        <input type="text" class="form-control form-control-sm" name="address"
                                            value="{{ $user->address ?? '' }}" />
                                    </div>
                                    <div class="col-sm-12 col-md-4 mb-2">
                                        <label for="fullname">Date of Birth * :</label>
                                        <input type="text" name="birth_date" id="birth_date"
                                            class="form-control form-control-sm" value="{{ $user->birth_date ?? '' }}" />
                                    </div>
                                    <div class="col-sm-12 col-md-4 mb-2">
                                        <label for="heard">Batch Time*:</label>
                                        <select name="batch_time" id="batch_time" class="form-control form-control-sm"
                                            onchange="showSheat();">
                                            @if (empty($user->batch_time))
                                                <option value="">Choose..</option>
                                                @foreach ($btime as $item)
                                                    <option value="{{ $item->batch_time }}">
                                                        {{ $item->batch_time }}
                                                    </option>
                                                @endforeach
                                            @else
                                                @foreach ($btime as $item)
                                                    <option value="{{ $item->batch_time }}"
                                                        {{ $item->batch_time == $user->batch_time ? 'selected' : '' }}>
                                                        {{ $item->batch_time }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="col-sm-12 col-md-4 mb-2">
                                        <label for="heard">Course*:</label>
                                        <select id="" name="course" class="form-control form-control-sm">
                                            @if (empty($user->course_name))
                                                <option value="">Choose..</option>
                                                @foreach ($course as $item)
                                                    <option value="{{ $item->course_name }}">{{ $item->course_name }}
                                                    </option>
                                                @endforeach
                                            @else
                                                @foreach ($course as $item)
                                                    <option value="{{ $item->course_name }}"
                                                        {{ $item->course_name == $user->course_name ? 'selected' : '' }}>
                                                        {{ $item->course_name }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="col-sm-12 col-md-4 mb-2">
                                        <label for="heard">qualification *:</label>
                                        <select id="" name="qualification" class="form-control form-control-sm">
                                            @if (empty($user->qualification))
                                                <option value="">Choose..</option>
                                                @foreach ($qualification as $item)
                                                    <option value="{{ $item->qualification }}">
                                                        {{ $item->qualification }}
                                                    </option>
                                                @endforeach
                                            @else
                                                @foreach ($qualification as $item)
                                                    <option value="{{ $item->qualification }}"
                                                        {{ $item->qualification == $user->qualification ? 'selected' : '' }}>
                                                        {{ $item->qualification }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="col-sm-12 col-md-4 mb-2">
                                        <label for="heard"> Fee *:</label>
                                        <select id="" name="fee" class="form-control form-control-sm">
                                            @if (empty($user->fee))
                                                <option value="">Choose..</option>
                                                @foreach ($fee as $item)
                                                    <option value="{{ $item->fee }}">{{ $item->fee }}
                                                    </option>
                                                @endforeach
                                            @else
                                                @foreach ($fee as $item)
                                                    <option value="{{ $item->fee }}"
                                                        {{ $item->fee == $user->fee ? 'selected' : '' }}>
                                                        {{ $item->fee }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="col-sm-12 col-md-4 mb-2">
                                        <label for="heard"> Fee Set*:</label>
                                        <select id="fee_no" name="fee_no" class="form-control form-control-sm">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-12 col-md-4 mb-2">
                                        <label for="fullname">Student Contact * :</label>
                                        <input type="text" class="form-control form-control-sm"
                                            data-inputmask="'mask' : '999-999-9999'" name="contact_no">
                                    </div>
                                    <div class="col-sm-12 col-md-4 mb-2">
                                        <label for="fullname">Upload Image :</label>
                                        <input type="file" class="form-control form-control-sm"
                                            name="Student_profile_photo">
                                    </div>

                                    <div class="col-sm-12 col-md-4 mb-2">
                                        <label for="fullname">Is Active :</label><br>
                                        <input type="checkbox" class="js-switch" checked="" data-switchery="true"a
                                            style="display: none;" name="is_active">
                                    </div>
                                    <div class="col-sm-12 col-md-4 mb-2">
                                        <label for="fullname">Fee Information :</label><br>
                                        <input type="checkbox" class="js-switch" checked="" data-switchery="true"
                                            style="display: none;" name="fee_information">
                                    </div>
                                    <div class="col-sm-12 col-md-4 mb-2">
                                        <label for="fullname">Gender :</label>
                                        <div class="radio">
                                            <label class="">
                                                <div class="iradio_flat-green" style="position: relative;">
                                                    <input type="radio" class="flat" checked="" name="gender"
                                                        value="Male" style="position: absolute; opacity: 0;">
                                                </div> Male
                                            </label>
                                            <label class="">
                                                <div class="iradio_flat-green " style="position: relative;">
                                                    <input type="radio" class="flat" name="gender" value="Female"
                                                        style="position: absolute; opacity: 0;">
                                                </div> Female
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-4 mb-2">
                                        <label for="heard">Comment*:</label>
                                        <select id="" name="comment" class="form-control form-control-sm">
                                            @if (empty($user->comment))
                                                @foreach ($comment as $item)
                                                    <option value="{{ $item->comment }}">{{ $item->comment }}
                                                    </option>
                                                @endforeach
                                            @else
                                                @foreach ($comment as $item)
                                                    <option value="{{ $item->comment }}"
                                                        {{ $item->comment == $user->comment ? 'selected' : '' }}>
                                                        {{ $item->comment }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>

                                    <div class="col-sm-12 col-md-4 mb-2">
                                        <label for="heard">Student Seat no*:</label>
                                        <select id="seat_no" name="seat_no" class="form-control form-control-sm">
                                            @if (empty($seat_no->seat_no))
                                                <option value="">Choose..</option>
                                            @else
                                                <option value="{{ $seat_no->seat_no }}">
                                                    {{ $seat_no->seat_no }}
                                                </option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-9 col-sm-9  offset-md-5 mt-2">
                                        <button type="submit" class="btn btn-success btn-sm">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
