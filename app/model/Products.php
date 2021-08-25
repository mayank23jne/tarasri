<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $table="products";
    protected $primaryKey="id";
    protected $fillable=['product_name','custom_name','product_cost','categorey_id','metal_type','purity','occasion_type','stone_type','enquiy_value','collection_id','gender','design_style','design_model_no','diamond_type','diamond_carat','description','seo_title','seo_description','seo_keywords','status','slug'];
}
