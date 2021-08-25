<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Gemstone extends Model
{
    protected $table="gemstones";
    protected $primaryKey="id";
    protected $fillable=['title','status'];
}
