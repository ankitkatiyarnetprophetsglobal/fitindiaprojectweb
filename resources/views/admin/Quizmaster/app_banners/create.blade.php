@extends('layouts.app')

@section('content')
<div class="container">
    <h2>{{ isset($banner) ? 'Edit' : 'Add New' }} Banner</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
    @endif

    <form method="POST" action="{{ isset($banner) ? route('admin.app_banners.update', $banner->id) : route('admin.app_banners.store') }}">
        @csrf
        @if(isset($banner)) @method('PUT') @endif

        @include('admin.Quizmaster.app_banners.form', ['banner' => $banner ?? null])

        <button type="submit" class="btn btn-success">Save</button>
        <a href="{{ route('admin.app_banners.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
