<?php

use App\Http\Controllers\FleetController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');

Route::get('/fleet', [FleetController::class, 'index'])->name('fleet.index');
Route::get('/fleet/{vehicle:slug}', [FleetController::class, 'show'])->name('fleet.show');
