@extends('layouts.app')
@section('content')
<div class="container py-5">
    <h2 class="text-center mb-5 fw-bold">🎯 Quiz Management Dashboard</h2>

    <div class="row justify-content-center mb-4">
        <div class="col-md-3 mb-3">
            <a href="{{ url('quiz-categories') }}" class="btn btn-outline-warning w-100 shadow-sm">
                <i class="bi bi-collection"></i> Manage Quiz Categories
            </a>
        </div>
        <div class="col-md-3 mb-3">
            <a href="{{ url('quiz-titles') }}" class="btn btn-outline-secondary w-100 shadow-sm">
                <i class="bi bi-list-task"></i> Manage Quiz Titles
            </a>
        </div>
        <div class="col-md-3 mb-3">
            <a href="{{ url('quiz-questions') }}" class="btn btn-outline-success w-100 shadow-sm">
                <i class="bi bi-patch-question"></i> Manage Quiz Questions
            </a>
        </div>
    </div>

    <h4 class="text-center mt-5 mb-4 fw-semibold">📱 Manage Mobile Version</h4>
    <div class="row justify-content-center mb-4">
        <div class="col-md-3">
            <a href="{{ url('app_versions') }}" class="btn btn-dark w-100 shadow-sm">
                <i class="bi bi-phone"></i> Manage Version
            </a>
        </div>
    </div>

    <h4 class="text-center mt-5 mb-4 fw-semibold">🖼️ Manage Mobile Banner</h4>
    <div class="row justify-content-center">
        <div class="col-md-3">
            <a href="{{ url('app_banners') }}" class="btn btn-warning text-dark w-100 shadow-sm">
                <i class="bi bi-image"></i> Manage Banner
            </a>
        </div>
    </div>
</div>

@endsection
