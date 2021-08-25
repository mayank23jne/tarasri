<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Contact_us extends Model
{
    protected $table="contact_us";
    protected $primarykey="id";
    protected $fillable=['name','email','mobile_no','message','status','code'];
}
