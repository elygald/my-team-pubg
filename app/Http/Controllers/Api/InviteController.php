<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Exception;
use App\Invite_to_team;
use App\Invite_to_player;
use App\Player;
use App\Team;

class InviteController extends Controller
{
    public function createInviteTeam(Request $inviteTeam){

        $validator = Validator::make($inviteTeam->all(), [
            'message' => 'required',
            'player_id'  => 'required',
            'team_id' => 'required'
        ]);

        if($validator->fails()){
            return $validator->errors();
        }

        $invite = new Invite_to_player();
        $invite->player_id = $inviteTeam->player_id;
        $invite->team_id = $inviteTeam->team_id;
        $invite->message = $inviteTeam->message;
        $invite->status = $invite->validStatus('open');
        $invite->save();

        return 'Invite create success';
    } 

    public function createInvitePlayer(Request $invitePlayer){

        $validator = Validator::make($invitePlayer->all(), [
            'message' => 'required',
            'player_id'  => 'required',
            'team_id' => 'required'
        ]);

        if($validator->fails()){
            return $validator->errors();
        }

        $invite = new Invite_to_team();
        $invite->player_id = $invitePlayer->player_id;
        $invite->team_id = $invitePlayer->team_id;
        $invite->message = $invitePlayer->message;
        $invite->status = $invite->validStatus('open');
        $invite->save();

        return 'Invite create success';
    } 

    public function acceptInviteTeam($invite_to_player_id){
        $invite = Invite_to_player::find($invite_to_player_id);
        if($invite!=null){
            $invite->status = $invite->validStatus('accept');
            $invite->save();
            

            $player = $invite->player;
            $team = $invite->team;

            $player->teams()->attach($team);

            return json_encode($player->teams);       
        }else{
            return 'Invite inexistent';
        }

        
    
    }

    public function acceptInvitePlayer($Invite_to_team_id){
        $invite = Invite_to_team::find($Invite_to_team_id);
        if($invite!=null){
            $invite->status = $invite->validStatus('accept');
            $invite->save();
            
            $player = $invite->player;
            $team = $invite->team;

            $player->teams()->attach($team);

            return json_encode($player->teams);       
        }else{
            return 'Invite inexistent';
        }

    }

    public function rejectedInviteTeam($invite_to_player_id){
        $invite = Invite_to_player::find($invite_to_player_id);
        if($invite!=null){
            $invite->status = $invite->validStatus('rejected');
            $invite->save();

            return 'Rejected';       
        }else{
            return 'Invite inexistent';
        }
    }

    public function rejectedInvitePlayer($Invite_to_team_id){
        $invite = Invite_to_team::find($Invite_to_team_id);
        if($invite!=null){
            $invite->status = $invite->validStatus('rejected');
            $invite->save();

            return 'Rejected';       
        }else{
            return 'Invite inexistent';
        }
    }

}
