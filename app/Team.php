<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = [
        'name', 'image', 'tag', 'region', 'status',
    ];

    public function users(){
        return $this->belongsToMany(User::class);
    }

    public function player(){
        return $this->belongsToMany(Player::class);
    }
}
