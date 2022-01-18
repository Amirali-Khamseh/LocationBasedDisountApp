<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Role extends Model
{
    use HasFactory;
    protected $table = 'roles';
    protected $guarded = [];
    // protected $hidden = ['created_at','updated_at'];
    public function user(){
        return $this->hasOne(User::class);
    }
}
