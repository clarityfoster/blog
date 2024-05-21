<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    use HasFactory;
    public function current_user()
    {
        return $this->belongsTo(User::class, 'current_user_id');
    }

    public function user() //profile user 
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
