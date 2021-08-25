<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Tara_exclusive extends Model
{
    protected $table="tara_exclusive";
    protected $primaryKey="id";
    protected $fillable=['title','banner_url','description'];
}
