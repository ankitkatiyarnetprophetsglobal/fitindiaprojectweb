@extends('layouts.app')
@section('content')
<div class="container py-5">
    <h2 class="text-center mb-5 fw-bold">🎯 Quiz Management Dashboard</h2>

    <div class="row justify-content-center mb-4">
        <div class="col-md-3 mb-3">
            <a href="{{ url('admin/quiz-categories') }}" class="btn btn-outline-warning w-100 shadow-sm">
                <i class="bi bi-collection"></i> Manage Quiz Categories
            </a>
        </div>
        <div class="col-md-3 mb-3">
            <a href="{{ url('admin/quiz-titles') }}" class="btn btn-outline-secondary w-100 shadow-sm">
                <i class="bi bi-list-task"></i> Manage Quiz Titles
            </a>
        </div>
        <div class="col-md-3 mb-3">
            <a href="{{ url('admin/quiz-questions') }}" class="btn btn-outline-success w-100 shadow-sm">
                <i class="bi bi-patch-question"></i> Manage Quiz Questions
            </a>
        </div>
    </div>

    <h4 class="text-center mt-5 mb-4 fw-semibold">📱 Manage Mobile Version</h4>
    <div class="row justify-content-center mb-4">
        <div class="col-md-3">
            <a href="{{ url('admin/app_versions') }}" class="btn btn-dark w-100 shadow-sm">
                <i class="bi bi-phone"></i> Manage Version
            </a>
        </div>
    </div>

    <h4 class="text-center mt-5 mb-4 fw-semibold">🖼️ Manage Mobile Banner</h4>
    <div class="row justify-content-center">
        <div class="col-md-3">
            <a href="{{ url('admin/app_banners') }}" class="btn btn-warning text-dark w-100 shadow-sm">
                <i class="bi bi-image"></i> Manage Banner
            </a>
        </div>
    </div>
    <h4 class="text-center mt-5 mb-4 fw-semibold">🖼️ Manage Event Master</h4>
    <div class="row justify-content-center">
        <div class="col-md-3">
            <a href="{{ url('admin/soc-events') }}" class="btn btn-outline-info text-dark w-100 shadow-sm">
                <i class="bi bi-image"></i> Manage Event
            </a>
        </div>
    </div>

     <h4 class="text-center mt-5 mb-4 fw-semibold">🖼️ Manage Queries  </h4>
    <div class="row justify-content-center">
        <div class="col-md-3">
            <a href="{{ url('admin/soc-events') }}" class="btn btn-outline-info text-dark w-100 shadow-sm">
                <i class="bi bi-image"></i> Manage Query 
            </a>
        </div>
    </div>
</div>

@endsection
