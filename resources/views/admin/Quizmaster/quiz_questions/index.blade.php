@extends('layouts.app')
@section('content')
<div class="container">
    <h2>Quiz Questions</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <a href="{{ route('admin.quiz-questions.create') }}" class="btn btn-primary mb-2">Add Question</a>
    <table class="table table-bordered">
        <tr>
            <th>Question</th>
            <th>Quiz</th>
            <th>Answer</th>
            <th>Actions</th>
        </tr>
        @foreach($questions as $q)
        <tr>
            <td>{{ $q->question }}</td>
            <td>{{ $q->quiz->name ?? 'N/A' }}</td>
            <td>{{ $q->answer }}</td>
            <td>
                <a href="{{ route('admin.quiz-questions.edit', $q->id) }}" class="btn btn-sm btn-warning">Edit</a>
                <form method="POST" action="{{ route('admin.quiz-questions.destroy', $q->id) }}" style="display:inline-block;">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
     {{-- ✅ Pagination --}}
    <div class="mt-3">
        {{ $questions->links('pagination::bootstrap-4') }}
    </div>
</div>
@endsection
