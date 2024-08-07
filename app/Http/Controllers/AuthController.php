<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Token; // Ensure Token model exists

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = Str::random(64);

            // Update or create the token for the user
            Token::updateOrCreate(
                ['user_id' => $user->id], // Conditions to match an existing record
                ['token' => $token]        // Attributes to update or set if a new record is created
            );

            return response()->json([
                'message' => 'You are logged in',
                'token' => $token,
            ]);
        }

        return response()->json(['error' => 'Unauthorized login'], 401);
    }

    public function apikey(Request $request)
    {
        $user = Auth::user(); // Get the authenticated user
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return response()->json([
            'api_key' => $user->api_key,
        ]);
    }
}
