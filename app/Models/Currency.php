<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{

    protected $fillable = [
        'code','active','name'
    ];

    public $timestamps = true;
}
