<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'user_id',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    public function articles() {
        return $this->hasMany("App\Models\Article");
    }
    
    public function relationship() {
        return $this->belongsTo('App\Models\Relationship');
    }

    public function followers() {
        return $this->hasMany(Follow::class, 'user_id'); //Profile user id
    }
    public function following() {
        return $this->hasMany(Follow::class, 'current_user_id'); //current log in user id
    }

    public function role() {
        return $this->belongsTo('App\Models\Role');
    }
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
