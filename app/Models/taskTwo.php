<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class taskTwo extends Model
{
    protected $table = "country_lang";

    public $timestamps = false;

    protected $fillable = [
        'id',
        'alias',
        'name',
        'name_en'
    ];
}
