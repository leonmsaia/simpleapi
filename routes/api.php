<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

/**
 * --------------------------------------------------------------------------
 * Authentication Routes (JWT)
 * --------------------------------------------------------------------------
 *
 * POST /api/login
 * 
 * Authenticate user with email and password.
 * Returns JWT token on successful authentication.
 * 
 * Request Body:
 * {
 *   "email": "user@example.com",
 *   "password": "password"
 * }
 * 
 * Response 200:
 * {
 *   "access_token": "token",
 *   "token_type": "bearer",
 *   "expires_in": 3600
 * }
 * 
 * Response 401:
 * {
 *   "error": "Unauthorized"
 * }
 */
Route::post('/login', [AuthController::class, 'login']);

/**
 * --------------------------------------------------------------------------
 * Protected Routes (Requires JWT Authentication)
 * --------------------------------------------------------------------------
 *
 * All routes in this group require a valid JWT token provided
 * in the Authorization header as Bearer token.
 *
 * Header:
 * Authorization: Bearer {access_token}
 */
Route::middleware('auth:api')->group(function () {
    /**
     * GET /api/me
     *
     * Returns the authenticated user's information based on the provided token.
     *
     * Response 200:
     * {
     *   "id": 1,
     *   "name": "User Name",
     *   "email": "user@example.com",
     *   ...
     * }
     *
     * Response 401:
     * {
     *   "message": "Unauthenticated."
     * }
     */
    Route::get('/me', [AuthController::class, 'me']);
});