@extends('admin.layouts.app')
@section('title', 'Fit India Admin-All Posts')

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

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Manage Dashboard</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Manage Dashboard</li>
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
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-12">
                                    <!-- <a href="{{ route('admin.dashboard-tiles.create') }}" class="btn btn-primary mb-3">+ Add New Tile</a> -->
                                     <br>
                                    @if(session('success'))
                                    <div class="alert alert-success py-2">{{ session('success') }}</div>
                                    @endif

                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Title</th>
                                                <th>Description</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($tiles as $tile)
                                            <tr>
                                                <td>{{ $tile->id }}</td>
                                                <td>{{ $tile->title }}</td>
                                                <td>{{ $tile->description }}</td>
                                                <td>
                                                    <a href="{{ route('admin.dashboard-tiles.edit', $tile->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                                    <!-- <form action="{{ route('admin.dashboard-tiles.destroy', $tile->id) }}" method="POST" style="display:inline;">
                                                        @csrf @method('DELETE')
                                                        <button onclick="return confirm('Delete this tile?')" class="btn btn-danger btn-sm">Delete</button>
                                                    </form> -->
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                    {{ $tiles->links() }}
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
@endsection