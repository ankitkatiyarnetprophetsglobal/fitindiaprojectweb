@extends('layouts.app')
@section('content')
<div class="container">
    <h2>Edit Quiz Title</h2>
    <form method="POST" action="{{ route('admin.quiz-titles.update', $quiz->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Category</label>
            <select name="quiz_categories_id" class="form-control">
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ $quiz->quiz_categories_id == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Title Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $quiz->name) }}" required>
        </div>

        <div class="form-group">
            <label>Description</label>
            <textarea name="description" class="form-control" rows="4">{{ old('description', $quiz->description) }}</textarea>
        </div>

        <div class="form-group">
            <label>Icon</label><br>
            @if($quiz->icon)
                <img src="{{ asset('storage/' . $quiz->icon) }}" alt="Icon" width="80" class="mb-2"><br>
            @endif
            <input type="file" name="icon" class="form-control-file">
        </div>

        <div class="form-group">
            <label>Duration (in minutes)</label>
            <input type="number" name="duration" class="form-control" min="1" value="{{ old('duration', $quiz->duration) }}">
        </div>

        <div class="form-check mt-3">
            <input type="checkbox" name="status" class="form-check-input" id="status" value="1"
                {{ old('status', $quiz->status) ? 'checked' : '' }}>
            <label class="form-check-label" for="status">Active</label>
        </div>

        <br>
        <button class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
