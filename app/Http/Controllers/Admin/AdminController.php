<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        $admin_name = Auth::guard('admin')->user()->name;
        $admin_id = Auth::guard('admin')->user()->id;
        $profile_photo = Auth::guard('admin')->user()->profile_photo;
        $branch_name = Auth::guard('admin')->user()->branch_name;
        // showmydata($branchdetails->toArray());

        if (Auth::guard('admin')->user()->is_admin == "3") {
            $branchdetails = Admin::where(['is_admin' => '2'])->get();
            $total_branch =  $branchdetails->count();
            $branchdetails_curr = Admin::whereMonth('created_at', Carbon::now()->month)->where(['is_admin' => '1'])->get();
            $total_branch_curr =  $branchdetails_curr->count();

            $staffdetails = Admin::where(['is_admin' => '1'])->get();
            $total_staff =  $staffdetails->count();
            $staffdetails_curr = Admin::whereMonth('created_at', Carbon::now()->month)->where(['is_admin' => '1'])->get();
            $total_staff_curr =  $staffdetails_curr->count();

            $user = User::all();
            $total_user =  $user->count();
            $userdetails_curr = User::whereMonth('created_at', Carbon::now()->month)->get();
            $total_user_curr =  $staffdetails_curr->count();
            $web_title = "Super Admin Dashboard";
            $data = compact('web_title', 'admin_name', 'profile_photo',  'total_staff',  'total_staff_curr', 'total_user', 'total_user_curr');
            return view('admin.superadmin')->with($data);
        } elseif (Auth::guard('admin')->user()->is_admin == "2") {

            $staffdetails = Admin::where(['is_admin' => '1'])->where(['branch_name' => $branch_name])->get();
            $total_staff =  $staffdetails->count();
            $staffdetails_curr = Admin::whereMonth('created_at', Carbon::now()->month)->where(['is_admin' => '1'])->where(['branch_name' => $branch_name])->get();
            $total_staff_curr =  $staffdetails_curr->count();

            $user = User::where(['admin_id' => $admin_id])->get();
            $total_user =  $user->count();
            $userdetails_curr = User::whereMonth('created_at', Carbon::now()->month)->where(['admin_id' => $admin_id])->get();
            $total_user_curr =  $userdetails_curr->count();

            $web_title = "Admin Dashboard";
            $data = compact('web_title', 'admin_name', 'profile_photo', 'total_staff',  'total_staff_curr', 'total_user', 'total_user_curr');
            return view('admin.superadmin')->with($data);
        } elseif (Auth::guard('admin')->user()->is_admin == "1") {
            $user_admin_id = Admin::select('id')->where(['branch_name' => $branch_name])->where(['is_admin' => '2'])->first();
            $user = User::where(['admin_id' => $user_admin_id->id])->get();
            $total_user =  $user->count();
            $userdetails_curr = User::whereMonth('created_at', Carbon::now()->month)->where(['admin_id' => $user_admin_id->id])->get();
            $total_user_curr =  $userdetails_curr->count();
            // showmydata($userdetails_curr->toarray());
            $web_title = "Staff Dashboard";
            $data = compact('web_title', 'admin_name', 'profile_photo',  'total_user', 'total_user_curr');
            return view('admin.superadmin')->with($data);
        } else {
            abort(401);
        }
    }
}
