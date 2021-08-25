<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table="user";
    protected $primaryKey="user_id";
    protected $fillable=['name','role','user_avatar','email','mobile','address','hash','password','otp','status'];
}
