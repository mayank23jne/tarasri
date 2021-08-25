<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class RoleMaster extends Model
{
    protected $table="role_masters";
    protected $primaryKey="id";
    protected $fillable=['title','permission','status'];
}
