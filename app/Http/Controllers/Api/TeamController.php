<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Player;
use App\Team;
use Validator;
use Exception;

class TeamController extends Controller
{
    public function Create(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:teams',
            'tag'  => 'required|unique:teams',
            'region' => 'required'
        ]);

        if($validator->fails()){
            return $validator->errors();
        }

        $team = Team::create([
            'name'  => $request->name,
            'image' => $request->image,
            'tag'   => $request->tag,
            'region'=> $request->region,
            'status'=> true
        ]);

        return ["success"=>$team];
    }

    public function find(Request $player, $name){

        $team = Team::where('name', 'like', '%' . $name . '%')
                        ->orWhere('tag', 'like', '%' . $name . '%')
                        ->get();

        return json_encode($team);
    }

    public function show($team_id)
    {
        $team = Team::find($team_id);
        $player = $team->player;
        return json_encode(['team' => $team]);
    }
}
