<?php

namespace App\Models\Content;

use App\Models\Content\Comment;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory , SoftDeletes , Sluggable;

    public function sluggable(): array
    {
        return[
            'slug' => [
                'source' => 'title'
            ]
            ];
    }

    protected $casts = ['image' => 'array'];
    protected $fillable = ['title' , 'summary' , 'slug' , 'image' , 'status' , 'tags' , 'body' , 'commentable' , 'published_at' , 'category_id' , 'author_id'];

    public function postCategory(){
        return $this->belongsTo(PostCategory::class , 'category_id');
    }

    public function comments(){
        return $this->morphMany(Comment::class , 'commentable');
    }
    
}
