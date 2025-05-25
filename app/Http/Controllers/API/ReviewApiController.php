<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewApiController extends Controller
{
    
    public function index()
    {
        return response()->json(Review::all());
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|uuid|exists:users,id',
            'course_id' => 'required|uuid|exists:courses,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string'
        ]);

        $review = Review::create($validated);

        return response()->json([
            'message' => 'Review created successfully',
            'review' => $review
        ], 201);
    }
    public function show($id)
{
    try {
        $review = Review::findOrFail($id);
        return response()->json($review);
    } catch (\Exception $e) {
        return response()->json([
            'error' => 'Review not found or server error',
            'message' => $e->getMessage(),
        ], 404);
    }
}

public function destroy($id)
{
    try {
        $review = Review::findOrFail($id);
        $review->delete();

        return response()->json(['message' => 'Review deleted successfully']);
    } catch (\Exception $e) {
        return response()->json([
            'error' => 'Delete failed',
            'message' => $e->getMessage(),
        ], 500);
    }
}


public function update(Request $request, $id)
{

    $request->validate([
        'user_id' => 'sometimes|uuid',
        'course_id' => 'sometimes|uuid',
        'rating' => 'sometimes|integer|min:1|max:5',
        'comment' => 'nullable|string'
    ]);

    try {
        $review = Review::findOrFail($id);
        $review->update($request->only(['user_id', 'course_id', 'rating', 'comment']));

        return response()->json([
            'message' => 'Review updated successfully',
            'data' => $review
        ], 200);

    } catch (\Exception $e) {
        return response()->json([
            'error' => 'Update failed',
            'message' => $e->getMessage()
        ], 500);
    }
}

}


