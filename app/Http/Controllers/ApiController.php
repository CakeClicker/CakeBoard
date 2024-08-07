<?php

// app/Http/Controllers/ApiController.php

namespace App\Http\Controllers;

use App\Models\Token;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ApiController extends Controller
{
    public function index()
    {
        $user = auth()->user(); // Get the authenticated user
        return response()->json([
            'user' => $user
        ]);
    }

    public function apikey(Request $request)
    {
        // Retrieve the bearer token from the request
        $token = $request->bearerToken();
        if (!$token) {
            Log::error('No token provided');
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Retrieve the token record from the database
        $tokenRecord = Token::where('token', $token)->first();
        if (!$tokenRecord) {
            Log::error('Token not found: ' . $token);
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Retrieve the user associated with the token
        $user = $tokenRecord->user;
        if (!$user) {
            Log::error('User not found for token ID: ' . $tokenRecord->id);
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        if (!$user->api_key) {
            Log::error('API key not found for user ID: ' . $user->id);
            return response()->json(['error' => 'API key not found'], 404);
        }

        // Return the API key associated with the user
        return response()->json([
            'api_key' => $user->api_key,
        ]);
    }
}
