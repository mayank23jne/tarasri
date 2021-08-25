<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class About_us extends Model
{
    protected $table="about_us";
    protected $primaryKey="id";
    protected $fillable=['title','banner_url','description'];
}
