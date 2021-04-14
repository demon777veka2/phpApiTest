<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Otdel extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'department', 'post'
    ];
}
