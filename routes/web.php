<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExploreController;
use App\Http\Controllers\CareerPathController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\SuggestionController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AiCareerChatController;

// Main pages
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

// Explore
Route::get('/explore', [ExploreController::class, 'index'])->name('explore.index');

// AJAX endpoints
Route::get('/explore/search', [ExploreController::class, 'search'])->name('explore.search');
Route::get('/explore/field-search', [ExploreController::class, 'fieldSearch'])->name('explore.fieldSearch');
Route::get('/global-search', [ExploreController::class, 'globalSearch'])->name('explore.globalSearch');
Route::get('/explore/field/{field}', [ExploreController::class, 'byField'])->name('explore.field');
Route::post('/explore/subjects', [ExploreController::class, 'bySubjects'])->name('explore.subjects');
Route::get('/explore/career/{career}', [ExploreController::class, 'careerDetail'])->name('explore.career');

// Career detail page (SEO-friendly)
Route::get('/career/{slug}', [ExploreController::class, 'careerDetailPage'])->name('career.detail.page');

// College pages
Route::get('/explore/engineering-colleges', [ExploreController::class, 'engineeringColleges'])->name('explore.engineering-colleges');
Route::get('/explore/medical-colleges', [ExploreController::class, 'medicalColleges'])->name('explore.medical-colleges');
Route::get('/explore/hotel-management-colleges', [ExploreController::class, 'hotelColleges'])->name('explore.hotel-management-colleges');
Route::get('/explore/management-colleges', [ExploreController::class, 'managementColleges'])->name('explore.management-colleges');
Route::get('/explore/pharmacy-colleges', [ExploreController::class, 'pharmacyColleges'])->name('explore.pharmacy-colleges');
Route::get('/explore/non-mbbs-colleges', [ExploreController::class, 'nonMbbsColleges'])->name('explore.non-mbbs-colleges');
Route::get('/explore/science-colleges', [ExploreController::class, 'scienceColleges'])->name('explore.science-colleges');
Route::get('/explore/arts-humanities-colleges', [ExploreController::class, 'artsColleges'])->name('explore.arts-humanities-colleges');
Route::get('/explore/commerce-colleges', [ExploreController::class, 'commerceColleges'])->name('explore.commerce-colleges');
Route::get('/explore/agriculture-colleges', [ExploreController::class, 'agricultureColleges'])->name('explore.agriculture-colleges');

// Career path
Route::get('/career-path/gaming-esports', [CareerPathController::class, 'show'])
    ->defaults('stream', 'gaming-esports')
    ->name('career-path.gaming-esports');
Route::get('/career-path/{stream}', [CareerPathController::class, 'show'])->name('career.path');

// Other explore pages
Route::get('/explore/skill-development', [ExploreController::class, 'skillDevelopment'])->name('explore.skill-development');
Route::get('/explore/sports-careers', [ExploreController::class, 'sportsCareers'])->name('explore.sports-careers');
Route::get('/explore/small-scale-business', [ExploreController::class, 'smallScaleBusiness'])->name('explore.small-scale-business');
Route::get('/explore/competitive-exams', [ExploreController::class, 'competitiveExams'])->name('explore.competitive-exams');

// Traditional careers
Route::get('/explore/government-defence', [ExploreController::class, 'governmentDefence'])->name('explore.government-defence');
Route::get('/explore/teaching-law', [ExploreController::class, 'teachingLaw'])->name('explore.teaching-law');
Route::get('/explore/traditional-careers', [ExploreController::class, 'traditionalCareers'])->name('explore.traditional-careers');

// Non-traditional careers
Route::get('/explore/modern-tech', [ExploreController::class, 'modernTech'])->name('explore.modern-tech');
Route::get('/explore/creative-careers', [ExploreController::class, 'creativeCareers'])->name('explore.creative-careers');
Route::get('/explore/social-media', [ExploreController::class, 'socialMedia'])->name('explore.social-media');
Route::get('/explore/gaming-careers', [ExploreController::class, 'gamingCareers'])->name('explore.gaming-careers');
Route::get('/explore/freelancing', [ExploreController::class, 'freelancing'])->name('explore.freelancing');
Route::get('/explore/non-traditional-careers', [ExploreController::class, 'nonTraditionalCareers'])->name('explore.non-traditional-careers');

// Auth Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    Route::get('/signup', [AuthController::class, 'showSignup'])->name('signup');
    Route::post('/signup', [AuthController::class, 'signup'])->name('signup.submit');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Aptitude Test
    Route::get('/test', [TestController::class, 'start'])->name('test.start');
    Route::get('/test/quiz', [TestController::class, 'quiz'])->name('test.quiz');
    Route::post('/test/submit', [TestController::class, 'submit'])->name('test.submit');
    Route::get('/test/results/{uuid}', [TestController::class, 'results'])->name('test.results');

    // Quick Test
    Route::get('/quick-test', [\App\Http\Controllers\QuickTestController::class, 'start'])->name('quick-test.start');
    Route::get('/quick-test/quiz', [\App\Http\Controllers\QuickTestController::class, 'quiz'])->name('quick-test.quiz');
    Route::post('/quick-test/submit', [\App\Http\Controllers\QuickTestController::class, 'submit'])->name('quick-test.submit');
    Route::get('/quick-test/results/{uuid}', [\App\Http\Controllers\QuickTestController::class, 'results'])->name('quick-test.results');
});

// Suggestions
Route::post('/suggestion/store', [SuggestionController::class, 'store'])->name('suggestion.store');

// AI Chatbot
Route::post('/ai-career-chat/message', [AiCareerChatController::class, 'message'])->name('ai-career-chat.message');

// Admin Auth
Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
Route::get('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

// Admin Suggestions & Users (NO middleware for now)
Route::get('/admin/suggestions', [SuggestionController::class, 'index'])->name('admin.suggestions');
Route::get('/admin/users', [AdminAuthController::class, 'users'])->name('admin.users');

Route::get('/debug-aicredits-test', [AiCareerChatController::class, 'debugAicreditsTest']);