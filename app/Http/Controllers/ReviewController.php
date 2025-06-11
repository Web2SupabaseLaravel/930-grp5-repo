<?php

namespace App\Http\Controllers\API; 

use App\Http\Controllers\Controller;
use App\Models\Review; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReviewApiController extends Controller 
{
    
    public function index()
    {
        $reviews = Review::all(); 
        
       
        return response()->json(['data' => $reviews], 200);
        
    }

  
    public function store(Request $request)
    {
   
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer|exists:users,id',
            'course_id' => 'required|integer|exists:courses,id', 
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:500',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
          
            $review = Review::create($validator->validated()); 
            return response()->json(['message' => 'Review created successfully!', 'review' => $review], 201);

        } catch (\Exception $e) {
           
            return response()->json(['message' => 'Failed to create review.', 'error' => $e->getMessage()], 500); // 500 Internal Server Error
        }
    }


    public function show(Review $review) 
    {
        return response()->json(['data' => $review], 200);
      
    }

 
   
    public function update(Request $request, Review $review) 
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer|exists:users,id',
            'course_id' => 'required|integer|exists:courses,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:500',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $review->update($validator->validated());
            return response()->json(['message' => 'Review updated successfully!', 'review' => $review], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to update review.', 'error' => $e->getMessage()], 500);
        }
    }


    public function destroy(Review $review) 
    {
        try {
            $review->delete();
            return response()->json(['message' => 'Review deleted successfully!'], 204);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to delete review.', 'error' => $e->getMessage()], 500);
        }
    }
}