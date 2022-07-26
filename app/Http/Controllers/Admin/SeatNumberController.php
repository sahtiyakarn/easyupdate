<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Models\UserSeat;
use App\Models\BatchTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Database\Console\Migrations\StatusCommand;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class SeatNumberController extends Controller
{
    public function index()
    {

        $admin_name = Auth::guard('admin')->user()->name;
        $is_admin = Auth::guard('admin')->user()->is_admin;
        if ($is_admin === "3" or $is_admin === "2") {
            $admin_id = Auth::guard('admin')->user()->id;
        } else {
            $admin_id1 = Admin::select('id')->where(['branch_name' => Auth::guard('admin')->user()->branch_name])->where(['is_admin' => '2'])->first();
            $admin_id = $admin_id1->id;
        }
        $profile_photo = Auth::guard('admin')->user()->profile_photo;
        $web_title = "Seat Number";
        $batch_time = BatchTime::all();
        $staffdetails = UserSeat::groupBy('batch_time')->select('batch_time', DB::raw('count(*) as total'))->where(['admin_id' => $admin_id])->get();
        if (empty($staffdetails)) {
            $staffdetails = UserSeat::groupBy('batch_time')->select('batch_time', DB::raw('count(*) as total'))->where(['admin_id' => $admin_id])->get();
        }
        $staffdetailsFull = UserSeat::where(['admin_id' => $admin_id])->get();
        // $staffdetails = UserSeat::where(['admin_id' => $admin_id])->get();
        // showmydata($staffdetails->toarray());
        $data = compact('web_title', 'admin_name', 'profile_photo',  'staffdetails', 'batch_time', 'staffdetailsFull');
        return view('admin.seat.seatnumber')->with($data);
    }
    public function store(Request $request)
    {
        $admin_id = Auth::guard('admin')->user()->id;
        $userSeatInfo = UserSeat::select('seat_no')->where(['batch_time' => $request->batch_time])->where(['admin_id' => $admin_id])->orderby('id', 'desc')->first();
        // showmydata($request->all());
        // showmydata($userSeatInfo->toarray());
        // return $userSeatInfo->seat_no;
        $seat_no = empty($userSeatInfo) ?  0 : $userSeatInfo->seat_no;

        for ($i = 1; $i <= $request->numberofsheet; $i++) {
            $userseat = new UserSeat();
            $userseat->seat_no = $seat_no + $i;
            $userseat->batch_time = $request->batch_time;
            $userseat->admin_id = $admin_id;
            $userseat->save();
        }

        return redirect("seatnumber_list");
    }
    public function edit($id)
    {
        // $edit_id = base64_decode($id);
        $edit_id = Crypt::decrypt($id);
        $is_admin = Auth::guard('admin')->user()->is_admin;
        if ($is_admin === "3" or $is_admin === "2") {
            $admin_id = Auth::guard('admin')->user()->id;
        } else {
            $admin_id1 = Admin::select('id')->where(['branch_name' => Auth::guard('admin')->user()->branch_name])->where(['is_admin' => '2'])->first();
            $admin_id = $admin_id1->id;
        }


        $userSeatInfo = UserSeat::where(['batch_time' => $edit_id])->where(['admin_id' => $admin_id])->get();
        return response()->json([
            'data' => $userSeatInfo,
            'status' => 200
        ]);
        // showmydata($userSeatInfo);
        // showmydata($userSeatInfo->toarray());
    }

    public function update(Request $request, $id)
    {
        $is_admin = Auth::guard('admin')->user()->is_admin;
        if ($is_admin === "3" or $is_admin === "2") {
            $admin_id = Auth::guard('admin')->user()->id;
        } else {
            $admin_id1 = Admin::select('id')->where(['branch_name' => Auth::guard('admin')->user()->branch_name])->where(['is_admin' => '2'])->first();
            $admin_id = $admin_id1->id;
        }
        $userSeatInfo = UserSeat::where(['id' => $id])->where(['admin_id' => $admin_id])->first();
        // showmydata($userSeatInfo->toarray());
        $userSeatInfo->user_id = 0;
        $userSeatInfo->save();
        return response()->json([
            'status' => 200,
            'message' => 'Succesfull'
        ]);
    }
}
