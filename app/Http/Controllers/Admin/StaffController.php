<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Models\State;
use App\Models\District;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;

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
        $branch_name = Auth::guard('admin')->user()->branch_name;
        $staffdetails = Admin::where(['is_admin' => '1'])->where(['branch_name' => $branch_name])->get();
        $id = Admin::select('id')->orderby('id', 'desc')->first();
        $last_id = $id->id + 1;
        $data = compact('web_title', 'admin_name', 'profile_photo', 'state', 'staffdetails', 'district', 'last_id');
        return view('admin.staff.staff')->with($data);
    }

    public function getWebsite()
    {
        $website = Auth::guard('admin')->user()->website;
        $admin_id = Auth::guard('admin')->user()->id;
        $fullemailid = $admin_id . '@' . $website;
        return response()->json($fullemailid);
    }
    public function store(Request $request)
    {
        $contact = str_replace("-", "", $request->staff_contact);
        // showmydata($contact);
        //for image 
        if (!empty($request->staff_profile_photo)) {
            $staffadminname = str_replace(' ', '', $request->staff_admin_name);
            $staff_profile_photo =  $staffadminname . date('_dmYHis') . '.' . $request->staff_profile_photo->extension();
            $request->staff_profile_photo->move(public_path('admin_profile_photo'), $staff_profile_photo);
        } else {
            $staff_profile_photo =  'no_image.jpg';
        }


        $admin = Admin::create([
            'email' => $request->staff_email,
            'name' => $request->staff_admin_name,
            'password' => Hash::make($request->staff_email),
            'address' => $request->staff_address,
            'contact' => $contact,
            'website' => $request->staff_email,
            'state' => $request->staff_state,
            'district' =>  $request->staff_district,
            'is_admin' => '1',
            'profile_photo' => $staff_profile_photo,
            'branch_name' => Auth::guard('admin')->user()->branch_name,
            'website' => Auth::guard('admin')->user()->website,
            'branch_type' => Auth::guard('admin')->user()->branch_type,
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
        if (!empty($request->staff_profile_photo)) {
            $staffname = str_replace(' ', '', $request->staff_admin_name);
            $staff_profile_photo =  $staffname . date('_dmYHis') . '.' . $request->staff_profile_photo->extension();
            $request->staff_profile_photo->move(public_path('admin_profile_photo'), $staff_profile_photo);
        } else {
            $admin_photo = Admin::select('profile_photo')->where(['id' => $request->edit_id])->first();
            $staff_profile_photo =   $admin_photo->profile_photo;
        }
        // showmydata($staff_profile_photo);
        $admin = Admin::find($request->edit_id);
        $admin->email = $request->staff_email1;
        $admin->password = Hash::make($request->staff_email1);
        $admin->name = $request->staff_admin_name1;
        $admin->profile_photo = $staff_profile_photo;
        $admin->address = $request->staff_address;
        $admin->contact = str_replace("-", "", $request->staff_contact);
        $admin->state = $request->staff_state_edit;
        $admin->district = $request->staff_district_edit;
        $admin->touch();
        $admin->save();
        return redirect()->back();
    }
}
