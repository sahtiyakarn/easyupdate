<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Models\State;
use App\Models\District;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;

class BranchAdminController extends Controller
{
    public function __construct()
    {
        $this->state = State::all();
        $this->district = District::all();
    }

    public function branchDashboard()
    {
    }

    public function index()
    {
        $state = $this->state;
        $district = $this->district;
        $admin_name = Auth::guard('admin')->user()->name;
        $profile_photo = Auth::guard('admin')->user()->profile_photo;
        $web_title = "Super Admin Dashboard";
        $branchdetails = Admin::where(['is_admin' => '1'])->get();
        $data = compact('web_title', 'admin_name', 'profile_photo', 'state', 'branchdetails', 'district');
        return view('admin.branch.branchadmin')->with($data);
    }
    public function create()
    {
        $admin_name = Auth::guard('admin')->user()->name;
        $profile_photo = Auth::guard('admin')->user()->profile_photo;
        $state = $this->state;
        showmydata($state);
        $web_title = "Super Admin Dashboard";
        $data = compact('web_title', 'admin_name', 'profile_photo');
        return view('admin.branch.branch_create')->with($data);
        // showmydata();
    }

    public function getDistrict($state_id1)
    {
        $state_id = base64_decode($state_id1);
        $district = District::where(['state_name' => $state_id])->pluck('district_name', 'id');
        // showmydata($district);
        return response()->json($district);
    }

    public function store(Request $request)
    {
        $contact = str_replace("-", "", $request->branch_contact);
        // showmydata($contact);
        //for image 
        if (!empty($request->branch_profile_photo)) {
            $branchadminname = str_replace(' ', '', $request->branch_admin_name);
            $branch_profile_photo =  $branchadminname . date('_dmYHis') . '.' . $request->branch_profile_photo->extension();
            $request->branch_profile_photo->move(public_path('admin_profile_photo'), $branch_profile_photo);
        } else {
            $branch_profile_photo =  'no_image.jpg';
        }
        // showmydata($branch_profile_photo);
        // showmydata($branchadminname);
        $admin = Admin::create([
            'email' => $request->branch_email,
            'name' => $request->branch_admin_name,
            'password' => Hash::make($request->branch_email),
            'is_admin' => '1',
            'profile_photo' => $branch_profile_photo,
            'branch_name' => $request->branch_name,
            'branch_type' => $request->branch_type,
            'address' => $request->branch_address,
            'contact' => $contact,
            'state' => $request->branch_state,
            'district' =>  $request->branch_district,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        return redirect()->back();
    }

    public function edit($id)
    {
        $edit_id = Crypt::decrypt($id);
        $adminname = Admin::find($edit_id);
        return response()->json([
            'adminname' => $adminname,
            'status' => 200
        ]);
    }

    public function update(Request $request)
    {
        // showmydata("update root");
        // DB::enableQueryLog();
        // showmydata($request->all());
        $validated = $request->validate([
            'profile_photo' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        //for image 
        if (!empty($request->branch_profile_photo)) {
            $branchname = str_replace(' ', '', $request->branch_admin_name);
            $branch_profile_photo =  $branchname . date('_dmYHis') . '.' . $request->branch_profile_photo->extension();
            $request->branch_profile_photo->move(public_path('admin_profile_photo'), $branch_profile_photo);
        } else {
            $admin_photo = Admin::select('profile_photo')->where(['id' => $request->edit_id])->first();
            $branch_profile_photo =   $admin_photo->profile_photo;
        }
        // showmydata($branch_profile_photo);
        $admin = Admin::find($request->edit_id);
        $admin->email = $request->branch_email;
        $admin->name = $request->branch_admin_name;
        $admin->profile_photo = $branch_profile_photo;
        $admin->address = $request->branch_address;
        $admin->branch_name = $request->branch_name;
        $admin->branch_type = $request->branch_type;
        $admin->contact = str_replace("-", "", $request->branch_contact);
        $admin->state = $request->branch_state_edit;
        $admin->district = $request->branch_district_edit;
        $admin->touch();
        $admin->save();
        return redirect()->back();
    }
}
