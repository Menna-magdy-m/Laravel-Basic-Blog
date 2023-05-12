<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'meta_description', 'meta_keywords', 'image_large', 'image_medium', 'image_thumbnail', 'slug	template', 'cover_photo'];

    protected static function boot()
    {
        parent::boot();
        
        static::deleting(function ($category) {
            $category->posts()->delete();
        });
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function path()
    {
        return url("/categories/{$this->id}");
    }
}
