<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Menufeatured extends Model
{
    //
    // use SoftDeletes;
    protected $guarded = [];
    // protected $dates = ['deleted_at'];

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = ucwords(strtolower($value));
    }

}
