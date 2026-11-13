<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use App\Models\Blog;
use App\Models\JobListing;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (config('app.env') === 'production' || (app()->bound('request') && request()->header('x-forwarded-proto') === 'https')) {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }

        View::composer(['layouts.app', 'components.internship-popup', 'components.new-blog-popup'], function ($view) {
            try {
                if (Schema::hasTable('job_listings')) {
                    $latestInternship = JobListing::where('status', 'active')
                        ->where('last_date', '>=', now()->startOfDay())
                        ->where(function ($q) {
                            $q->where('job_title', 'like', '%intern%')
                              ->orWhere('description', 'like', '%intern%')
                              ->orWhere('category', 'like', '%intern%');
                        })
                        ->latest('id')
                        ->first();

                    if (!$latestInternship) {
                        $latestInternship = JobListing::where('status', 'active')
                            ->where('last_date', '>=', now()->startOfDay())
                            ->latest('id')
                            ->first();
                    }

                    $view->with('latestInternship', $latestInternship);
                }

                if (Schema::hasTable('blogs')) {
                    $latestBlog = Blog::published()
                        ->orderBy('published_at', 'desc')
                        ->orderBy('id', 'desc')
                        ->first(['id', 'title', 'slug', 'category', 'excerpt', 'content', 'cover_image', 'published_at', 'created_at']);
                    $view->with('newlyUploadedBlog', $latestBlog);
                }
            } catch (\Throwable $e) {
                // Fail gracefully during migrations or setup
            }
        });
    }
}
