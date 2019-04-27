<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Player;
use Validator;

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

        $player = Player::find($id);
        $player->nickname = $request->nickname;
        $player->image = $request->image;
        $player->type_gamer = $request->type_gamer;
        $player->region = $request->region;
        $player->save();

        return "Update success";

    }
}
