<?php

namespace App\Http\Controllers\Admin;

use App\Models\Fee;
use App\Models\User;
use App\Models\Course;
use App\Models\Comment;
use App\Models\UserSeat;
use App\Models\BatchTime;
use App\Models\UserComment;
use Illuminate\Http\Request;
use App\Models\Qualification;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;

class AdmissionController extends Controller
{
    public function __construct()
    {
        $this->btime = BatchTime::all();
        $this->fee = Fee::all();
        $this->course = Course::all();
        $this->comment = Comment::all();
        $this->qualification = Qualification::all();
    }
    public function index(Request $request)
    {
        $admin_id = Auth::guard('admin')->user()->id;
        $admin_name = Auth::guard('admin')->user()->name;
        $profile_photo = Auth::guard('admin')->user()->profile_photo;
        $web_title = "Admin Dashboard";
        $search = $request->search;
        if (empty($search)) {
            $studentname = User::where(['is_active' => '1'])->where(['admin_id' => $admin_id])->orderby('id', 'desc')->get();
        } else {
            $studentname = User::where(['is_active' => '1'])->where(['admin_id' => $admin_id])->where(['batch_time' => $search])->orderby('id', 'desc')->get();
        }
        $btime = $this->btime;
        $data = compact('studentname', 'btime', 'search', 'web_title', 'profile_photo', 'admin_name');
        return view('admin.admission.admission_list')->with($data);
    }
    public function create()
    {
        $today = date('d-M-Y');

        $admin_id = Auth::guard('admin')->user()->id;
        $lastId = User::select('id')->where(['admin_id' => $admin_id])->orderby('id', 'desc')->first();

        $id = !empty($lastId) ? $lastId->id + 1 : $id = 1;


        $admin_name = Auth::guard('admin')->user()->name;
        $profile_photo = Auth::guard('admin')->user()->profile_photo;
        $web_title = "Admin Dashboard";
        $btime = BatchTime::all();
        $course = Course::all();
        $qualification = Qualification::all();
        $fee = Fee::all();
        $comment = Comment::all();
        $userseat = UserSeat::all();
        $data = compact('web_title', 'admin_name', 'profile_photo', 'btime', 'course', 'qualification', 'fee', 'comment', 'userseat', 'id', 'today');
        return view('admin.admission.admission')
            ->with($data);
    }

    public function store(Request $request)
    {
        // showmydata($request->is_active == 'on' ? 'true' : 'false');
        $admin_id = Auth::guard('admin')->user()->id;
        $cdate = date('d');
        if ($cdate >= 21) {
            $fee_no = 3;
        } elseif ($cdate >= 11) {
            $fee_no = 2;
        } elseif ($cdate >= 1) {
            $fee_no = 1;
        }
        if (!empty($request->student_profile_photo)) {
            $student_name = str_replace(' ', '', $request->name);
            $student_profile_photo =  $student_name . date('_dmYHis') . '.' . $request->student_profile_photo->extension();
            $request->student_profile_photo->move(public_path('admin/student_profile_photo'), $student_profile_photo);
        } else {
            $student_profile_photo =  'no_image.jpg';
        }
        $user = new User;
        $user->id = $request->id;
        $user->email = $request->email;
        $user->password = Hash::make($request->batch_time);
        $user->registration = $request->registration;
        $user->admission_date = $request->admission_date;
        $user->fee_no = $fee_no;
        $user->name = $request->name;
        $user->name = $request->email;
        $user->guardion_name = $request->guardion_name;
        $user->mother_name = $request->mother_name;
        $user->address = $request->address;
        $user->contact_no = str_replace("-", "", $request->contact_no);
        $user->batch_time = $request->batch_time;
        $user->birth_date = $request->birth_date;
        $user->fee = $request->fee;
        $user->is_active = $request->is_active == 'on' ? '1' : '0';
        $user->fee_information = $request->fee_information == 'on' ? '1' : '0';
        $user->gender = $request->gender;
        $user->qualification = $request->qualification;
        $user->course = $request->course;
        $user->profile_photo = $student_profile_photo;
        $user->admin_id =  Auth::guard('admin')->user()->id;
        $user->save();
        $comment = new UserComment;
        $comment->comment = $request->comment;
        $comment->user_id = $user->id;
        $comment->save();
        $seatuse = UserSeat::where(['batch_time' => $request->batch_time])->where(['seat_no' => $request->seat_no])->where(['admin_id' => $admin_id])->first();
        $seatuse->active = 1;
        $seatuse->user_id = $user->id;
        $seatuse->save();
        return redirect('admission')->with('success', 'Data Created Successfully!');
    }

    public function batchTime($current_batch_time)
    {
        // showmydata();
        $admin_id = Auth::guard('admin')->user()->id;
        $current_batch_time = base64_decode($current_batch_time);
        return $seat_no = UserSeat::where(['batch_time' => $current_batch_time])->where(['admin_id' => $admin_id])->where(['active' => 0])->pluck('seat_no');
        return response()->json($seat_no);
    }
    public function edit($id)
    {
        $admin_name = Auth::guard('admin')->user()->name;
        $profile_photo = Auth::guard('admin')->user()->profile_photo;
        $web_title = "Update Admission";
        $admin_id = Auth::guard('admin')->user()->id;
        $btime = $this->btime;
        $fee = $this->fee;
        $course = $this->course;
        $qualification = $this->qualification;
        $comment = $this->comment;
        $url = "admission/update/" . $id;

        // return $id = Crypt::decrypt($id);
        $user = User::where(['id' => Crypt::decrypt($id)])->first();
        $seat_no = UserSeat::select('seat_no')->where(['user_id' => Crypt::decrypt($id)])->where(['admin_id' => $admin_id])->first();
        // showmydata($seatuse->seat_no);
        $data = compact('web_title', 'admin_name', 'profile_photo', 'btime', 'fee', 'course', 'qualification', 'comment', 'user', 'url', 'seat_no',);
        return view('admin.admission.admission')
            ->with($data);
    }
}
