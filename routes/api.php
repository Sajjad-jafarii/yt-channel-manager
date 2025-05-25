<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChannelController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\ChannelRequestController;
use App\Http\Controllers\Auth\TemporaryTokenController;

Route::middleware('auth:sanctum')->group(function () {

    // Channel Routes
    Route::get('/channels', [ChannelController::class, 'index']);         // لیست کانال‌ها
    Route::post('/channels', [ChannelController::class, 'store']);        // ساخت کانال جدید
    Route::get('/channels/{channel}', [ChannelController::class, 'show']); // مشاهده یک کانال خاص
    Route::put('/channels/{channel}', [ChannelController::class, 'update']); // ویرایش کانال
    Route::delete('/channels/{channel}', [ChannelController::class, 'destroy']); // حذف کانال

    // Schedule Routes
    Route::get('/schedules', [ScheduleController::class, 'index']);
    Route::post('/schedules', [ScheduleController::class, 'store']);
    Route::get('/schedules/{schedule}', [ScheduleController::class, 'show']);
    Route::put('/schedules/{schedule}', [ScheduleController::class, 'update']);
    Route::delete('/schedules/{schedule}', [ScheduleController::class, 'destroy']);

    // Channel Request Routes
    Route::get('/channel-requests', [ChannelRequestController::class, 'index']);
    Route::post('/channel-requests', [ChannelRequestController::class, 'store']);
    Route::get('/channel-requests/{channel_request}', [ChannelRequestController::class, 'show']);
    Route::put('/channel-requests/{channel_request}', [ChannelRequestController::class, 'update']);
    Route::delete('/channel-requests/{channel_request}', [ChannelRequestController::class, 'destroy']);

    // Approve route for ChannelRequest
    Route::post('/channel-requests/{channel_request}/approve', [ChannelRequestController::class, 'approve']);

    // Temporary Token (GET token)
    Route::post('/temporary-token', [TemporaryTokenController::class, 'store']);
});
