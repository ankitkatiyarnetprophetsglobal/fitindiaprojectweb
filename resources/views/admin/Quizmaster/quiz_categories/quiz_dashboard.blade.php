@extends('layouts.app')
@section('content')
<div class="container text-center">
    <h2 class="mb-4">Quiz Management Dashboard</h2>

    <a href="{{ url('quiz-categories') }}" class="btn btn-primary m-2">
        Manage Quiz Categories
    </a>

    <a href="{{ url('quiz-titles') }}" class="btn btn-success m-2">
        Manage Quiz Titles
    </a>

    <a href="{{ url('quiz-questions') }}" class="btn btn-warning m-2">
        Manage Quiz Questions
    </a>
</div>
@endsection
