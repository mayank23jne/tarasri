<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $table="testimonials";
	protected $primaryKey="id";
	protected $fillable=['user_id','comment','status'];
}
