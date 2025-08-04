@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add New App Version</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>There were some errors:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.app_versions.store') }}" method="POST">
        @csrf

        @include('admin.Quizmaster.app_versions.form')

        <button type="submit" class="btn btn-success">Save</button>
        <a href="{{ route('admin.app_versions.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
