@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-start">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{ $titleForm }}
                </div> 
                <div class="card-body">

                    {!! Form::model($report, ['route' => $route, 'method' => $method]) !!}
                    @csrf

                    <div class="form-group">
                        <label for="reporter_id">Reporter ID</label>
                        {!! Form::text('reporter_id', null, ['class'=>'form-control']) !!}
                        <span class="text-danger">{{ $errors->first('reporter_id') }}</span>
                    </div>

                    <div class="form-group">
                        <label for="type">Type</label>
                        {!! Form::select('type', [
                            'technical_issue' => 'Technical Issue',
                            'become_instructor' => 'Become Instructor',
                            'certificate_request' => 'Certificate Request'
                        ], null, ['class'=>'form-control', 'placeholder' => 'Select type']) !!}
                        <span class="text-danger">{{ $errors->first('type') }}</span>
                    </div>

                    <div class="form-group">
                        <label for="course_id">Course ID (Optional)</label>
                        {!! Form::text('course_id', null, ['class'=>'form-control']) !!}
                        <span class="text-danger">{{ $errors->first('course_id') }}</span>
                    </div>

                    <div class="form-group">
                        <label for="lesson_id">Lesson ID (Optional)</label>
                        {!! Form::text('lesson_id', null, ['class'=>'form-control']) !!}
                        <span class="text-danger">{{ $errors->first('lesson_id') }}</span>
                    </div>

                    <div class="form-group">
                        <label for="message">Message</label>
                        {!! Form::textarea('message', null, ['class'=>'form-control']) !!}
                        <span class="text-danger">{{ $errors->first('message') }}</span>
                    </div>

                    <div class="form-group">
                        {!! Form::submit($submitButton, ['class'=>'btn btn-primary']) !!}
                        {!! Form::close() !!}
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
