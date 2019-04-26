<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ApiTokenController extends Controller
{
     /**
     * Update the authenticated user's API token.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function token(Request $request, $id)
    {
        $token = Str::random(60);

        $user = User::find($id);

        $user->api_token = hash('sha256', $token);
        $user->save();

        return ['token' => $token];
    }
}
