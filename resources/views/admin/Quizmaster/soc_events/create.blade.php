@extends('admin.layouts.app')
@section('title', 'Fit India Admin-Create Event')

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
                    <h1>Create Event Master</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Create Event Master</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="{{ isset($soc_event) ? route('admin.soc-events.update', $soc_event->id) : route('admin.soc-events.store') }}" method="POST">
                                        @csrf
                                        @if(isset($soc_event)) @method('PUT') @endif

                                        <input type="text" name="venue" placeholder="Venue" class="form-control mb-2" value="{{ old('venue', $soc_event->venue ?? '') }}">
                                        <input type="number" name="cycle" placeholder="Cycle" class="form-control mb-2" value="{{ old('cycle', $soc_event->cycle ?? '') }}">
                                        <input type="number" name="t_shirt" placeholder="T-Shirt" class="form-control mb-2" value="{{ old('t_shirt', $soc_event->t_shirt ?? '') }}">
                                        <input type="number" name="meal" placeholder="Meal" class="form-control mb-2" value="{{ old('meal', $soc_event->meal ?? '') }}">
                                        <input type="text" name="latitude" placeholder="Latitude" class="form-control mb-2" value="{{ old('latitude', $soc_event->latitude ?? '') }}">
                                        <input type="text" name="longitude" placeholder="Longitude" class="form-control mb-2" value="{{ old('longitude', $soc_event->longitude ?? '') }}">
                                        <input type="date" name="event_date" class="form-control mb-2" value="{{ old('event_date', $soc_event->event_date ?? '') }}">
                                        <select name="status" class="form-control mb-2">
                                            <option value="1" {{ (old('status', $soc_event->status ?? '') == 1) ? 'selected' : '' }}>Active</option>
                                            <option value="0" {{ (old('status', $soc_event->status ?? '') == 0) ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                        <button type="submit" class="btn btn-success">{{ isset($soc_event) ? 'Update' : 'Save' }}</button>
                                    </form>
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
