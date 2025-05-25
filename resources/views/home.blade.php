@extends('layouts.app')

@section('content')
    <h1>Certificates List</h1>

    @if($certificates->isEmpty())
        <p>No certificates found.</p>
    @else
        <table border="1" cellpadding="8" cellspacing="0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Student ID</th>
                    <th>Course ID</th>
                    <th>Issued At</th>
                </tr>
            </thead>
            <tbody>
                @foreach($certificates as $certificate)
                    <tr>
                        <td>{{ $certificate->id }}</td>
                        <td>{{ $certificate->student_id }}</td>
                        <td>{{ $certificate->course_id }}</td>
                        <td>{{ $certificate->issued_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
