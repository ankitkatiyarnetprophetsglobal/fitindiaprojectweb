@extends('layouts.app')
@section('content')
<div class="container">
    <h2>Add Question</h2>
    <form method="POST" action="{{ route('admin.quiz-questions.store') }}">
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
            <label>Quiz</label>
            <select name="quiz_title_list_id" class="form-control">
                @foreach($quizzes as $q)
                    <option value="{{ $q->id }}">{{ $q->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group"><label>Question</label><input name="question" class="form-control" required></div>
        <div class="form-group"><label>Option 1</label><input name="option1" class="form-control" required></div>
        <div class="form-group"><label>Option 2</label><input name="option2" class="form-control" required></div>
        <div class="form-group"><label>Option 3</label><input name="option3" class="form-control"></div>
        <div class="form-group"><label>Option 4</label><input name="option4" class="form-control"></div>
        <div class="form-group"><label>Option 5</label><input name="option5" class="form-control"></div>
        <div class="form-group"><label>Answer</label><input name="answer" class="form-control" required></div>
        
        <div class="form-group"><label>Answer Remark</label><input name="ans_remark" class="form-control" required></div>
        <div class="form-group"><label>Mark</label><input name="mark" class="form-control" required></div>
        <div class="form-group"><label>Duration</label><input name="time" class="form-control" required></div>
            {{-- Language --}}
        <div class="form-group mt-3">
            <label>Language</label>
            <select name="lang" class="form-control">
                <option value="en">English</option>
                <option value="hi">Hindi</option>
                <!-- Add more languages as needed -->
            </select>
        </div>

        {{-- Status --}}
        <div class="form-check mt-3">
            <input type="checkbox" name="status" class="form-check-input" id="status" value="1" checked>
            <label class="form-check-label" for="status">Active</label>
        </div>
        <br>
        <button class="btn btn-primary">Save</button>
    </form>
</div>
@endsection
