<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminBlogController extends Controller
{
    public function index()
    {
        if (!session()->has('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $blogs = Blog::orderBy('created_at', 'desc')->get();
        return view('admin.blogs.index', compact('blogs'));
    }

    public function create()
    {
        if (!session()->has('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $categories = [
            'General', 'Career Tips', 'Education', 'Industry Insights', 
            'Study Abroad', 'Skill Development', 'Success Stories'
        ];

        return view('admin.blogs.create', compact('categories'));
    }

    public function store(Request $request)
    {
        if (!session()->has('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'excerpt' => 'nullable|string',
            'cover_image' => 'nullable|string',
            'category' => 'required|string',
            'tags' => 'nullable|string',
            'author' => 'nullable|string',
        ]);

        $slug = Str::slug($request->title);
        // Ensure slug is unique
        $originalSlug = $slug;
        $count = 1;
        while (Blog::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        // Parse tags from comma separated string to array
        $tagsArray = [];
        if ($request->filled('tags')) {
            $tagsArray = array_map('trim', explode(',', $request->tags));
        }

        $isPublished = $request->has('is_published');
        $publishedAt = $isPublished ? now() : null;

        Blog::create([
            'title' => $request->title,
            'slug' => $slug,
            'content' => $request->content,
            'excerpt' => $request->excerpt,
            'cover_image' => $request->cover_image,
            'category' => $request->category,
            'tags' => $tagsArray,
            'author' => $request->author ?: 'CareerGyan Team',
            'is_published' => $isPublished,
            'published_at' => $publishedAt,
        ]);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog post created successfully.');
    }

    public function edit($id)
    {
        if (!session()->has('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $blog = Blog::findOrFail($id);
        $categories = [
            'General', 'Career Tips', 'Education', 'Industry Insights', 
            'Study Abroad', 'Skill Development', 'Success Stories'
        ];

        // Format tags as comma separated string for input
        $tagsString = is_array($blog->tags) ? implode(', ', $blog->tags) : '';

        return view('admin.blogs.edit', compact('blog', 'categories', 'tagsString'));
    }

    public function update(Request $request, $id)
    {
        if (!session()->has('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $blog = Blog::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'excerpt' => 'nullable|string',
            'cover_image' => 'nullable|string',
            'category' => 'required|string',
            'tags' => 'nullable|string',
            'author' => 'nullable|string',
        ]);

        // Auto-update slug if title changes
        $slug = $blog->slug;
        if ($blog->title !== $request->title) {
            $slug = Str::slug($request->title);
            $originalSlug = $slug;
            $count = 1;
            while (Blog::where('slug', $slug)->where('id', '!=', $id)->exists()) {
                $slug = $originalSlug . '-' . $count;
                $count++;
            }
        }

        $tagsArray = [];
        if ($request->filled('tags')) {
            $tagsArray = array_map('trim', explode(',', $request->tags));
        }

        $isPublished = $request->has('is_published');
        $publishedAt = $blog->published_at;

        if ($isPublished && !$blog->is_published) {
            $publishedAt = now();
        } elseif (!$isPublished) {
            $publishedAt = null;
        }

        $blog->update([
            'title' => $request->title,
            'slug' => $slug,
            'content' => $request->content,
            'excerpt' => $request->excerpt,
            'cover_image' => $request->cover_image,
            'category' => $request->category,
            'tags' => $tagsArray,
            'author' => $request->author ?: 'CareerGyan Team',
            'is_published' => $isPublished,
            'published_at' => $publishedAt,
        ]);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog post updated successfully.');
    }

    public function destroy($id)
    {
        if (!session()->has('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $blog = Blog::findOrFail($id);
        $blog->delete();

        return redirect()->route('admin.blogs.index')->with('success', 'Blog post deleted successfully.');
    }
}
