<?php

namespace App\Models\Content;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory , SoftDeletes ;


    protected $fillable = ['body' , 'parent_id' , 'author_id' , 'commentable_id' , 'commentable_type' , 'seen' , 'approved' , 'status'];

    public function parent(){
        return $this->belongsTo($this , 'parent_id');
    }
    public function answers(){
        return $this->hasMany($this , 'parent_id');
    }

    public function commentable(){
        return $this->morphTo();
    }
    public function user(){
        return $this->belongsTo(User::class , 'author_id');
    }
}
