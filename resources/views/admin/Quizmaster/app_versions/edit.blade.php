@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit App Version</h2>

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

    <form action="{{ route('admin.app_versions.update', $version->id) }}" method="POST">
        @csrf
        @method('PUT')

        @include('admin.Quizmaster.app_versions.form', ['version' => $version])

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('admin.app_versions.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
