<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    protected $table="blog_categories";
	protected $primaryKey="id";
	protected $fillable=['name','status'];
}
