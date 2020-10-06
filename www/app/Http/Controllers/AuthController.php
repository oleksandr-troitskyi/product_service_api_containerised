<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function authenticate(Request $request)
    {
        $this->validate(
            $request,
            [
                'email' => 'required',
                'password' => 'required',
            ]
        );

        $user = User::where('email', $request->input('email'))->first();
        if (!is_null($user)) {
            if ($request->input('password') === $user->password) {
                $apikey = base64_encode(str_random(40));
                User::where('email', $request->input('email'))->update(['api_key' => "$apikey"]);;

                return response()->json(['status' => true, 'api_key' => $apikey]);
            }
        }

        return response()->json(['status' => false], 401);
    }
}
