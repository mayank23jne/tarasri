<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Purity extends Model
{
    protected $table="purities";
    protected $primaryKey="id";
    protected $fillable=['title','status'];
}
