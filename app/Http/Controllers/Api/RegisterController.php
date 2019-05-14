<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Player;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(Request $data, $player_id)
    {
        $validator = Validator::make($data->all(), [
            'name' => 'required|',
            'email' => 'required|unique:users',
            'password' => 'required|'
        ]);

        if($validator->fails()){
            return $validator->errors();
        }
        
        try{
            $token = Str::random(60);
            $user = User::create([
                'name' => $data->name,
                'email' => $data->email,
                'password' => Hash::make($data->password),
                'api_token' => hash('sha256', $token),
            ]);
            if(!empty($player_id) && isset($player_id)){
                $player = Player::find($player_id);
            
                $user->player()->attach($player);
            }
            
            return ['token' => $token, 'user' => $user, 'player'=>$player];
        }catch(Exception $e){
            return "could not create User". $e;
        }
    }
    /**
     * Update a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function update(Request $data, $id)
    {
        $token = Str::random(60);
        
        $user = User::find($id);
        $user->name = (!empty($data->name) && isset($data->name))? $data->name : $user->name ;
        $user->email = (empty($data->email) && isset($data->email))? $data->email : $user->email ;
        $user->password = (empty($data->password) && isset($data->password))? Hash::make('sha256', $data->password) : $user->password ;
        $user->api_token = hash('sha256', $token);
        $user->save();
        
        return ['token' => $token, 'user' => $user];
    }

    protected function login(Request $data)
    {
        $validator = Validator::make($data->all(), [
            'Email' => 'required',
            'password' => 'required',
        ]);

        if($validator->fails()){
            return "Email and Password required";
        }

        $credentials = $data->only('email', 'password');
        
        if (Auth::attempt($credentials)) {
            $token = Str::random(60);
            $user = $data->user();
            $user->api_token = hash('sha256', $token);
            $user->save();
            return ['token' => $token];
        }else{
            return "User or Password Incorrect";    
        }
     
    }

}
