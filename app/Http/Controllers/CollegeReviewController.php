<?php

namespace App\Http\Controllers;

use App\Models\College;
use App\Models\CollegeReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CollegeReviewController extends Controller
{
    public function index(College $college)
    {
        $reviews = $college->reviews()->with('user:id,name')->latest()->get();
        return response()->json($reviews);
    }

    public function store(Request $request, College $college)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string|max:1000',
        ]);

        if (!Auth::check()) {
            return response()->json(['message' => 'You must be logged in to review.'], 401);
        }

        $review = $college->reviews()->create([
            'user_id' => Auth::id(),
            'rating' => $request->rating,
            'review' => $request->review,
        ]);

        return response()->json([
            'message' => 'Review added successfully.',
            'review' => $review->load('user:id,name')
        ]);
    }
}
