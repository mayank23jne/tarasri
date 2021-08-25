<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Seo_file extends Model
{
    protected $table="seo_files";
    protected $primaryKey="id";
    protected $fillable=['title','file'];
}
