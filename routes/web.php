<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });



Route::group([
    ['middleware' => 'jwt.auth', 'except' => ['login', 'register']],
], function () {
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('register', [AuthController::class, 'register']);
    Route::get('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
});

Route::group([
    'middleware' => 'jwt.auth',
], function ($router) {
    Route::get('todos', [TodoController::class, 'index'])->name('todos');
    Route::post('todo', [TodoController::class, 'store']);
    Route::get('todo/{id}', [TodoController::class, 'show']);
    Route::put('todo/{id}', [TodoController::class, 'update']);
    Route::delete('todo/{id}', [TodoController::class, 'destroy']);
});


Route::get('/login', function () {
    return view('login');
});