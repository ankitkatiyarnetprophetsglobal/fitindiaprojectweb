@extends('layouts.app')
@section('content')
<div class="container">
    <h2>Edit Question</h2>
    <form method="POST" action="{{ route('admin.quiz-questions.update', $question->id) }}">
        @csrf @method('PUT')
        <div class="form-group">
            <label>Category</label>
            <select name="quiz_categories_id" class="form-control">
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ $question->quiz_categories_id == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Quiz</label>
            <select name="quiz_title_list_id" class="form-control">
                @foreach($quizzes as $q)
                    <option value="{{ $q->id }}" {{ $question->quiz_title_list_id == $q->id ? 'selected' : '' }}>{{ $q->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group"><label>Question</label><input name="question" value="{{ $question->question }}" class="form-control" required></div>
        <div class="form-group"><label>Option 1</label><input name="option1" value="{{ $question->option1 }}" class="form-control" required></div>
        <div class="form-group"><label>Option 2</label><input name="option2" value="{{ $question->option2 }}" class="form-control" required></div>
        <div class="form-group"><label>Option 3</label><input name="option3" value="{{ $question->option3 }}" class="form-control"></div>
        <div class="form-group"><label>Option 4</label><input name="option4" value="{{ $question->option4 }}" class="form-control"></div>
        <div class="form-group"><label>Option 5</label><input name="option5" value="{{ $question->option5 }}" class="form-control"></div>
        <div class="form-group"><label>Answer</label><input name="answer" value="{{ $question->answer }}" class="form-control" required></div>
           <div class="form-group"><label>Answer Remark</label><input name="ans_remark" value="{{ $question->ans_remark }}" class="form-control" required></div>
        <div class="form-group"><label>Mark</label><input name="mark" value="{{ $question->mark }}" class="form-control" required></div>
        <div class="form-group"><label>Duration</label><input name="time" value="{{ $question->time }}" class="form-control" required></div>
       {{-- Language --}}
        <div class="form-group mt-3">
            <label>Language</label>
            <select name="lang" class="form-control">
                <option value="en" {{ $question->lang == 'en' ? 'selected' : '' }}>English</option>
                <option value="hi" {{ $question->lang == 'hi' ? 'selected' : '' }}>Hindi</option>
                <!-- Add more languages if needed -->
            </select>
        </div>

        {{-- Status --}}
        <div class="form-check mt-3">
            <input type="checkbox" name="status" class="form-check-input" id="status"
                   value="1" {{ $question->status == 1 ? 'checked' : '' }}>
            <label class="form-check-label" for="status">Active</label>
        </div>
        <br>
        <button class="btn btn-success">Update</button>
    </form>
</div>
@endsection
