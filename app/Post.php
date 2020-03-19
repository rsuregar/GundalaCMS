<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Post extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    protected $dates = ['deleted_at'];

    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }

    public function author()
    {
        return $this->belongsTo('App\User', 'author', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'author', 'id');
    }

    public function editor()
    {
        return $this->belongsTo('App\User', 'editor', 'id');
    }

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = Str::slug($value);
    }

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = ucwords(strtolower($value));
    }
}
