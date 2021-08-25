<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    protected $table="collection";
    protected $primaryKey="id";
    protected $fillable=['collection_name','status','banner','alt_text'];
}
