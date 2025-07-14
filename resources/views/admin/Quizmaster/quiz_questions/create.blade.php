@extends('layouts.app')
@section('content')
<div class="container">
    <h2>Add Quiz Question Answer</h2>
    <form method="POST" action="{{ route('admin.quiz-questions.store') }}">
        @csrf

        <div class="form-group">
            <label>Category</label>
            <select name="quiz_categories_id" class="form-control" required>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ old('quiz_categories_id') == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Quiz Title</label>
            <select name="quiz_title_list_id" class="form-control" required>
                @foreach($titles as $title)
                    <option value="{{ $title->id }}" {{ old('quiz_title_list_id') == $title->id ? 'selected' : '' }}>
                        {{ $title->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Question</label>
            <textarea name="question" class="form-control" required>{{ old('question') }}</textarea>
        </div>

        <div class="form-group">
            <label>Option 1</label>
            <input type="text" name="option1" class="form-control" value="{{ old('option1') }}" required>
        </div>

        <div class="form-group">
            <label>Option 2</label>
            <input type="text" name="option2" class="form-control" value="{{ old('option2') }}" required>
        </div>

        <div class="form-group">
            <label>Option 3</label>
            <input type="text" name="option3" class="form-control" value="{{ old('option3') }}">
        </div>

        <div class="form-group">
            <label>Option 4</label>
            <input type="text" name="option4" class="form-control" value="{{ old('option4') }}">
        </div>

        <div class="form-group">
            <label>Option 5</label>
            <input type="text" name="option5" class="form-control" value="{{ old('option5') }}">
        </div>

        <div class="form-group">
            <label>Answer</label>
            <input type="text" name="answer" class="form-control" value="{{ old('answer') }}" required>
        </div>

        {{-- New Fields --}}
        <div class="form-group">
            <label>Answer Remark</label>
            <textarea name="ans_remark" class="form-control" rows="3">{{ old('ans_remark') }}</textarea>
        </div>

        <div class="form-group">
            <label>Mark</label>
            <input type="number" name="mark" class="form-control" min="0" value="{{ old('mark', 1) }}" required>
        </div>

        <div class="form-group">
            <label>Time</label>
            <input type="time" name="time" class="form-control" value="{{ old('time') ?? '00:00' }}" required>
        </div>

        <div class="form-group mt-3">
            <label>Language</label>
            <select name="lang" class="form-control">
                <option value="en">English</option>
                <option value="hi">Hindi</option>
                <!-- Add more languages as needed -->
            </select>
        </div>

        <div class="form-check mt-3">
            <input type="checkbox" name="status" id="status" value="1" class="form-check-input" checked>
            <label class="form-check-label" for="status">Active</label>
        </div>

        <br>
        <button class="btn btn-primary">Save</button>
    </form>
</div>
@endsection
