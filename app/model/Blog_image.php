<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Blog_image extends Model
{
    protected $table="blog_images";
    protected $primaryKey="id";
    protected $fillable=['reffrence','image'];
}
