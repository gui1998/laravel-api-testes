<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;

Route::get('event/stats', [EventController::class, 'dailyStatistics']);

