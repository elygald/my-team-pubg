<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invite_to_player extends Model
{
    protected $fillable = [
        'player_id','team_id','message','status'
    ];

    public function team(){
        return $this->belongsTo(Team::class);
    }

    public function player(){
        return $this->belongsTo(Player::class);
    }

    public function getstatus($status = null)
    {
        $opStatus = [
            'open'      => 'Open',
            'closed'    => 'Closed',
            'accept'    => 'I accept',
            'rejected'  => 'Rejected',
        ];
    
        if (!$status)
            return $opStatus;
     
        return $opStatus[$status];
    }

    public function validStatus($status = null){
        $opStatus = [
            'open',
            'closed',
            'accept',
            'rejected'
        ];

        if (in_array($status, $opStatus)) { 
            return $status;
        }else{
            return false;
        }
    }
}
