@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Query Export to Excel</h4>

    @if($errors->any())
        <div class="alert alert-danger">{{ $errors->first('query') }}</div>
    @endif

    <form method="POST" action="{{ route('admin.query.export') }}">
        @csrf
        <div class="mb-3">
            <textarea name="query" rows="5" class="form-control">SELECT * FROM soc_event_masters</textarea>
        </div>
        <button type="submit" class="btn btn-success">Export to Excel</button>
    </form>
</div>
@endsection
