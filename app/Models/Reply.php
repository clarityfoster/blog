<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use HasFactory;
    public function comments() {
        return $this->belongsTo("App\Models\Comment");
    }
    public function user() {
        return $this->belongsTo('App\Models\User');
    }
}
