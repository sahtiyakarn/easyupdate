<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    public function usercomment()
    {
        return $this->hasOne(UserComment::class);
    }
    public function userseat()
    {
        return $this->hasOne(UserSeat::class);
    }
}
