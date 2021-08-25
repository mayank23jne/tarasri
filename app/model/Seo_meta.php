<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Seo_meta extends Model
{
    protected $table="seo_meta";
    protected $primaryKey="id";
    protected $fillable=['page_name','title','description','keywords','status'];

}
