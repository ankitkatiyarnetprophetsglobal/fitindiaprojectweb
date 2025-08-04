@extends('layouts.app')
@section('title', 'Fit India Photo Stream | Fit India')
@section('content')
<style>
    .my-ui-pro .freedombtn1{
        margin: 0;
    }
    .my-ui-pro .freedombtn3{
        margin: 0;
    }
    .my-ui-pro .my-ui-div{
        display: flex;
        align-items: center;
        justify-content: center;
        /* padding-top: 120px; */
    }
    table, th, td {
    border: 2px solid #131313;
    /* border-collapse: collapse; */
    }
</style>
@php
    $active_section = request()->segment(count(request()->segments()));
    $active_section_id = trim($active_section);
@endphp
<section id="{{ $active_section_id }}">
  <div class="container">
        {{-- <div class="row">
            <div class="col-sm-12  flex_parent ">
                <h2 class="heading_h2">Cyclothon Registration Role Wise</h2>
            </div>
            <div>Total count:- {{ $data_total_count_cyclothon ?? '' }}</div>
            <div>individual count:- {{ $data_total_count_cyclothon_individual ?? '' }}</div>
            <div>organization count:- {{ $data_total_count_cyclothon_organization ?? '' }}</div>
            <div>club count:- {{ $data_total_count_cyclothon_club ?? '' }}</div>
        </div> --}}
        {{-- <div class="col-sm-12  flex_parent ">
            <h2 class="heading_h2">
                Sunday on cycle registration date
            </h2>
        </div>
        <table class="table table-bordered my-ui-pro">
            <tbody>
                <tr>
                    <th scope="row"><div class="my-ui-div"><a class="freedombtn1" href="javascript:void(0);">Total count:- {{ $data_total_count_cyclothon ?? '' }}</a></div></th>
                    <td><div class="my-ui-div"><a class="freedombtn3" href="javascript:void(0);">Individual count:- {{ $total_individual ?? '' }}</a></div></td>
                    <td><div class="my-ui-div"><a class="freedombtn3 freedombtn4" href="javascript:void(0);" data-target="#merchandisId">Organization count:- {{ $data_total_count_cyclothon_organization ?? '' }}</a></div></td>
                    <td><div class="my-ui-div"><a class="freedombtn3 freedombtn4" style="background-color:#f2101b;" href="javascript:void(0);" data-target="#merchandisId">Club count:- {{ $data_total_count_cyclothon_club ?? '' }}</a></div></td>
                </tr>
            </tbody>
          </table> --}}


                <div class="table-responsive ">
                    <table class="table table-bordered  my-ui-pro">
                        <thead>
                        <tr>
                            {{-- <th  style="background-color: #1378f3; color:#ffffff;" colspan="4"> --}}
                            <th  style="background-color: #1378f3; color:#ffffff; min-height:44px;" colspan="5">
                                <h6 class="mb-0" style="font-weight: 700 !important;">Sunday on cycle registration data</h6>
                            </th>
                            {{-- <th scope="row"><div class="my-ui-div"><a class="freedombtn1" href="javascript:void(0);">Total count:- {{ $data_total_count_cyclothon ?? '' }}</a></div></th> --}}
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    {{-- <div class="my-ui-div"><a class="freedombtn1" href="javascript:void(0);">Total count:- {{ $data_total_count_cyclothon ?? '' }}</div></a> --}}
                                    <div class="my-ui-div"><a class="freedombtn1" href="javascript:void(0);">Total count:- {{ $total_count_cyclothon ?? '' }}</div></a>
                                </td>
                                <td>
                                    <div class="my-ui-div"><a class="freedombtn3" href="javascript:void(0);">Individual count:- {{ $total_individual ?? '' }}</div></a>
                                </td>
                                {{-- <td>
                                    <div class="my-ui-div"><a class="freedombtn3 freedombtn4" href="javascript:void(0);" data-target="#merchandisId">Organization count:- {{ $data_total_count_cyclothon_organization ?? '' }}</div></a>
                                </td> --}}
                                <td>
                                    {{-- <div class="my-ui-div"><a class="freedombtn3 freedombtn4" style="background-color:#f2101b;" href="javascript:void(0);" data-target="#merchandisId">Club count (Namo + SOC):- {{ $clubcountNamoSOC ?? '' }}</div></a> --}}
                                    <div class="my-ui-div"><a class="freedombtn3 freedombtn4" style="background-color:#f2101b;" href="javascript:void(0);" data-target="#merchandisId">Namo club count:- {{ $clubcountNamoSOC ?? '' }}</div></a>
                                </td>
                                {{-- <td>
                                    <div class="my-ui-div"><a class="freedombtn3 freedombtn4" style="background-color:#009688;" href="javascript:void(0);" data-target="#merchandisId">Namo cycling club:- {{ $data_total_count_namo_fit_india_cycling_club ?? '' }}</div></a>
                                </td> --}}
                            </tr>
                        </tbody>
                    </table>

                </div>

                {{-- <div class="table-responsive ">
                    <table class="table table-bordered  my-ui-pro">
                        <thead>
                        <tr>
                            <th  style="background-color: #1378f3; color:#ffffff; min-height:44px;" colspan="5">
                                <h6 class="mb-0" style="font-weight: 700 !important;">Sunday on cycle registration data</h6>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="my-ui-div"><a class="freedombtn1" href="javascript:void(0);">Total count:-{{ $total_count_cyclothon ?? '' }}</div></a>
                                </td>
                                <td>
                                    <div class="my-ui-div"><a class="freedombtn3" href="javascript:void(0);">Individual count:-{{ $total_individual ?? '' }}</div></a>
                                </td>
                                <td>
                                    <div class="my-ui-div"><a class="freedombtn3 freedombtn4" href="javascript:void(0);" data-target="#merchandisId">Organization count:-{{ $data_total_count_cyclothon_organization ?? '' }}</div></a>
                                </td>
                                <td>
                                    <div class="my-ui-div"><a class="freedombtn3 freedombtn4" style="background-color:#f2101b;" href="javascript:void(0);" data-target="#merchandisId">SOC Club:-{{ $data_total_count_cyclothon_club ?? '' }}</div></a>
                                </td>
                                <td>
                                    <div class="my-ui-div"><a class="freedombtn3 freedombtn4" style="background-color:#2710f2;" href="javascript:void(0);" data-target="#merchandisId">Namo Fit India Club For Cycling :-{{ $data_total_count_namo_fit_india_cycling_club ?? '' }}</div></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div> --}}


        </section>
@endsection
