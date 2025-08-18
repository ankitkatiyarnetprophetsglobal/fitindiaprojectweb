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
                    <h1>Soc Report</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Soc Report</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card p-3">
                            <h4>Cycle Booked</h4>
                            <form action="{{ route('admin.soc-reports.download') }}" method="GET">
                                <input type="date" name="date" class="form-control" required>
                                <input type="hidden" name="type" value="booked">
                                <button type="submit" class="btn btn-primary mt-2">Download</button>
                            </form>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card p-3 bg-secondary text-white">
                            <h4>Cycle Allotted</h4>
                            <form action="{{ route('admin.soc-reports.download') }}" method="GET">
                                <input type="date" name="date" class="form-control" required>
                                <input type="hidden" name="type" value="allotted">
                                <button type="submit" class="btn btn-light mt-2">Download</button>
                            </form>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card p-3 bg-success text-white">
                            <h4>Cycle Returned</h4>
                            <form action="{{ route('admin.soc-reports.download') }}" method="GET">
                                <input type="date" name="date" class="form-control" required>
                                <input type="hidden" name="type" value="returned">
                                <button type="submit" class="btn btn-light mt-2">Download</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            
        </div>
    </section>

</div>
@endsection