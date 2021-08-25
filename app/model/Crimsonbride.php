<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Crimsonbride extends Model
{
    protected $table="crimsonbrides";
	protected $primaryKey="id";
	protected $fillable=['title','reffrence','slug','status'];
}
