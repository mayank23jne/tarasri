<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Home_jewellery extends Model
{
    protected $table="home_jewellery";
    protected $primaryKey="id";
    protected $fillable=['banner_title','collection_id','banner_url','grid_meta','status'];
}
