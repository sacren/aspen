<?php

use App\Http\Controllers\ProfileController;
use App\Models\Job;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

Route::get('/', function () {
    return View::make('welcome');
});

Route::get('/jobs', function () {
    return View::make('jobs.index', [
        'jobs' => Job::with('employer')->paginate(3),
    ]);
})->middleware(['auth', 'verified'])->name('jobs');

Route::get('/jobs/{job}', function (Job $job) {
    return View::make('jobs.show', [
        'job' => $job,
    ]);
})->middleware(['auth', 'verified'])->name('jobs.show');

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
