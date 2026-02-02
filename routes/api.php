<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApplicationController;

Route::middleware('auth:sanctum')->post('/apply', [ApplicationController::class, 'apply']);
