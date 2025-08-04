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
         <div class="col-12">
          <h4 class="py-4 text-center text-decoration-underline under-text">
            Website Policy for Fit India Website
         </div>
          </h4>
          <div class="col-12">
            <h4 class="py-3 text-decoration-underline under-text">
              Intellectual Property and Copyright Policy:
            </h4>
            <p class="fw-normal p-text fs-4">
              Material featured on this Website may be reproduced free of charge.
              However, the material has to be reproduced accurately and not to be
              used in a derogatory manner or in a misleading context. Wherever the
              material is being published or issued to others, the source must be
              prominently acknowledged. However, the permission to reproduce this
              material shall not extend to any material which is identified as
              being copyright or Intellectual property of a third party.
              Authorization to reproduce such material must be obtained from the
              departments/copyright holders concerned. Usage of Fit India Logo is
              not permissible without consent and permission of Fit India Mission,
              Sports Authority of India
            </p>
          </div>
          <div class="col-12">
            <h4 class="py-3 text-decoration-underline under-text">Hyper linking Policy:</h4>
            <h4 class="py-3 text-decoration-underline under-text">
              Links to external websites/portals:
            </h4>
            <p class="fw-normal p-text fs-4">
              At many places in this website, user shall find links to other
              Websites/Portal/Web Application/Mobile apps. These links have been
              placed for user’s convenience. Sports Authority of India / Fit India
              is not responsible for the contents of the linked destinations and
              does not necessarily endorse the views expressed in them. Mere
              presence of the link or its listing on this Website should not be
              assumed as endorsement of any kind. Fit India Mission cannot
              guarantee that these links will work all the time and Fit India
              Mission has no control over availability of linked destinations.
            </p>
          </div>
          <div class="col-12">
            <h4 class="py-3 text-decoration-underline under-text">
              Links to our Website by other websites/Portals:
            </h4>
  
            <p class="fw-normal p-text fs-4">
              Fit India Mission does not object to user linking directly to the
              information that is hosted on this Website and no prior permission
              is required for the same. However, Fit India Mission would like user
              to inform about any links provided to this website so that user can
              be informed of any changes or updates therein. Also, Fit India
              Mission does not permit its pages to be loaded into frames on user’s
              site. The pages belonging to this website must load into a newly
              opened browser window of the User.
            </p>
          </div>
          <div class="col-12">
            <h4 class="py-3 text-decoration-underline under-text">Privacy Policy:</h4>
  
            <p class="fw-normal p-text fs-4">
              As a general rule, this website does not collect Personal
              Information about user when they visit the site. User can generally
              visit the site without revealing Personal Information, unless they
              choose to provide such information. The information received depends
              upon what user do when visiting the site.
            </p>
          </div>
          <div class="col-12">
            <h4 class="py-3 text-decoration-underline under-text">Google Fit Data:</h4>
  
            <p class="fw-normal p-text fs-4">
              Our app uses Google Fit to track and analyze your physical activity data. We collect the following types of data from Google Fit:
              <ul>
                <li><b>Step Count:</b> The number of steps you take each day.</li>
                <li><b>Distance:</b> The total distance you travel each day.</li>
                <li><b>Active minutes:</b> The amount of time you spend being physically active.</li>                
              </ul>
            </p>
            <p class="mt-4 fw-normal p-text fs-4">
              We use this data to provide you with personalized insights and recommendations related to your fitness goals. We do not share your Google Fit data with any third parties, except as required by law or with your explicit consent.
              You can revoke our app's access to your Google Fit data at any time.
            </p>
          </div>
          <div class="col-12">
            <h4 class="py-3 text-decoration-underline under-text">Site visit data:</h4>
  
            <p class="fw-normal p-text fs-4">
              Sports Authority of India / Fit India does not automatically capture
              any specific personal information from the user (like name, phone
              number or e-mail address), that allows Fit India Mission to identify
              the user individually. If the user chooses to provide Fit India
              Mission with their personal information, like names or email,
              addresses, when they visit our website, Fit India Mission uses it
              only to fulfil user’s request for registration, Fit India Mission
              does not sell or share any personally identifiable information
              volunteered on this site to any third party (public/private). Any
              information provided to this website will be protected from loss,
              misuse, unauthorized access or disclosure, alteration, or
              destruction.
            </p>
            <p class="mt-4 fw-normal p-text fs-4">
              Fit India Mission gathers certain information about the User, such
              as Internet protocol (IP) address, domain name, browser type,
              operating system, the date and time of the visit and the pages
              visited. Fit India Mission makes no attempt to link these addresses
              with the identity of individuals visiting our site unless an attempt
              to damage the site has been detected.
            </p>
          </div>
        </div>
      </div>
    </section>

              
    
@endsection

