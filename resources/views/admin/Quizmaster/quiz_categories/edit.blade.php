@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Quiz Category</h2>
    <form method="POST" action="{{ route('admin.quiz-categories.update', $quizCategory->id) }}">
        @csrf
        @method('PUT')

        {{-- Name --}}
        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $quizCategory->name) }}" required>
        </div>

        {{-- Icon URL --}}
        <div class="form-group mt-3">
            <label>Icon URL</label>
            <input type="text" name="icon" class="form-control" value="{{ old('icon', $quizCategory->icon) }}">
        </div>

        {{-- Language --}}
        <div class="form-group mt-3">
            <label>Language</label>
            <select name="lang" class="form-control">
                <option value="en" {{ $quizCategory->lang == 'en' ? 'selected' : '' }}>English</option>
                <option value="hi" {{ $quizCategory->lang == 'hi' ? 'selected' : '' }}>Hindi</option>
                <!-- Add more languages if needed -->
            </select>
        </div>

        {{-- Status --}}
        <div class="form-check mt-3">
            <input type="checkbox" name="status" class="form-check-input" id="status"
                   value="1" {{ $quizCategory->status == 1 ? 'checked' : '' }}>
            <label class="form-check-label" for="status">Active</label>
        </div>

        <br>
        <button class="btn btn-success">Update</button>
    </form>
</div>
@endsection
