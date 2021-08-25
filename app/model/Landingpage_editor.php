<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Landingpage_editor extends Model
{
     protected $table="landingpage_editors";
     protected $primaryKey="id";
     protected $fillable=['parent','description'];
}
