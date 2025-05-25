<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::all();
        return view('notification.index', compact('notifications'));
    }

    public function create()
    {
        return view('notification.create', [
            'notification' => new Notification(),
            'route' => 'notification.store',
            'submitButton' => 'Create Notification',
            'titleForm' => 'Create New Notification',
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|uuid',
            'title' => 'nullable|string|max:255',
            'message' => 'required|string',
            'read' => 'nullable|boolean',
        ]);

        Notification::create([
            'user_id' => $request->user_id,
            'title' => $request->title,
            'message' => $request->message,
            'read' => $request->has('read') ? true : false,
        ]);

        return redirect()->route('notification.index')->with('success', 'Notification created successfully!');
    }

}
