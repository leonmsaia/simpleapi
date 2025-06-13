<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class AuthController
 *
 * Handles user authentication using JWT.
 *
 * @package App\Http\Controllers
 */
class AuthController extends Controller
{
    /**
     * Authenticate user and return JWT token.
     *
     * @param Request $request HTTP request containing 'email' and 'password'
     * @return \Illuminate\Http\JsonResponse JSON response with token or error
     */
    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);

        if (!$token = Auth::attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
