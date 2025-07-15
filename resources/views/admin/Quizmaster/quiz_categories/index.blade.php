@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Quiz Categories</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <a href="{{ route('admin.quiz-categories.create') }}" class="btn btn-primary mb-2">Add Category</a>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Icon</th>
                <th>Language</th>
                <th>Status</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $key=>$cat)
            <tr>
                <td>{{ $cat->name }}</td>
                <td>
                    @if(Str::startsWith($cat->icon, 'http'))
                        <img src="{{ $cat->icon }}" alt="icon" width="40">
                    @else
                        {{ $cat->icon }}
                    @endif
                </td>
                <td>{{ $cat->lang }}</td>
                <td>
                    <span class="badge bg-{{ $cat->status ? 'success' : 'secondary' }}">
                        {{ $cat->status ? 'Active' : 'Inactive' }}
                    </span>
                </td>
                <td>{{ $cat->created_at->format('d M Y') }}</td>
                <td>
                    <a href="{{ route('admin.quiz-categories.edit', $cat->id) }}" class="btn btn-sm btn-warning">Edit</a>

                    <form method="POST" action="{{ route('admin.quiz-categories.destroy', $cat->id) }}" style="display:inline-block;">
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
        {{ $categories->links('pagination::bootstrap-4') }}
    </div>
</div>
@endsection
