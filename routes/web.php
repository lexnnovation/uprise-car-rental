<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\FleetController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');

// Serves storage/app/public directly through PHP instead of relying on the
// public/storage symlink. Uses /media rather than /storage since some hosts
// block that path pattern at the edge/CDN level regardless of the origin.
Route::get('/media/{path}', [MediaController::class, 'show'])->where('path', '.*')->name('media.show');

Route::get('/fleet', [FleetController::class, 'index'])->name('fleet.index');
Route::get('/fleet/{category}/{item}', [FleetController::class, 'showGroup'])->name('fleet.group');
Route::get('/fleet/{vehicle:slug}', [FleetController::class, 'show'])->name('fleet.show');

Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
Route::get('/services/{service:slug}', [ServiceController::class, 'show'])->name('services.show');

Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{post:slug}', [BlogController::class, 'show'])->name('blog.show');

Route::get('/contact', [ContactController::class, 'show'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('/about', AboutController::class)->name('about');
Route::get('/faq', FaqController::class)->name('faq');

Route::view('/privacy', 'pages.privacy')->name('privacy');
Route::view('/terms', 'pages.terms')->name('terms');

Route::get('/sitemap.xml', SitemapController::class)->name('sitemap');
