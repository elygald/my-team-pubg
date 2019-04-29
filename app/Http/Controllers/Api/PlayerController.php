<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Player;
use Validator;
use Exception;
use App\Invite_to_player;

class PlayerController extends Controller
{
    public function create(Request $request){

        $validator = Validator::make($request->all(), [
            'nickname' => 'required|unique:players',
        ]);

        if($validator->fails()){
            return "nickname required";
        }

        $player = Player::create([
            'nickname' => $request->nickname,
        ]);

        return "success";

    }

    public function update(Request $data, $id){
        try{
            
            $player = Player::find($id);
           
            $player->nickname =(!empty($data->nickname) && isset($data->nickname))? $data->nickname :$player->nickname ;

            $player->image = (!empty($data->image) && isset($data->image))?$data->image : $player->image;
            $player->type_gamer = (!empty($data->type_gamer) && isset($data->type_gamer))?$data->type_gamer:$player->type_gamer;
            $player->region = (!empty($data->region) && isset($data->region))?$data->region:$player->region;
            $player->pubg_id = (!empty($data->pubg_id) && isset($data->pubg_id))?$data->pubg_id:$player->pubg_id;
            $player->save();

            return "Update success";
        }catch(Exception $e){
            return "could not update player". $e;
        }
    }

    public function find(Request $player, $name){

        $player = Player::where('nickname', 'like', '%' . $name . '%')->get();

        return json_encode($player);
    }

    public function isInvite($player_id){
        $invite = Invite_to_player::where('player_id', $player_id)->get();
        $result = $invite->map(function($item, $key)
        {
            $item->team;
            return ['invite'=>$item];
        });
        return ['invite'=> ['count' => $invite->count(), $result ]];
    }

}
