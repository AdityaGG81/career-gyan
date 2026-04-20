<?php

use App\Http\Controllers\ExploreController;
use Illuminate\Support\Facades\Route;

// Main pages
Route::get('/', function () { return view('welcome'); })->name('home');
Route::get('/about', function () { return view('about'); })->name('about');
Route::get('/explore', [ExploreController::class, 'index'])->name('explore.index');

// AJAX endpoints
Route::get('/explore/search',             [ExploreController::class, 'search'])->name('explore.search');
Route::get('/explore/field/{field}',      [ExploreController::class, 'byField'])->name('explore.field');
Route::post('/explore/subjects',          [ExploreController::class, 'bySubjects'])->name('explore.subjects');
Route::get('/explore/career/{career}',    [ExploreController::class, 'careerDetail'])->name('explore.career');

// Aptitude Test
use App\Http\Controllers\TestController;
Route::get('/test',                       [TestController::class, 'start'])->name('test.start');
Route::get('/test/quiz',                  [TestController::class, 'quiz'])->name('test.quiz');
Route::post('/test/submit',               [TestController::class, 'submit'])->name('test.submit');
Route::get('/test/results/{uuid}',        [TestController::class, 'results'])->name('test.results');