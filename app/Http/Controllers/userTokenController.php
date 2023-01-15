<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class userTokenController extends Controller
{

    public function login(Request $request)
    {

        $request->validate([
            "email" => "required|email",
            "password" => "required",
            "device_name" => "required",
        ]);
        $user = User::where('email', $request->get('email'))->first();

        if (!is_null($user)) {
            if (!Hash::check($request->password, $user->password)) {
                return response()->json([
                    "email" => 'El email no existe o no coincide con nuestro datos'
                ], 500
                );
            }
        } else {
            return response()->json([
                "message" => 'El email no existe o no coincide con nuestro datos'
            ], 500
            );
        }

        return response()->json([
                'token' => $user->createToken($request->device_name)->plainTextToken
            ]
        );
    }
}
