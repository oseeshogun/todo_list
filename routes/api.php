<?php

use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
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

Route::put('/tasks/{id}', [TaskController::class, 'update']);
Route::put('/tasks/{id}/finished', [TaskController::class, 'mark_as_finished']);
Route::delete('/tasks/{id}', [TaskController::class, 'destroy']);
Route::get('/tasks', [TaskController::class, 'getAll']);
Route::post('/tasks', [TaskController::class, 'store']);
