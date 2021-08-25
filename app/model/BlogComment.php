<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class BlogComment extends Model
{
    protected $table="blog_comments";
	protected $primaryKey="id";
	protected $fillable=['blog_id','user_id','comment'];
}
