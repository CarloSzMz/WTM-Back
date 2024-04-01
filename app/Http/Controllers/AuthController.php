<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function register(Request $request)
    {

        $request->validate([

            'name' => 'required|string',
            'surname' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed',
            'calle' => 'required|string',
            'provincia' => 'required|string',

        ]);

        $user = new User([

            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'calle' => $request->calle,
            'provincia' => $request->provincia,
        ]);

        $user->save();

        return response()->json([
            'status' => true,
            'message' => 'Successfully created user!'

        ]);
    }

    public function login(Request $request)
    {

        $request->validate([

            'email' => 'required|string|email',

            'password' => 'required|string'

        ]);

        $credentials = request(['email', 'password']);

        if (!Auth::attempt($credentials))

            return response()->json([

                'message' => 'Unauthorized'

            ], 401);

        $user = $request->user();

        $tokenResult = $user->createToken('token');

        $token = $tokenResult->token;

        $token->save();

        return response()->json([

            'access_token' => $tokenResult->accessToken,

            'token_type' => 'Bearer'

        ]);
    }

    public function get_user(Request $request)
    {

        //return response()->json($request->user());

        $user = Auth::user();

        return response()->json([
            "status" => true,
            "message" => "profile information",
            "data" => $user,
            'token_type' => 'Bearer'
        ]);
    }

    public function logout(Request $request)
    {
    }
}
