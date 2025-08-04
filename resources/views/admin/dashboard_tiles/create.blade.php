@extends('admin.layouts.app')
@section('title', 'Create Posts - Fit India')
@section('content')
<style>
    .mb-3 {
        margin-bottom: 0 !important;
        margin-right: 10px;
    }

    .btn-sm {
        padding: .375rem .75rem;
    }

    .rtside {
        float: right;
    }
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <a class="" href="{{ route('admin.dashboard-tiles.index') }}"> <i class="fas fa-long-arrow-alt-left"></i> Back </a>
                    <h1 scope="col">Add Dashboard tile</h1>
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <div class="pull-right">

                        </div>
                    </ol>
                </div>

                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('admin.dashboard-tiles.index') }}">Add Dashboard tile</a></li>
                    </ol>
                </div>

            </div>
        </div><!-- /.container-fluid -->
    </section>


    <!-- Main content -->

    <section class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-12">
                    <!-- general form elements -->

                    <div class="card">
                        <div class="card-header bg-primary">Add Dashboard tile</div>
                        <div class="card-body">
                    <form action="{{ isset($dashboardTile) ? route('admin.dashboard-tiles.update', $dashboardTile->id) : route('admin.dashboard-tiles.store') }}" method="POST">
                            @csrf
                            @if(isset($dashboardTile)) @method('PUT') @endif

                            <div class="mb-3">
                                <label>Card Heading (Title)</label>
                                <input type="text" name="title" class="form-control" value="{{ $dashboardTile->title ?? old('title') }}" required>
                            </div>

                            <div class="mb-3">
                                <label>Card Description</label>
                                <input type="text" name="description" class="form-control" value="{{ $dashboardTile->description ?? old('description') }}" required>
                            </div>
                            <div class="mb-3  py-2">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <a href="{{ route('admin.dashboard-tiles.index') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

@endsection