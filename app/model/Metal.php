<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Metal extends Model
{
    protected $table="metals";
    protected $primaryKey="id";
    protected $fillable=['title','status'];
}
