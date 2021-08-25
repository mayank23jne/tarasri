<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
    protected $table="enquiry";
    protected $primaryKey="id";
    protected $fillable=['name','email','mobile_no','message','product_id','status'];
}
