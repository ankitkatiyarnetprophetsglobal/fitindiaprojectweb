@extends('admin.layouts.app')
@section('title', 'Fit India - Admin Dashboard')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Sunday on Cycling</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Sunday on Cycling</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            @if(Auth::user()->role_id != 10)
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            {{-- <h3>650000</h3> --}}
                            <h3>{{ $curcount ?? '' }}</h3>
                            <p>Total Registration</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
                        <a href="{{ url('admin/users') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!--
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                <div class="inner">
                    <h3>53<sup style="font-size: 20px">%</sup></h3>

                    <p>Bounce Rate</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            {{-- <h3>345000</h3> --}}
                            <h3>{{ $school_star_count ?? '' }}</h3>
                            <p>School Registrations</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
                        <a href="{{ url('admin/users') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        {{-- <a href="{{ url('admin/users') }}"></a> --}}
                    </div>
                </div>
                <!--
            <div class="col-lg-3 col-6">

                <div class="small-box bg-danger">
                <div class="inner">
                    <h3>65</h3>

                    <p>Unique Visitors</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            -->
            </div>
            @endif
            @if(Auth::user()->role_id == 10)
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $total_count_cyclothon ?? '' }}</h3>
                            <p>Total Count</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <a href="{{ url('admin/users') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $total_individual ?? '' }}</h3>
                            <p>Individual count</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <a href="{{ url('admin/users') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ $clubcountNamoSOC ?? '' }}</h3>
                            <p>Namo club count</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-users-cog"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <hr />
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <!-- small box -->
                    <div class="small-box bg-black">
                        <div class="inner">
                            <h3>{{ $national_sport_day_2025_count ?? '' }}</h3>
                            <p>National Sport day 2025 </p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-bicycle"></i>
                        </div>
                         <a href="{{ route('socadmin.soc_download_national_sport_day_2025') }}" class="small-box-footer">Download <i class="fas fa-download"></i></a> 
                    </div>
                </div>
            </div>
        </div>

        <div class="row" style="display: none;">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h5 class="m-0"><b>Event date:-</b> {{ $event_date ?? '' }}</h5>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            {{-- <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li> --}}
                            {{-- <li class="breadcrumb-item active">Dashboard</li> --}}
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12">
                <!-- small box -->
                <div class="small-box bg-light">
                    <div class="inner">
                        {{-- <h3>{{ $fourth_count ?? '' }}</h3> --}}
                        <p>Cycle Booked</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-bicycle"></i>
                    </div>
                    {{-- <a href="{{ route('socadmin.soc_download_report_cycle_return_data') }}" class="small-box-footer">Download <i class="fas fa-download"></i></a> --}}
                    <a href="https://fitindia.gov.in/soc-event-report" class="small-box-footer">Download <i class="fas fa-download"></i></a>
                </div>
            </div>

            {{-- <div class="col-lg-4 col-md-6 col-sm-12">
                    <!-- small box -->
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3>{{ $fifth_count ?? '' }}</h3>
            <p>Not Booking</p>
        </div>
        <div class="icon">
            <i class="fas fa-user-times"></i>
        </div>
        <a href="{{ route('socadmin.soc_download_event_report_data') }}" class="small-box-footer">Download <i class="fas fa-download"></i></a>
        <a href="https://fitindia.gov.in/soc-event-report-data" class="small-box-footer">Download <i class="fas fa-download"></i></a>
</div>
</div> --}}

<div class="col-lg-4 col-md-6 col-sm-12">
    <div class="small-box bg-secondary">
        <div class="inner">
            {{-- <h3>{{ $sixth_count ?? '' }}</h3> --}}
            <p>Cycle Allotted</p>
        </div>
        <div class="icon">
            <i class="fas fa-bicycle"></i>
        </div>
        {{-- <a href="{{ route('socadmin.soc_download_report_both_data') }}" class="small-box-footer">Download <i class="fas fa-download"></i></a> --}}
        <a href="https://fitindia.gov.in/soc-report-both-table-data" class="small-box-footer">Download <i class="fas fa-download"></i></a>
    </div>
</div>
<div class="col-lg-4 col-md-6 col-sm-12">
    <!-- small box -->
    <div class="small-box bg-success">
        <div class="inner">
            {{-- <h3>{{ $seventh_count ?? '' }}</h3> --}}
            <p>Cycle Returned</p>
        </div>
        <div class="icon">
            <i class="fas fa-bicycle"></i>
        </div>
        {{-- <a href="{{ route('socadmin.soc_download_report_cycle_return_data') }}" class="small-box-footer">Download <i class="fas fa-download"></i></a> --}}
        <a href="https://fitindia.gov.in/soc-report-cycle-return-data" class="small-box-footer">Download <i class="fas fa-download"></i></a>
    </div>
</div>
</div>
<div class="row">

</div>
@endif
</div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>


@endsection