<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Photo;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
     
    protected $guarded = [];
    public function category(){
        return $this->belongsTo(Category::class)->with('parent')->select('id','title','parent_id');
    }
    public function image(){
        return $this->hasOne(Photo::class);
    }
    public function owner(){
        return $this->belongsTo(User::class,'owner_id')->select('id','shop_name','lat','lng');
    }
    public function comments(){
        return $this->hasMany(Comment::class)->where('status',1)->with('user');
    }
}
