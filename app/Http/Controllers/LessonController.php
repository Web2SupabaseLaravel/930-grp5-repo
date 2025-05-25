<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lesson;
use Illuminate\Support\Str;
/**
 * @OA\Info(
 *     title="Learnify API",
 *     version="1.0.0",
 *     description="API documentation for the Learnify application"
 * )
 */

class LessonController extends Controller
{
    /**
     * @OA\Get(
     *     path="/lessons",
     *     summary="Get all lessons",
     *     tags={"Lessons"},
     *     @OA\Response(
     *         response=200,
     *         description="List of lessons"
     *     )
     * )
     */
    public function index()
    {
        $data['lessons'] = Lesson::all();
        $data['lessons'] = Lesson::paginate(10);
        return view('lesson.index', $data);
    }

    /**
     * @OA\Get(
     *     path="/lessons/create",
     *     summary="Get form to create a lesson",
     *     tags={"Lessons"},
     *     @OA\Response(
     *         response=200,
     *         description="Form to create a lesson"
     *     )
     * )
     */
    public function create()
    {
        $data['lesson'] = new Lesson();
        $data['route'] = route('lesson.store');
        $data['method'] = 'post';
        $data['titleForm'] = 'Add New Lesson';
        $data['submitButton'] = 'Submit';
        return view('lesson.create', $data);
    }

    /**
     * @OA\Post(
     *     path="/lessons",
     *     summary="Create a new lesson",
     *     tags={"Lessons"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"course_id", "title", "content_type"},
     *             @OA\Property(property="course_id", type="string", example="uuid-of-course"),
     *             @OA\Property(property="title", type="string", example="Lesson Title"),
     *             @OA\Property(property="content_type", type="string", example="Text"),
     *             @OA\Property(property="content_url", type="string", example="https://example.com"),
     *             @OA\Property(property="order", type="integer", example=1)
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Lesson created successfully"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Validation error"
     *     )
     * )
     */
    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|uuid',
            'title' => 'required|string',
            'content_type' => 'required|in:Text,Video,File',
            'content_url' => 'nullable|string',
            'order' => 'nullable|integer',
        ]);

        $lesson = new Lesson();
        $lesson->course_id = $request->course_id;
        $lesson->title = $request->title;
        $lesson->content_type = $request->content_type;
        $lesson->content_url = $request->content_url;
        $lesson->order = $request->order;
        $lesson->save();

        return redirect()->route('lesson.index')->with('success', 'Lesson created successfully!');
    }

    /**
     * @OA\Get(
     *     path="/lessons/{id}/edit",
     *     summary="Get form to edit a lesson",
     *     tags={"Lessons"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Lesson UUID",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Form to edit the lesson"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Lesson not found"
     *     )
     * )
     */
    public function edit($id)
    {
        if (!Str::isUuid($id)) {
            abort(404, 'Invalid UUID');
        }

        $lesson = Lesson::findOrFail($id);

        $data['lesson'] = $lesson;
        $data['route'] = route('lesson.update', $lesson->id);
        $data['method'] = 'put';
        $data['titleForm'] = 'Edit Lesson';
        $data['submitButton'] = 'Update';

        return view('lesson.edit', $data);
    }

    /**
     * @OA\Put(
     *     path="/lessons/{id}",
     *     summary="Update a lesson",
     *     tags={"Lessons"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Lesson UUID",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="course_id", type="string", example="uuid-of-course"),
     *             @OA\Property(property="title", type="string", example="Updated Lesson Title"),
     *             @OA\Property(property="content_type", type="string", example="Video"),
     *             @OA\Property(property="content_url", type="string", example="https://example.com"),
     *             @OA\Property(property="order", type="integer", example=2)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Lesson updated successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Lesson not found"
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        if (!Str::isUuid($id)) {
            abort(404, 'Invalid UUID');
        }

        $request->validate([
            'course_id' => 'required|uuid',
            'title' => 'required|string',
            'content_type' => 'required|in:Text,Video,File',
            'content_url' => 'nullable|string',
            'order' => 'nullable|integer',
        ]);

        $lesson = Lesson::findOrFail($id);
        $lesson->course_id = $request->course_id;
        $lesson->title = $request->title;
        $lesson->content_type = $request->content_type;
        $lesson->content_url = $request->content_url;
        $lesson->order = $request->order;
        $lesson->save();

        return redirect()->route('lesson.index')->with('success', 'Lesson updated successfully!');
    }

    /**
     * @OA\Delete(
     *     path="/lessons/{id}",
     *     summary="Delete a lesson",
     *     tags={"Lessons"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Lesson UUID",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Lesson deleted successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Lesson not found"
     *     )
     * )
     */
    public function destroy($id)
    {
        $lesson = Lesson::findOrFail($id);
        $lesson->delete();

        return redirect()->route('lesson.index')->with('success', 'Lesson deleted successfully!');
    }
}
