<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class DiamondType extends Model
{
    protected $table="diamond_types";
    protected $primaryKey="id";
    protected $fillable=['title','status'];
}
