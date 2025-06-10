<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Lesson;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Lessons",
 *     description="API Endpoints for managing lessons"
 * )
 */
class LessonApiController extends Controller
{
    /**
     * @OA\Get(
     *     path="/lessons",
     *     tags={"Lessons"},
     *     summary="Get all lessons",
     *     @OA\Response(response=200, description="List of lessons")
     * )
     */
    public function index()
    {
        return response()->json(Lesson::all());
    }

    /**
     * @OA\Post(
     *     path="/lessons",
     *     tags={"Lessons"},
     *     summary="Create a new lesson",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"title","content_type","content_url","order","course_id"},
     *             @OA\Property(property="title", type="string"),
     *             @OA\Property(property="content_type", type="string"),
     *             @OA\Property(property="content_url", type="string"),
     *             @OA\Property(property="order", type="integer"),
     *             @OA\Property(property="course_id", type="integer")
     *         )
     *     ),
     *     @OA\Response(response=201, description="Lesson created successfully")
     * )
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'content_type' => 'required|string',
            'content_url' => 'required|string',
            'order' => 'required|integer',
            'course_id' => 'required|exists:courses,id',
        ]);

        $lesson = Lesson::create($validated);
        return response()->json($lesson, 201);
    }

    /**
     * @OA\Get(
     *     path="/lessons/{id}",
     *     tags={"Lessons"},
     *     summary="Get a single lesson",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="Lesson details"),
     *     @OA\Response(response=404, description="Lesson not found")
     * )
     */
    public function show($id)
    {
        $lesson = Lesson::find($id);
        if (!$lesson) {
            return response()->json(['message' => 'Lesson not found'], 404);
        }
        return response()->json($lesson);
    }

    /**
     * @OA\Put(
     *     path="/lessons/{id}",
     *     tags={"Lessons"},
     *     summary="Update an existing lesson",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="title", type="string"),
     *             @OA\Property(property="content_type", type="string"),
     *             @OA\Property(property="content_url", type="string"),
     *             @OA\Property(property="order", type="integer"),
     *             @OA\Property(property="course_id", type="integer")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Lesson updated successfully"),
     *     @OA\Response(response=404, description="Lesson not found")
     * )
     */
  public function update(Request $request, $id)
{
    $lesson = Lesson::find($id);

    if (!$lesson) {
        return response()->json(['message' => 'Lesson not found'], 404);
    }

    // التحقق من البيانات المرسلة
    $validatedData = $request->validate([
        'course_id' => 'nullable|uuid|exists:courses,id',
        'title' => 'required|string',
        'content_type' => 'required|in:Text,Video,File',
        'content_url' => 'nullable|string',
        'order' => 'nullable|integer',
    ]);

    $lesson->update($validatedData);

    return response()->json([
        'message' => 'Lesson updated successfully',
        'lesson' => $lesson
    ]);
}


    /**
     * @OA\Delete(
     *     path="/lessons/{id}",
     *     tags={"Lessons"},
     *     summary="Delete a lesson",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="Lesson deleted successfully"),
     *     @OA\Response(response=404, description="Lesson not found")
     * )
     */
    public function destroy($id)
    {
        $lesson = Lesson::find($id);
        if (!$lesson) {
            return response()->json(['message' => 'Lesson not found'], 404);
        }

        $lesson->delete();
        return response()->json(['message' => 'Lesson deleted successfully']);
    }
}
