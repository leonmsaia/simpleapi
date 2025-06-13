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
