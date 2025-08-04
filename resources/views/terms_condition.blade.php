@extends('layouts.app')
@section('title', 'Contact Us | Fit India')
@section('pageid','contact')
@section('content')
<style>
    .p-text {
      text-align: justify;
    }
    .under-text{
        text-decoration: underline
    }
  </style>
@php
    $active_section = request()->segment(count(request()->segments()));
    $active_section_id = trim($active_section);
@endphp

<section id="{{ $active_section_id }}">
    <div class="container ">
        <div class="row justify-content-center mb-4">
          <img
            src="{{ asset('resources/imgs/fit-india_logo.png') }}"
            class="img-fluid"
            style="width: 100px"
            alt=""
          />
        </div>
        <div class="row  justify-content-center ">
          <h4 class="py-4 text-center text-decoration-underline under-text">
            Terms & Conditions:
          </h4>
          <div class="row">
            <p class="fw-normal p-text fs-4">
              This website is designed, developed and maintained by Sports
              Authority of India / Fit India.
            </p>
            <p class="fw-normal p-text fs-4">
              Though all efforts have been made to ensure the accuracy and
              currency of the content on this website, the same should not be
              construed as a statement of law or used for any legal purposes. In
              case of any ambiguity or doubts, users are advised to verify/check
              with the Department(s) and/or other source(s), and to obtain
              appropriate professional advice.
            </p>
            <p class="fw-normal p-text fs-4">
              Under no circumstances will this Sports Authority of India / Fit
              India be liable for any expense, loss or damage including, without
              limitation, indirect or consequential loss or damage, or any
              expense, loss or damage whatsoever arising from use, or loss of use,
              of data, arising out of or in connection with the use of this
              website.
            </p>
            <p class="fw-normal p-text fs-4">
              The information posted on this website could include hypertext links
              or pointers to information created and maintained by non-Government
              / private organization. Sports Authority of India / Fit India is
              providing these links and pointers solely for user’s information and
              convenience.
            </p>
            <p class="fw-normal p-text fs-4">
              Sports Authority of India / Fit India does not guarantee
              availability of linked pages at all times
            </p>
            <p class="fw-normal p-text fs-4">
              Sports Authority of India / Fit India cannot authorize use of
              copyrighted materials contained in linked website. Users are advised
              to request such authorization from owners of linked websites.
            </p>
          </div>
        </div>
      </div>
    </section>

              
    
@endsection

