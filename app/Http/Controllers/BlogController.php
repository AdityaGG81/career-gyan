<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $query = Blog::published();

        // Handle category filtering
        if ($request->has('category') && $request->category != 'All' && !empty($request->category)) {
            $query->where('category', $request->category);
        }

        // Handle search query
        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('title', 'like', "%{$searchTerm}%")
                  ->orWhere('content', 'like', "%{$searchTerm}%")
                  ->orWhere('excerpt', 'like', "%{$searchTerm}%");
            });
        }

        $blogs = $query->orderBy('published_at', 'desc')->paginate(9);

        // Fetch categories for filter pills
        $categories = [
            'All', 'Career Tips', 'Education', 'Industry Insights', 
            'Study Abroad', 'Skill Development', 'Success Stories'
        ];

        // Fetch first featured blog (only on page 1 of All blogs without search)
        $featuredBlog = null;
        if ($blogs->currentPage() == 1 && !$request->has('search') && (!$request->has('category') || $request->category == 'All')) {
            $featuredBlog = Blog::published()->orderBy('published_at', 'desc')->first();
            // If we have a featured blog, exclude it from the listing paginator
            if ($featuredBlog) {
                $blogs = $query->where('id', '!=', $featuredBlog->id)
                              ->orderBy('published_at', 'desc')
                              ->paginate(9);
            }
        }

        return view('blogs.index', compact('blogs', 'categories', 'featuredBlog'));
    }

    public function show($slug)
    {
        $blog = Blog::where('slug', $slug)->firstOrFail();

        // Increment views count
        $blog->increment('views_count');

        // Fetch 3 related blogs (same category, excluding current)
        $relatedBlogs = Blog::published()
            ->where('category', $blog->category)
            ->where('id', '!=', $blog->id)
            ->latest()
            ->take(3)
            ->get();

        return view('blogs.show', compact('blog', 'relatedBlogs'));
    }
}
