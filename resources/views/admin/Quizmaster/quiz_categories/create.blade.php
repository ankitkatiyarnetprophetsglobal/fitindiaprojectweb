@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add Quiz Category</h2>
    <form method="POST" action="{{ route('admin.quiz-categories.store') }}">
        @csrf

        {{-- Name --}}
        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        {{-- Icon URL --}}
        <div class="form-group mt-3">
            <label>Icon URL</label>
            <input type="text" name="icon" class="form-control" placeholder="https://fitindia.gov.in/resources/imgs/quiz_icon/...">
        </div>

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
