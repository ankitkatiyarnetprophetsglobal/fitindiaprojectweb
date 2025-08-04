@extends('layouts.app')
<style>
    .col{
        padding: 30px;
    }
    .card{
        padding: inherit;
    }
</style>
@section('content')
<div class="container py-5">
    <h2 class="text-center mb-5 fw-bold text-primary">🎯 Quiz Management Dashboard</h2>

    <div class="row row-cols-1 row-cols-md-3 g-4 justify-content-center">

        {{-- Quiz Categories --}}
        <div class="col">
            <div class="card text-center shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title mb-3 fw-semibold">Quiz Categories</h5>
                    <a href="{{ url('admin/quiz-categories') }}" class="btn btn-outline-warning w-100">Manage Quiz Categories</a>
                </div>
            </div>
        </div>

        {{-- Quiz Titles --}}
        <div class="col">
            <div class="card text-center shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title mb-3 fw-semibold">Quiz Titles</h5>
                    <a href="{{ url('admin/quiz-titles') }}" class="btn btn-outline-secondary w-100">Manage Quiz Titles</a>
                </div>
            </div>
        </div>

        {{-- Quiz Questions --}}
        <div class="col">
            <div class="card text-center shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title mb-3 fw-semibold">Quiz Questions</h5>
                    <a href="{{ url('admin/quiz-questions') }}" class="btn btn-outline-success w-100">Manage Quiz Questions</a>
                </div>
            </div>
        </div>

        {{-- Mobile Version --}}
        <div class="col">
            <div class="card text-center shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title mb-3 fw-semibold">Mobile Version</h5>
                    <a href="{{ url('admin/app_versions') }}" class="btn btn-dark w-100">Manage Version</a>
                </div>
            </div>
        </div>

        {{-- Mobile Banner --}}
        <div class="col">
            <div class="card text-center shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title mb-3 fw-semibold">Mobile Banner</h5>
                    <a href="{{ url('admin/app_banners') }}" class="btn btn-warning text-dark w-100">Manage Banner</a>
                </div>
            </div>
        </div>

        {{-- Event Master --}}
        <div class="col">
            <div class="card text-center shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title mb-3 fw-semibold">Event Master</h5>
                    <a href="{{ url('admin/soc-events') }}" class="btn btn-outline-info w-100">Manage Event</a>
                </div>
            </div>
        </div>

        {{-- Query Export --}}
        <div class="col">
            <div class="card text-center shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title mb-3 fw-semibold">Query Export</h5>
                    <a href="{{ url('admin/query-export') }}" class="btn btn-outline-primary w-100">Manage Query</a>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
