<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Login a user
     *
     * @param \Illuminate\Foundation\Http\FormRequest
     */
    public function login(AuthRequest $request): Response
    {
        $credentials = $request->validated();

        if (!Auth::attempt($credentials)) {
            return response(['message' => 'Username or password incorrect'], 404);
        }

        $user = Auth::user();
        $access_token = $user->createToken('authToken')->accessToken;

        return response([
            'user' => $user->name,
            'token_type' => 'Bearer',
            'access_token' => $access_token
        ]);
    }

    /**
     * Login a user
     *
     * @param \Illuminate\Foundation\Http\FormRequest
     */
    public function logout(Request $request): Response
    {
        $user = $request->user();
        $user->token()->revoke();

        return response(["message" => "{$user->name} has successfully logged out"]);
    }

    /**
     * Registers a user
     */
    public function register(AuthRequest $request)
    {
        $credentials = $request->validated();

        DB::beginTransaction();
        $credentials['password'] = Hash::make($request->password);
        $user = User::create($credentials);
        $access_token = $user->createToken('authToken')->accessToken;
        DB::commit();

        return response([
            'user' => $user->name,
            'token_type' => 'Bearer',
            'access_token' => $access_token
        ], 201);
    }
}
