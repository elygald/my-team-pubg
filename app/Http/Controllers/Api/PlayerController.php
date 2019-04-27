<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Player;
use Validator;
use Exception;

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

    public function update(Request $request, $id){
        try{
            $player = Player::find($id);
            $player->nickname =(!empty($data->nickname) && isset($data->nickname))? $request->nickname :$player->nickname ;
            $player->image = (!empty($data->image) && isset($data->image))?$request->image : $player->image;
            $player->type_gamer = (!empty($data->type_gamer) && isset($data->type_gamer))?$request->type_gamer:$player->type_gamer;
            $player->region = (!empty($data->region) && isset($data->region))?$request->region:$player->region;
            $player->save();

            return "Update success";
        }catch(Exception $e){
            return "could not update player";
        }

    }
}
