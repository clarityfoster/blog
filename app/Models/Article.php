<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    public function category() {
        return $this->belongsTo('App\Models\Category');
    }
    public function comments() {
        return $this->hasMany('App\Models\Comment');
    }
    public function replies() {
        return $this->hasMany('App\Models\Reply');
    }
    public function user() {
        return $this->belongsTo('App\Models\User');
    }
    public function likes() {
        return $this->hasMany('App\Models\React');
    }
    public function privacy() {
        return $this->belongsTo('App\Models\Privacy');
    }
}
