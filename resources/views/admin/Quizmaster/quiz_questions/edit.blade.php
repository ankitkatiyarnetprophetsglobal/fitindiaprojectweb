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
        <br>
        <button class="btn btn-success">Update</button>
    </form>
</div>
@endsection
