<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationApiController extends Controller
{
    public function index()
    {
        return response()->json(Notification::all(), 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|uuid',
            'title' => 'nullable|string|max:255',
            'message' => 'required|string',
            'read' => 'nullable|boolean',
        ]);

        $notification = Notification::create([
            'user_id' => $validated['user_id'],
            'title' => $validated['title'] ?? null,
            'message' => $validated['message'],
            'read' => $validated['read'] ?? false,
        ]);

        return response()->json($notification, 201);
    }

    public function show($id)
    {
        return response()->json(Notification::findOrFail($id), 200);
    }

    public function update(Request $request, $id)
    {
        $notification = Notification::findOrFail($id);

        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'message' => 'nullable|string',
            'read' => 'nullable|boolean',
        ]);

        $notification->update($validated);

        return response()->json($notification, 200);
    }

    public function destroy($id)
    {
        Notification::destroy($id);
        return response()->json(['message' => 'Deleted'], 204);
    }
}
