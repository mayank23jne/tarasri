<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class DesignStyle extends Model
{
    protected $table="design_styles";
    protected $primaryKey="id";
    protected $fillable=['title','status'];
}
