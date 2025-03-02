<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ChatBotController;
use App\Http\Controllers\EmergencyContactController;

Route::apiResource('roles', RoleController::class)->middleware('auth:sanctum');

Route::post('register', [AuthController::class, 'register'])->name('register');
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::get('user', [AuthController::class, 'user'])->middleware('auth:sanctum');

Route::post('chat', [ChatBotController::class, 'chat']);


Route::apiResource('members', MemberController::class)->middleware(['auth:sanctum', 'role:admin']);
Route::apiResource('emergency-contacts', EmergencyContactController::class)->middleware(['auth:sanctum', 'role:admin']);
