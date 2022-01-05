<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
   protected $table = 'posts';
    protected $fillable = array('title','content','status','user_id');
    
    public $timestamps = true;
}
