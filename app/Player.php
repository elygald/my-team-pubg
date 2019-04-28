<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $fillable = [
        'nickname', 'image', 'type_gamer', 'region', 'pubg_id'
    ];

    public function teams(){
        return $this->belongsToMany(Team::class);
    }

    public function users(){
        return $this->belongsToMany(User::class);
    }
}
