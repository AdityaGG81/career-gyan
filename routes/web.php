<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExploreController;
use App\Http\Controllers\CareerPathController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\SuggestionController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AiCareerChatController;
use App\Http\Controllers\DailyQuizController;
use App\Http\Controllers\AdminQuizController;

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

// College Reviews (Public to view)
Route::get('/colleges/{college}/reviews', [\App\Http\Controllers\CollegeReviewController::class, 'index'])->name('college.reviews.index');

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

    // User Profile
    Route::get('/profile', [AuthController::class, 'showProfile'])->name('profile');
    Route::post('/profile/update', [AuthController::class, 'updateProfile'])->name('profile.update');

    // Aptitude Test
    Route::get('/test', [TestController::class, 'start'])->name('test.start');
    Route::get('/test/quiz', [TestController::class, 'quiz'])->name('test.quiz');
    Route::post('/test/submit', [TestController::class, 'submit'])->name('test.submit');
    Route::get('/test/results/{uuid}', [TestController::class, 'results'])->name('test.results');

    // College Reviews (Auth required to store)
    Route::post('/colleges/{college}/reviews', [\App\Http\Controllers\CollegeReviewController::class, 'store'])->name('college.reviews.store');

    // AI Chatbot
    Route::post('/ai-career-chat/message', [AiCareerChatController::class, 'message'])->name('ai-career-chat.message');
    Route::get('/ai-career-chat/limit', [AiCareerChatController::class, 'getRemainingLimit'])->name('ai-career-chat.limit');

    // Daily Quiz (auth required to take & view results)
    Route::post('/daily-quiz/submit', [DailyQuizController::class, 'submit'])->name('daily-quiz.submit');
    Route::get('/daily-quiz/take', [DailyQuizController::class, 'take'])->name('daily-quiz.take');
    Route::get('/daily-quiz/result/{date}', [DailyQuizController::class, 'result'])->name('daily-quiz.result');
    Route::get('/daily-quiz/my-stats', [DailyQuizController::class, 'myStats'])->name('daily-quiz.my-stats');
});

// Quick Test (Public)
Route::get('/quick-test', [\App\Http\Controllers\QuickTestController::class, 'start'])->name('quick-test.start');
Route::get('/quick-test/quiz', [\App\Http\Controllers\QuickTestController::class, 'quiz'])->name('quick-test.quiz');
Route::post('/quick-test/submit', [\App\Http\Controllers\QuickTestController::class, 'submit'])->name('quick-test.submit');
Route::get('/quick-test/results/{uuid}', [\App\Http\Controllers\QuickTestController::class, 'results'])->name('quick-test.results');

// Suggestions
Route::post('/suggestion/store', [SuggestionController::class, 'store'])->name('suggestion.store');

// AI Chatbot (moved to auth group)

// Public Blog Routes
Route::get('/blog', [\App\Http\Controllers\BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [\App\Http\Controllers\BlogController::class, 'show'])->name('blog.show');

// Admin Auth
Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
Route::get('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

Route::get('/verify-email', function () {
    return view('auth.verify-email');
})->name('verify.email');

Route::post('/verify-email', [AuthController::class, 'verifyEmailOtp'])
    ->name('verify.email.submit');

    Route::post('/resend-email-otp', [AuthController::class, 'resendEmailOtp'])
    ->name('resend.email.otp');

Route::get('/test-mail', function () {
    try {
        \Illuminate\Support\Facades\Mail::raw('Test email from web route', function ($message) {
            $message->to('ffczmy26@gmail.com')
                    ->subject('Web Route Test');
        });
        return 'Mail sent from web!';
    } catch (\Exception $e) {
        return 'Error: ' . $e->getMessage();
    }
});

// Admin Panel (Protected by session checks inside the controllers)
// Daily Quiz (public landing + leaderboard)
Route::get('/daily-quiz', [DailyQuizController::class, 'index'])->name('daily-quiz.index');
Route::get('/daily-quiz/leaderboard', [DailyQuizController::class, 'leaderboard'])->name('daily-quiz.leaderboard');

Route::get('/admin', [AdminAuthController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/admin/suggestions', [SuggestionController::class, 'index'])->name('admin.suggestions');
Route::get('/admin/users', [AdminAuthController::class, 'users'])->name('admin.users');

// Admin Blog CRUD
Route::get('/admin/blogs', [\App\Http\Controllers\AdminBlogController::class, 'index'])->name('admin.blogs.index');
Route::get('/admin/blogs/create', [\App\Http\Controllers\AdminBlogController::class, 'create'])->name('admin.blogs.create');
Route::post('/admin/blogs', [\App\Http\Controllers\AdminBlogController::class, 'store'])->name('admin.blogs.store');
Route::get('/admin/blogs/{id}/edit', [\App\Http\Controllers\AdminBlogController::class, 'edit'])->name('admin.blogs.edit');
Route::put('/admin/blogs/{id}', [\App\Http\Controllers\AdminBlogController::class, 'update'])->name('admin.blogs.update');
Route::delete('/admin/blogs/{id}', [\App\Http\Controllers\AdminBlogController::class, 'destroy'])->name('admin.blogs.destroy');

// Admin Fields (Categories) CRUD
Route::get('/admin/fields', [\App\Http\Controllers\AdminFieldController::class, 'index'])->name('admin.fields.index');
Route::get('/admin/fields/create', [\App\Http\Controllers\AdminFieldController::class, 'create'])->name('admin.fields.create');
Route::post('/admin/fields', [\App\Http\Controllers\AdminFieldController::class, 'store'])->name('admin.fields.store');
Route::get('/admin/fields/{id}/edit', [\App\Http\Controllers\AdminFieldController::class, 'edit'])->name('admin.fields.edit');
Route::put('/admin/fields/{id}', [\App\Http\Controllers\AdminFieldController::class, 'update'])->name('admin.fields.update');
Route::delete('/admin/fields/{id}', [\App\Http\Controllers\AdminFieldController::class, 'destroy'])->name('admin.fields.destroy');

// Admin Colleges (Institutes) CRUD
Route::get('/admin/colleges', [\App\Http\Controllers\AdminCollegeController::class, 'index'])->name('admin.colleges.index');
Route::get('/admin/colleges/create', [\App\Http\Controllers\AdminCollegeController::class, 'create'])->name('admin.colleges.create');
Route::post('/admin/colleges', [\App\Http\Controllers\AdminCollegeController::class, 'store'])->name('admin.colleges.store');
Route::get('/admin/colleges/{id}/edit', [\App\Http\Controllers\AdminCollegeController::class, 'edit'])->name('admin.colleges.edit');
Route::put('/admin/colleges/{id}', [\App\Http\Controllers\AdminCollegeController::class, 'update'])->name('admin.colleges.update');
Route::delete('/admin/colleges/{id}', [\App\Http\Controllers\AdminCollegeController::class, 'destroy'])->name('admin.colleges.destroy');

// Admin Career Edit
Route::get('/admin/careers', [\App\Http\Controllers\AdminCareerController::class, 'index'])->name('admin.careers.index');
Route::get('/admin/careers/{id}/edit', [\App\Http\Controllers\AdminCareerController::class, 'edit'])->name('admin.careers.edit');
Route::put('/admin/careers/{id}', [\App\Http\Controllers\AdminCareerController::class, 'update'])->name('admin.careers.update');

// Admin Quiz Management
Route::get('/admin/quiz', [AdminQuizController::class, 'index'])->name('admin.quiz.index');
Route::get('/admin/quiz/create', [AdminQuizController::class, 'create'])->name('admin.quiz.create');
Route::post('/admin/quiz', [AdminQuizController::class, 'store'])->name('admin.quiz.store');
Route::get('/admin/quiz/scores', [AdminQuizController::class, 'scores'])->name('admin.quiz.scores');
Route::get('/admin/quiz/leaderboard', [AdminQuizController::class, 'leaderboard'])->name('admin.quiz.leaderboard');
Route::get('/admin/quiz/{id}/edit', [AdminQuizController::class, 'edit'])->name('admin.quiz.edit');
Route::put('/admin/quiz/{id}', [AdminQuizController::class, 'update'])->name('admin.quiz.update');
Route::delete('/admin/quiz/{id}', [AdminQuizController::class, 'destroy'])->name('admin.quiz.destroy');

Route::get('/debug-aicredits-test', [AiCareerChatController::class, 'debugAicreditsTest']);