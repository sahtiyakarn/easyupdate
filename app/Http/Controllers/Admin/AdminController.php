<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        $admin_name = Auth::guard('admin')->user()->name;
        $profile_photo = Auth::guard('admin')->user()->profile_photo;
        $branchdetails = Admin::where(['is_admin' => '1'])->get();
        $branchdetails_curr = Admin::whereMonth('created_at', Carbon::now()->month)->where(['is_admin' => '1'])->get();
        $total_branch =  $branchdetails->count();
        $total_branch_curr =  $branchdetails_curr->count();

        // showmydata($branchdetails->toArray());

        if (Auth::guard('admin')->user()->is_admin == "2") {
            $web_title = "Super Admin Dashboard";
            $data = compact('web_title', 'admin_name', 'profile_photo', 'total_branch', 'total_branch_curr');
            return view('admin.superadmin')->with($data);
        } elseif (Auth::guard('admin')->user()->is_admin == "1") {
            $web_title = "Admin Dashboard";
            $data = compact('web_title', 'admin_name', 'profile_photo', 'total_branch', 'total_branch_curr');
            return view('admin.branch.branchdashboard')->with($data);
        } elseif (Auth::guard('admin')->user()->is_admin == "0") {
            return view('admin.branch.branchdesk');
        } else {
            abort(401);
        }
    }
}
