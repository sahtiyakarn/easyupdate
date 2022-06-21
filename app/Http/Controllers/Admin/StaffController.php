<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Models\State;
use App\Models\District;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class StaffController extends Controller
{
    public function __construct()
    {
        $this->state = State::all();
        $this->district = District::all();
    }
    public function index()
    {
        $state = $this->state;
        $district = $this->district;
        $admin_name = Auth::guard('admin')->user()->name;
        $profile_photo = Auth::guard('admin')->user()->profile_photo;
        $web_title = "Admin Dashboard";
        $branchdetails = Admin::where(['is_admin' => '1'])->get();
        $data = compact('web_title', 'admin_name', 'profile_photo', 'state', 'branchdetails', 'district');
        return view('admin.branch.branchadmin')->with($data);
    }
}
