<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $user = $request->user();
        if (!$user) {
            return response()->json(['message' => 'Not authenticated'], 401);
        }
        $token = $user->currentAccessToken();
        if (!$token) {
            return response()->json(['message' => 'No active token'], 400);
        }
        $token->delete();
        return response()->json(['message' => 'Logged out successfully']);
    }
}
