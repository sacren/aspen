<?php

use App\Http\Controllers\JobController;
use App\Http\Controllers\ProfileController;
use App\Mail\JobPosted;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

Route::get('test', function () {
    Mail::to('test@example.com', 'Test User')->send(new JobPosted());

    return View::make('static.mail-sent');
})->middleware(['auth', 'verified'])->name('test');

Route::get('/', function () {
    return View::make('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('jobs', JobController::class)->only([
        'index', 'create', 'store', 'show', 'edit', 'destroy'
    ]);

    // Explicit PATCH route for certainty, overriding the default resource behavior
    Route::patch('/jobs/{job}', [JobController::class, 'update'])->name('jobs.update');
});

Route::get('/joblistings', function () {
    return redirect()->route('jobs.index');
})->middleware(['auth', 'verified'])->name('joblistings');

Route::get('/about', function () {
    return View::make('about');
})->middleware(['auth', 'verified'])->name('about');

Route::get('/contact', function () {
    return View::make('contact');
})->middleware(['auth', 'verified'])->name('contact');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
