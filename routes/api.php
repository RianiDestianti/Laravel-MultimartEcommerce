<?php
use App\Http\Controllers\ChatbotController;
Route::post('/chatbot', [ChatbotController::class, 'reply']);
