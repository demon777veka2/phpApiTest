<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
   public $timestamps = false;

   protected $fillable = [
      'name', 'department_id'
  ];
}