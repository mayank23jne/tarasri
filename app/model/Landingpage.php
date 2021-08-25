<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Landingpage extends Model
{
     protected $table="landingpages";
     protected $primaryKey="id";
     protected $fillable=['title','slug','show_position','status'];
}
