<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table="settings";
    protected $primaryKey="id";
    protected $fillable=['key_text','key_value'];
}
