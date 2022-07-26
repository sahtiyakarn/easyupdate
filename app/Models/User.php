<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 'email', 'password', 'profile_photo', 'batch_time', 'course', 'reistration',
        'guardion_name', 'mother_name', 'address', 'phone', 'fee', 'qualification', 'date_of_admission',
        'gender', 'is_active', 'set_no', 'fee_no', 'fee_information', 'admin_id', 'comment'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function usercomment()
    {
        return $this->hasOne(UserComment::class)->orderBy('id', 'DESC');
    }
    public function userseat()
    {
        return $this->hasOne(UserSeat::class);
    }
}
