@extends('layouts.app')

@section('content')
<div class="container">
    <h2>App Banners</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('app_banners.create') }}" class="btn btn-primary mb-3">+ Add New</a>

    <table class="table table-bordered table-sm">
        <thead>
            <tr>
                <th>ID</th><th>Name</th><th>Type</th><th>Landing URL</th><th>Banner URL</th><th>Lang</th><th>Duration</th>
                <th>Start</th><th>End</th><th>Order</th><th>Status</th><th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($banners as $banner)
                <tr>
                    <td>{{ $banner->id }}</td>
                    <td>{{ $banner->name }}</td>
                    <td>{{ $banner->type }}</td>
                    <td>{{ $banner->landing_url }}</td>
                    <td><a href="{{ $banner->banner_url }}" target="_blank">View</a></td>
                    <td>{{ $banner->language }}</td>
                    <td>{{ $banner->duration }}</td>
                    <td>{{ $banner->start_from }}</td>
                    <td>{{ $banner->end_to }}</td>
                    <td>{{ $banner->order }}</td>
                    <td>{{ $banner->status }}</td>
                    <td>
                        <a href="{{ route('app_banners.edit', $banner->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('app_banners.destroy', $banner->id) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $banners->links() }}
</div>
@endsection
