<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $table="blogs";
    protected $primaryKey="id";
    protected $fillable=['title','description','image','alt_text','meta_description','meta_keyword','status','slug'];
}
