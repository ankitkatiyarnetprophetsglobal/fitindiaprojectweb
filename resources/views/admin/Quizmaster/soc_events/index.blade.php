@extends('layouts.app')

@section('content')
<div class="container">
    <a href="{{ route('admin.soc-events.create') }}" class="btn btn-primary mb-3">Add Event</a>
      @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Venue</th><th>Cycle</th><th>T-Shirt</th><th>Meal</th>
                <th>Latitude</th><th>Longitude</th><th>Event Date</th><th>Status</th><th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($events as $event)
            <tr>
                <td>{{ $event->venue }}</td>
                <td>{{ $event->cycle }}</td>
                <td>{{ $event->t_shirt }}</td>
                <td>{{ $event->meal }}</td>
                <td>{{ $event->latitude }}</td>
                <td>{{ $event->longitude }}</td>
                <td>{{ $event->event_date }}</td>
                <td>{{ $event->status }}</td>
                <td>
                    <a href="{{ route('admin.soc-events.edit', $event->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('admin.soc-events.destroy', $event->id) }}" method="POST" style="display:inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Delete?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{-- ✅ Pagination --}}
    <div class="mt-3">
        {{ $events->links('pagination::bootstrap-4') }}
    </div>
</div>
@endsection
