@extends('layouts.app')

@section('content')
<div class="container">
    <h2>App Versions</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('app_versions.create') }}" class="btn btn-primary mb-3">+ Add New Version</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Platform</th>
                <th>Version</th>
                <th>Type</th>
                <th>Update Status</th>
                <th>Status</th>
                <th>Description</th>
                <th>Release Date</th>
                <th>Created Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($versions as $version)
                <tr>
                    <td>{{ $version->id }}</td>
                    <td>{{ $version->name }}</td>
                    <td>{{ $version->platform }}</td>
                    <td>{{ $version->version }}</td>
                    <td>{{ $version->type }}</td>
                    <td>{{ $version->updateStatus }}</td>
                    <td>{{ $version->status }}</td>
                    <td>{{ $version->description }}</td>
                    <td>{{ $version->release_date }}</td>
                    <td>{{ $version->created_date }}</td>
                    <td>
                        <a href="{{ route('app_versions.edit', $version->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('app_versions.destroy', $version->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
