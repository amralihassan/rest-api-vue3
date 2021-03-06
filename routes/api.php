<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\FileController;
use App\Http\Controllers\API\ProjectController;
use App\Http\Controllers\API\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// login

Route::post('/authenticate', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('projects', ProjectController::class);
    Route::apiResource('tasks', TaskController::class)->except(['index', 'show']);
    Route::post('upload', [FileController::class, 'store']);

    // logout
    Route::post('/logout', function (Request $request) {
        $user = $request->user();
        $user->tokens()->delete();
        Auth::guard('web')->logout();
        return ['status' => 'ok'];
    });
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

