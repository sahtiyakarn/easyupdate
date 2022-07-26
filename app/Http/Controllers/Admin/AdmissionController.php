<?php

namespace App\Http\Controllers\Admin;

use App\Models\Fee;
use App\Models\User;
use App\Models\Admin;
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

        $admin_id1 = Admin::select('id')->where(['branch_name' => $branch_name = Auth::guard('admin')->user()->branch_name])->where(['is_admin' => '2'])->first();
        $admin_name = Auth::guard('admin')->user()->name;
        $profile_photo = Auth::guard('admin')->user()->profile_photo;
        $web_title = "Admission List";
        $search = $request->search;
        if (empty($search)) {
            // DB::enableQueryLog();
            $studentname = User::where(['is_active' => '1'])->where(['admin_id' => $admin_id1->id])->orderby('id', 'desc')->get();
            // $query = DB::getQueryLog();
            // dd($query);
        } else {
            $studentname = User::where(['is_active' => '1'])->where(['admin_id' => $admin_id1->id])->where(['batch_time' => $search])->orderby('id', 'desc')->get();
        }
        // $studentname = User::where(['is_active' => '1'])->where(['admin_id' => $admin_id1->id])->orderby('id', 'desc')->get();
        // showmydata($studentname->toarray());
        // DB::getQueryLog();
        // dd($studentname);
        $btime = $this->btime;
        $data = compact('studentname', 'btime', 'search', 'web_title', 'profile_photo', 'admin_name');
        return view('admin.admission.admission_list')->with($data);
    }
    public function create()
    {
        $today = date('d-M-Y');

        $admin_id = Auth::guard('admin')->user()->id;
        $lastId = User::select('id')->orderby('id', 'desc')->first();

        $id = !empty($lastId) ? $lastId->id + 1 : $id = 1;


        $admin_name = Auth::guard('admin')->user()->name;
        $profile_photo = Auth::guard('admin')->user()->profile_photo;
        $web_title = "New Admission";
        $btime = BatchTime::all();
        $course = Course::all();
        $qualification = Qualification::all();
        $fee = Fee::all();
        $comment = Comment::all();
        $userseat = UserSeat::all();
        $url = "admissionstore";
        $data = compact('web_title', 'admin_name', 'profile_photo', 'btime', 'course', 'qualification', 'fee', 'comment', 'userseat', 'id', 'today', 'url');
        return view('admin.admission.admission')
            ->with($data);
    }

    public function store(Request $request)
    {
        DB::enableQueryLog();
        // showmydata($request->all());
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

        $validated = $request->validate([
            'student_name' => 'required|max:255',
            'email' => 'required|max:255',
            'guardion_name' => 'required|max:255',
            'mother_name' => 'required|max:255',
            // 'profile_photo' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
            'address' => 'required',
            'contact_no' => 'required',
            'birth_date' => 'required'
        ]);

        $user = new User;
        $user->id = $request->student_id;
        $user->email = $request->email;
        $user->password = Hash::make($request->batch_time);
        $user->registration = $request->registration;
        $user->admission_date = $request->admission_date;
        $user->fee_no = $fee_no;
        $user->name = $request->student_name;
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
        $comment->admin_id = $admin_id;
        $comment->save();
        $seatuse = UserSeat::where(['batch_time' => $request->batch_time])->where(['seat_no' => $request->seat_no])->where(['admin_id' => $admin_id])->first();
        $seatuse->user_id = $user->id;
        $seatuse->save();
        DB::getQueryLog();
        return redirect('admission_list')->with('success', 'Data Created Successfully!');
    }

    public function batchTime($current_batch_time)
    {
        // showmydata();
        $admin_id = Auth::guard('admin')->user()->id;
        $current_batch_time = base64_decode($current_batch_time);
        $seat_no = UserSeat::where(['batch_time' => $current_batch_time])->where(['admin_id' => $admin_id])->where(['active' => 1])->where(['user_id' => 0])->pluck('seat_no');
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
        $url = "admissionupate";

        // return $id = Crypt::decrypt($id);
        $user = User::where(['id' => Crypt::decrypt($id)])->first();
        // showmydata($user->toArray());
        $seat_no = UserSeat::select('seat_no')->where(['user_id' => Crypt::decrypt($id)])->where(['admin_id' => $admin_id])->first();
        $blank_seat_no = UserSeat::select('seat_no')->where('user_id', '!', $user->id)->where(['batch_time' => $user->batch_time])->where(['admin_id' => $admin_id])->where(['active' => 1])->get();
        // showmydata($blank_seat_no->toArray());

        $usercomment = UserComment::select('comment')->where(['user_id' => Crypt::decrypt($id)])->where(['admin_id' => $admin_id])->orderby('id', 'desc')->first();

        // showmydata($seatuse->seat_no);
        $data = compact('web_title', 'admin_name', 'profile_photo', 'btime', 'fee', 'course', 'qualification', 'comment', 'user', 'url', 'seat_no', 'usercomment', 'blank_seat_no');
        return view('admin.admission.admission')
            ->with($data);
    }
    public function update(Request $request)
    {
        // showmydata($request->all());
        $admin_id = Auth::guard('admin')->user()->id;
        // $cdate = date('d');
        //  $student_profile_photo = User::select('profile_photo')->where(['id' => $request->student_id])->first();
        // return $student_profile_photo->profile_photo;
        if (!empty($request->student_profile_photo)) {
            $student_name = str_replace(' ', '', $request->name);
            $student_profile_photo =  $student_name . date('_dmYHis') . '.' . $request->student_profile_photo->extension();
            $request->student_profile_photo->move(public_path('admin/student_profile_photo'), $student_profile_photo);
        } else {
            $student_profile_photo = User::select('profile_photo')->where(['id' => $request->student_id])->first();
        }
        $user = User::find($request->student_id);
        // $user->id = $request->student_id;
        $user->email = $request->email;
        $user->password = Hash::make($request->batch_time);
        $user->registration = $request->registration;
        $user->admission_date = $request->admission_date;
        $user->fee_no = $request->fee_no;
        $user->name = $request->student_name;
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
        $user->profile_photo = $student_profile_photo->profile_photo;
        $user->admin_id =  Auth::guard('admin')->user()->id;
        $user->touch();
        $user->save();
        //    return $request->comment;
        $usercomment = UserComment::where(['user_id' => $request->student_id])->where(['admin_id' => $admin_id])->orderby('id', 'desc')->first();
        if ($usercomment->comment == $request->comment) {
            // $comment = UserComment::where(['user_id'=>$request->student_id])->where(['admin_id'=>$admin_id])->first();           
            $usercomment->touch();
            // $usercomment->updated_at = date('Y-m-d G:i:s');
            $usercomment->save();
        } else {
            $comment = new UserComment;
            $comment->comment = $request->comment;
            $comment->user_id = $user->id;
            $comment->admin_id = $admin_id;
            $comment->save();
        }

        // $seatuse = UserSeat::select('batch_time','seat_no')->where(['batch_time' => $request->batch_time])->where(['seat_no' => $request->seat_no])->where(['admin_id' => $admin_id])->first();
        $seatuse = UserSeat::select('seat_no', 'batch_time')->where(['user_id' => $request->student_id])->where(['admin_id' => $admin_id])->first();
        // showmydata($seatuse->toarray());
        if ($seatuse->seat_no == $request->seat_no and $seatuse->batch_time == $request->batch_time) {
            // showmydata('match');
            $seatuse->touch();
            $seatuse->save();
        } else {
            // showmydata('not match');
            $seatuse_seat_no_unactive = UserSeat::where(['user_id' => $request->student_id])->where(['admin_id' => $admin_id])->first();
            $seatuse_seat_no_unactive->user_id = 0;
            $seatuse_seat_no_unactive->touch();
            $seatuse_seat_no_unactive->save();

            $seatuse_save = UserSeat::where(['batch_time' => $request->batch_time])->where(['seat_no' => $request->seat_no])->where(['admin_id' => $admin_id])->first();
            // showmydata($seatuse->toarray());
            $seatuse_save->user_id = $user->id;
            $seatuse_save->touch();
            $seatuse_save->save();
        }

        return redirect('admission_list')->with('success', 'Data Created Successfully!');
    }
}
