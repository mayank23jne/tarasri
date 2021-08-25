<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Favourites extends Model
{
    protected $table="favourites";
	protected $primaryKey="id";
	protected $fillable=['user_id','product_id','status'];
}
