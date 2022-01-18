<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Product;

class Category extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function childs(){
        return $this->hasMany(Category::class, 'parent_id')->where('status',1);
    }
    public function parent(){
        return $this->belongsTo(Category::class, 'parent_id')->select('id','title','parent_id');
    }
    public function products(){
        return $this->hasMany(Product::class);
    }
}