<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // protected $table = 'posts';

    protected $fillable = ['category_id', 'title', 'slug', 'body', 'thumbnail'];

    public function category()
    {
        // return $this->belongsTo(Category::class, 'subject');
        return $this->belongsTo(Category::class);
    }

    public function takeImage()
    {
        return "/storage/" . $this->thumbnail;
    }

    public function getTakeImageAttribute()
    {
        return "/storage/" . $this->thumbnail;
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // public function getRouteKeyName()
    // {
    //     return 'slug';
    // }
}
