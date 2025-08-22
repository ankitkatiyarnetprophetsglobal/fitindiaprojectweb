@extends('layouts.app')
@section('title', 'Contact Us | Fit India')
@section('pageid','contact')
@section('content')
@php
    $active_section = request()->segment(count(request()->segments()));
    $active_section_id = trim($active_section);
@endphp

<section id="{{ $active_section_id }}">
        <div class="container">
            <div class="row ">
                <div class="col-sm-12 col-md-6 r_padd cont_base" >
                    <div class="cont_area shadow">
                        <h1>Contact Us</h1>
                        <div class="cont_inner" >
                            <ul>
                                <li><span class="icon_d"><i class="fa fa-phone" aria-hidden="true"></i></span> <span>Phone No:&nbsp; <span class="bkpoint"> 1800-202-5155, 1800-258-5155 </span></span></li>
                                
                                {{-- <li><span class="icon_d"><i class="fa fa-envelope-o" aria-hidden="true"></i></span><span>Email ID:&nbsp;<span class="bkpoint">contact[dot]fitindia[at]gmail[dot]com</span></span></li> --}}
                                <li><span class="icon_d"><i class="fa fa-envelope-o" aria-hidden="true"></i></span><span>Email ID:&nbsp;<span class="bkpoint">contact[at]fitindia[dot]gov[dot]in</span></span></li>
                                <li><span class="icon_d"><i class="fa fa-clock-o" aria-hidden="true"></i></span><span>Timing:&nbsp;<span class="bkpoint">Monday-Friday(9:00 - 5:30pm)</span></span></li>
                            </ul>
                        </div>
                    </div>                   
                </div>
               

                <div class="col-sm-12 col-md-6 r_padd cont_base" >
                    <div class="cont_area shadow mrgtp" style="background:#f9e4ec;">
                        <h1 style="background: #efb5cb;">For Partnership</h1>
                        <div class="cont_inner" >
                            <ul>
                                <li><span><i class="fa fa-envelope-o" aria-hidden="true"></i></span> <span> Email ID:<span class="bkpoint">partnership[dot]fitindia[at]gmail[dot]com</span></span></li>
                                <li class="btn_cont mt-2"> <a href="become-a-partner">Click here</a><span style="padding-left:10px;"> to submit the details</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </section>

    <div class="row mt-0">
        <iframe style="border: 0;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d56077.617141573246!2d77.22926076849038!3d28.544195815511394!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390ce2f931835ac1%3A0xe53de68507f26b47!2sSPORTS%20AUTHORITY%20OF%20INDIA!5e0!3m2!1sen!2sin!4v1566654916999!5m2!1sen!2sin" width="100%" height="450" frameborder="0" allowfullscreen="allowfullscreen"></iframe>
    </div>            
    
@endsection

