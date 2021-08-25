<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Our_partner extends Model
{
    protected $table="our_partners";
	protected $primaryKey="id";
	protected $fillable=['logo','alt_text','title'];
}
