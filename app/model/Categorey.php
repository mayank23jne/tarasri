<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Categorey extends Model
{
    protected $table="categorey";
    protected $primaryKey="id";
    protected $fillable=["categorey_name","status"];
}
