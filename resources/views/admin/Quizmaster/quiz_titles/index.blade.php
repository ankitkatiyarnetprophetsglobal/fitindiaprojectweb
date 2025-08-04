@extends('layouts.app')
@section('content')
<div class="container">
    <h2>Quiz Titles</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <a href="{{ route('admin.quiz-titles.create') }}" class="btn btn-primary mb-2">Add Quiz</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Title</th>
                <th>Category</th>
                <th>Description</th>
                <th>Icon</th>
                <th>Duration (minutes)</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach($titles as $quiz)
        <tr>
            <td>{{ $quiz->name }}</td>
            <td>{{ $quiz->category->name ?? '-' }}</td>
            <td>{{ Str::limit($quiz->description, 50) }}</td>
            <td>
                @if($quiz->icon)
                    <img src="{{ asset('storage/' . $quiz->icon) }}" alt="Icon" width="40" height="40">
                @else
                    <span>-</span>
                @endif
            </td>
            <td>{{ $quiz->duration ?? '-' }}</td>
            <td>
                @if($quiz->status)
                    <span class="badge badge-success">Active</span>
                @else
                    <span class="badge badge-secondary">Inactive</span>
                @endif
            </td>
            <td>
                <a href="{{ route('admin.quiz-titles.edit', $quiz->id) }}" class="btn btn-sm btn-warning">Edit</a>
                <form method="POST" action="{{ route('admin.quiz-titles.destroy', $quiz->id) }}" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
     {{-- ✅ Pagination --}}
    <div class="mt-3">
        {{ $titles->links('pagination::bootstrap-4') }}
    </div>
</div>
@endsection
