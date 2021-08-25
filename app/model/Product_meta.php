<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Product_meta extends Model
{
    protected $table="product_meta";
    protected $primaryKey="id";
    protected $fillable=['product_id','meta_link','meta_type','status','user_id'];
}
