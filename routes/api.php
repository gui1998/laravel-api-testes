<?php

use App\Http\Controllers\ClienteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;

Route::resource('cliente', ClienteController::class);
