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
    <div class="container">
        <div class="row justify-content-center mb-4">
          <img
            src="{{ asset('resources/imgs/fit-india_logo.png') }}"
            class="img-fluid"
            style="width: 100px"
            alt=""
          />
        </div>
        <div class="row justify-content-center ">
          <h4 class="py-4 text-center text-decoration-underline under-text">
            Data Deletion
          </h4>
          <div class="row">
            <h4 class="py-3 text-decoration-underline under-text">
              Data Deletion Right
            </h4>
            <p class="fw-normal p-text fs-4">
              You have the right to access, rectify, object to, or erase the data maintained by us. You may request a change/delete to your personal data by contacting us by reffering the issue, email at inquiries.(Itdivisionhq-sai@gov.in) lf you believe our processing of your personal data protection laws, you have a legal right to initiate a complaint with a supervisory authority. Don't hesitate to contact us if you find any issue.
            </p>
          </div>
          <div class="row">
            <h4 class="py-3 text-decoration-underline under-text">Hyper linking Policy:</h4>
            <h4 class="py-3 text-decoration-underline under-text">
              Instructions for Requesting Data/Account Deletion
            </h4>
            <p class="fw-normal p-text fs-4">
              To request data deletion, users may send an email to inquiries..(Itdivisionhq-sai@gov.in) from the email address that is valid or registered with the app data. The subject line of the email should read 'Note Cloud data deletion request' and the email should include all necessary details
            </p>
          </div>
        </div>
      </div>
    </section>
@endsection

