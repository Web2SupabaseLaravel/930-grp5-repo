<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;

class ReportController extends Controller
{
    public function index()
    {
        $reports = Report::orderBy('created_at', 'desc')->paginate(10);
        return view('reports.index', compact('reports'));
    }

    public function create()
    {
        $data['report'] = new Report();
        $data['route'] = 'reports.store';
        $data['method'] = 'post';
        $data['titleForm'] = 'Form Input Report';
        $data['submitButton'] = 'Submit';

        $data['types'] = [
            'technical_issue' => 'Technical Issue',
            'become_instructor' => 'Become Instructor',
            'certificate_request' => 'Certificate Request',
        ];

        $data['statuses'] = [
            'pending' => 'Pending',
            'reviewed' => 'Reviewed',
            'resolved' => 'Resolved',
        ];

        return view('reports.form_report', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'reporter_id' => 'required|uuid|exists:users,id',
            'type' => 'required|in:technical_issue,become_instructor,certificate_request',
            'message' => 'nullable|string',
            'course_id' => 'nullable|uuid|exists:courses,id',
            'lesson_id' => 'nullable|uuid|exists:lessons,id',
            'status' => 'nullable|in:pending,reviewed,resolved',
        ]);

        $report = Report::create([
            'reporter_id' => $request->reporter_id,
            'type' => $request->type,
            'message' => $request->message,
            'course_id' => $request->course_id,
            'lesson_id' => $request->lesson_id,
            'status' => $request->status ?? 'pending',
        ]);

        return redirect()->route('reports.index')->with('success', 'Report submitted successfully.');
    }

    public function show($id)
    {
        $report = Report::findOrFail($id);
        return view('reports.show', compact('report'));
    }

    public function edit($id)
    {
        $report = Report::findOrFail($id);

        $data['report'] = $report;
        $data['route'] = ['reports.update', $id];
        $data['method'] = 'put';
        $data['titleForm'] = 'Edit Report';
        $data['submitButton'] = 'Update';

        $data['types'] = [
            'technical_issue' => 'Technical Issue',
            'become_instructor' => 'Become Instructor',
            'certificate_request' => 'Certificate Request',
        ];

        $data['statuses'] = [
            'pending' => 'Pending',
            'reviewed' => 'Reviewed',
            'resolved' => 'Resolved',
        ];

        return view('reports.form_report', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'reporter_id' => 'required|uuid|exists:users,id',
            'type' => 'required|in:technical_issue,become_instructor,certificate_request',
            'message' => 'nullable|string',
            'course_id' => 'nullable|uuid|exists:courses,id',
            'lesson_id' => 'nullable|uuid|exists:lessons,id',
            'status' => 'nullable|in:pending,reviewed,resolved',
        ]);

        $report = Report::findOrFail($id);
        $report->update([
            'reporter_id' => $request->reporter_id,
            'type' => $request->type,
            'message' => $request->message,
            'course_id' => $request->course_id,
            'lesson_id' => $request->lesson_id,
            'status' => $request->status ?? 'pending',
        ]);

        return redirect()->route('reports.show', $id)->with('success', 'Report updated successfully.');
    }
}
