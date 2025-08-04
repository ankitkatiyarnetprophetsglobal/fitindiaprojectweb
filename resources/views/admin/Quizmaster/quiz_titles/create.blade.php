@extends('layouts.app')
@section('content')
<div class="container">
    <h2>Add Quiz Title</h2>
    <form method="POST" action="{{ route('admin.quiz-titles.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label>Category</label>
            <select name="quiz_categories_id" class="form-control">
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Title Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Description</label>
            <textarea name="description" class="form-control" rows="4"></textarea>
        </div>

        <div class="form-group">
            <label>Icon</label>
            <input type="file" name="icon" class="form-control-file">
        </div>

        <div class="form-group">
            <label>Duration (in minutes)</label>
            <input type="number" name="duration" class="form-control" min="1">
        </div>

        <div class="form-check mt-3">
            <input type="checkbox" name="status" class="form-check-input" id="status" value="1" checked>
            <label class="form-check-label" for="status">Active</label>
        </div>

        <br>
        <button class="btn btn-primary">Save</button>
    </form>
</div>
@endsection
