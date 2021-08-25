<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class CrimsonbrideImages extends Model
{
    protected $table="crimsonbride_images";
	protected $primaryKey="id";
	protected $fillable=['image','reffrence','alt_text'];
}
