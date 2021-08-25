<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Occassion extends Model
{
    protected $table="occassion";
    protected $primaryKey="id";
    protected $fillable=['occassion_name','status'];
}
