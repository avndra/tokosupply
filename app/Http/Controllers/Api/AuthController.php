<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laravel\Sanctum\PersonalAccessToken;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return response()->json(['message' => 'Invalid Credentials'], 401);
        }

        $user = Auth::user();
        if (!$user instanceof \App\Models\User) {
            $user = \App\Models\User::find($user->id);
        }
        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'token' => $token,
            'user' => $user
        ]);
    }

    public function logout(Request $request)
    {
        $tokenValue = $request->bearerToken();

        if (!$tokenValue) {
            return response()->json(['message' => 'Token not provided'], 401);
        }

        $token = PersonalAccessToken::findToken($tokenValue);

        if (!$token) {
            return response()->json(['message' => 'Invalid token'], 401);
        }

        $user = $token->tokenable;
        $user->tokens()->delete();

        return response()->json(['message' => 'Logged out successfully']);
    }
}
