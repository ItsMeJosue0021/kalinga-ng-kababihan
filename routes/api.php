<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ChatBotController;
use App\Http\Controllers\EnquiryController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\AdvocacyController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\GoodsDonationController;
use App\Http\Controllers\KnowledgebaseController;
use App\Http\Controllers\EmergencyContactController;

Route::apiResource('roles', RoleController::class)->middleware('auth:sanctum');

Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::get('/user', [AuthController::class, 'user'])->middleware('auth:sanctum');
Route::get('users', [AuthController::class, 'users'])->middleware('auth:sanctum');
Route::put('/users/{id}', [AuthController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/users/{id}', [AuthController::class, 'destroy'])->middleware('auth:sanctum');

Route::post('chat', [ChatBotController::class, 'chat']);

Route::post('/knowledgebase', [KnowledgebaseController::class, 'store'])->middleware(['auth:sanctum', 'role:admin']);
Route::get('/knowledgebase', [KnowledgebaseController::class, 'getAll'])->middleware(['auth:sanctum', 'role:admin']);
Route::put('/knowledgebase/{id}', [KnowledgebaseController::class, 'update'])->middleware(['auth:sanctum', 'role:admin']);
Route::delete('/knowledgebase/{id}', [KnowledgebaseController::class, 'destroy'])->middleware(['auth:sanctum', 'role:admin']);
Route::get('/knowledgebase/search', [KnowledgebaseController::class, 'search']);

Route::get('members/search', [MemberController::class, 'search'])->middleware(['auth:sanctum', 'role:admin']);
Route::apiResource('members', MemberController::class)->middleware(['auth:sanctum', 'role:admin']);

Route::apiResource('emergency-contacts', EmergencyContactController::class)->middleware(['auth:sanctum', 'role:admin']);

Route::get('/enquiries', [EnquiryController::class, 'index'])->middleware(['auth:sanctum', 'role:admin']);   // Get all
Route::post('/enquiries', [EnquiryController::class, 'store']); // Create
Route::put('/enquiries/{id}', [EnquiryController::class, 'update'])->middleware(['auth:sanctum', 'role:admin']);  // Update
Route::delete('/enquiries/{id}', [EnquiryController::class, 'destroy'])->middleware(['auth:sanctum', 'role:admin']);  // Delete
Route::get('/enquiries/search', [EnquiryController::class, 'search'])->middleware(['auth:sanctum', 'role:admin']);


Route::apiResource('projects', ProjectController::class);
Route::post('/projects/update/{id}', [ProjectController::class, 'update']);

Route::apiResource('events', EventController::class);
Route::apiResource('advocacies', AdvocacyController::class);
Route::apiResource('donations', DonationController::class);
Route::get('/donations', [DonationController::class, 'totalDonationsByType']);


Route::apiResource('goods-donations', GoodsDonationController::class);
Route::post('/goods-donations/update/{id}', [GoodsDonationController::class, 'update']);


Route::post('/send-email', [EmailController::class, 'send']);
Route::get('/template', [EmailController::class, 'template']);

Route::get('/test-email', function () {
    Mail::raw('This is a test email from Kalinga', function ($message) {
        $message->to('joshuasalceda0021@gmail.com')
            ->subject('Test Email from Kalinga');
    });

    return 'Email sent!';
});


