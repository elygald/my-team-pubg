<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(Request $data)
    {
        $token = Str::random(60);
        
        $user = User::create([
            'name' => $data->name,
            'email' => $data->email,
            'password' => Hash::make($data->password),
            'api_token' => hash('sha256', $token),
        ]);

        return ['token' => $token, 'user' => $user];
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
}
