@extends('layouts.app')

@section('content')
<div class="container">
    <h1>All Lessons</h1>

    <a href="{{ route('lessons.create') }}" class="btn btn-primary mb-3">
        Add New Lesson
    </a>

    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Content Type</th>
                <th>Order</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($lessons as $lesson)
                <tr>
                    <td>{{ $lesson->title }}</td>
                    <td>{{ $lesson->content_type }}</td>
                    <td>{{ $lesson->order }}</td>
                    <td>
                        <a href="{{ route('lessons.edit', $lesson->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('lessons.destroy', $lesson->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"
                                onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

