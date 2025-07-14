@extends('layouts.app')
@section('title', 'Fit India Cyclothon 2020| Fit India')
@section('content')

@php
    $active_section = request()->segment(count(request()->segments()));
    $active_section_id = trim($active_section);
@endphp

<div class="container-fluid">
<div class="inner-banner-bg">
<div class="inner-banner-band">
<h1>Help</h1>
</div>
</div>
<section id="{{ $active_section_id }}">
<div class="container help_area">
<div class="col sm-12 col-md-12">


<h2>Accessibility</h2>
<p>Know about the accessibility statement, accessibility features, and accessibility options.
We are committed to ensure that the Ministry Of Youth Affairs & Sports is accessible to all users irrespective of device in use, technology or ability. It has been built, with an aim, to provide maximum accessibility and usability to its visitors</p>
<p>We have put in our best efforts to ensure that all information on this Portal is accessible to people with disabilities. For example, a user with visual disability can access this Portal using assistive technologies, such as screen readers and magnifiers</p>
<p>We also aim to be standards compliant and follow principles of usability and universal design, which should help all visitors of this Portal.</p>
<p>This Portal is designed using XHTML 1.0 Transitional and meets priority 1 (level A) of the Web Content Accessibility Guidelines (WCAG) 2.0 laid down by the World Wide Web Consortium (W3C). Part of the information in the Portal is also made available through links to external Web sites. External Web sites are maintained by the respective departments who are responsible for making these sites accessible.</p>

<h2>Viewing Information in Various File Formats</h2>
<p>Provides information on how to access different file formats for viewing the required information.</p>
<p>The information provided by this Web site is available in various file formats, such as Portable Document Format (PDF), Word, Excel and PowerPoint. To view the information properly, your browser need to have the required plug-ins or software. For example, the Adobe Flash software is required to view the Flash files. In case your system does not have this software, you can download it from the Internet for free. The table lists the required plug-ins needed to view the information in various file formats.</p>
<p>Plug-in for alternate document types</p>
<br>
<table class="responsive table table-bordered screen-reader">
<tbody>
    <tr>
        <th>Document Type</th>
        <th>Plug-in for Download</th>       
    </tr>
    <tr>
        <td>Portable Document Format (PDF) files</td>
        <td>
        
        <img class="imageicon" src="{{ asset('resources/imgs/help/pdf.png') }}" alt="pdf" align="absmiddle">
        <a target="_blank" title="External website that opens in a new window" href="http://www.adobe.com/products/acrobat/readstep2.html" >Adobe Acrobat Reader</a>
        </td>
    </tr>
    <tr>
        <td>Word files</td>
        <td>
            <img class="imageicon" src="{{ asset('resources/imgs/help/doc.png') }}" alt="word" align="absmiddle">
            {{-- <a title="External website that opens in a new window" href="http://www.microsoft.com/Downloads/details.aspx?familyid=3657CE88-7CFA-457A-9AEC-F4F827F20CAC&amp;displaylang=en/" >Word Viewer (in any version till 2003)</a> --}}
            <a target="_blank" title="External website that opens in a new window" href="https://support.microsoft.com/en-au/topic/supported-versions-of-the-office-viewers-a2a766fe-06bb-b0d7-2a55-e200d9ccad6f" >Word Viewer (in any version till 2003)</a>
        </td>
    </tr>
    <tr>
        <td>Excel files</td>
        <td>
        {{-- <img class="imageicon" src="{{ asset('resources/imgs/help/docexceltable.png') }}" alt="excel" align="absmiddle"><a title="External website that opens in a new window" href="http://www.microsoft.com/downloads/details.aspx?FamilyID=c8378bf4-996c-4569-b547-75edbd03aaf0&amp;displaylang=EN/" >Excel Viewer 2003 (in any version till 2003)</a> --}}
        <img class="imageicon" src="{{ asset('resources/imgs/help/docexceltable.png') }}" alt="excel" align="absmiddle">
        <a target="_blank" title="External website that opens in a new window" href="https://support.microsoft.com/en-au/topic/supported-versions-of-the-office-viewers-a2a766fe-06bb-b0d7-2a55-e200d9ccad6f" >Excel Viewer 2003 (in any version till 2003)</a>
        </td>
    </tr>
    <tr>
        <td>PowerPoint presentations</td>
        <td>
        {{-- <img class="imageicon" src="{{ asset('resources/imgs/help/ppt-icon.png') }}" alt="ppt" align="absmiddle"><a title="External website that opens in a new window" href="https://www.microsoft.com/en-us/download/" >PowerPoint Viewer 2003 (in any version till 2003)</a> --}}
        <img class="imageicon" src="{{ asset('resources/imgs/help/ppt-icon.png') }}" alt="ppt" align="absmiddle">
            <a target="_blank" title="External website that opens in a new window" href="https://support.microsoft.com/en-au/topic/supported-versions-of-the-office-viewers-a2a766fe-06bb-b0d7-2a55-e200d9ccad6f" >PowerPoint Viewer 2003 (in any version till 2003)</a>
        </td>
    </tr>

    <tr>
        <td>Flash content</td>
        <td>
            {{-- <img class="imageicon" src="{{ asset('resources/imgs/help/fla-icon.png') }}" alt="flash" align="absmiddle"><a title="External website that opens in a new window" href="http://get.adobe.com/flashplayer/" >Adobe Flash Player</a> --}}
            <img class="imageicon" src="{{ asset('resources/imgs/help/fla-icon.png') }}" alt="flash" align="absmiddle">
                <a target="_blank" title="External website that opens in a new window" href="https://adobe-flash-player.apponic.com/" >Adobe Flash Player</a>
        </td>
    </tr>
</tbody>
</table>

<h3>Screen Reader Access</h3>
<p> Provides information regarding access to different Screen Readers.</p>
{{-- <p>The Ministry Of Youth Affairs &amp; Sports fully complies with <a title="External website that opens in a new window" href="http://web.guidelines.gov.in/" >Guidelines for Indian Government Websites</a>. Our visitors with visual impairments can access the Portal using Assistive Technologies, such as screen readers.</p> --}}
<p>The Ministry Of Youth Affairs &amp; Sports fully complies with <a target="_blank" title="External website that opens in a new window" href="https://guidelines.india.gov.in/" >Guidelines for Indian Government Websites</a>. Our visitors with visual impairments can access the Portal using Assistive Technologies, such as screen readers.</p>
<p>The information of the Portal is accessible with different screen readers, such as JAWS, NVDA, SAFA, Supernova and Window-Eyes.</p>
<p>Following table lists the information about different screen readers:</p>
<p>Information related to the various screen readers</p>
<table class="responsive table table-bordered screen-reader">
    <tbody>
    <tr>
        <th>Screen Reader</th>
        <th>Website</th>
        <th>Free / Commercial</th>  
    </tr>
    <tr>
        <td>Screen Access For All (SAFA)</td>
        <td><a target="_blank" title="External website that opens in a new window" role="link" href="https://safa-reader.software.informer.com/download/" rel="noopener noreferrer">http://www.nabdelhi.org/NAB_SAFA.htm</a></td>
        <td>Free</td>
    </tr>
    <tr>
        <td>Non Visual Desktop Access (NVDA)</td>
        <td><a target="_blank" title="External website that opens in a new window" role="link" href="http://www.nvda-project.org/" rel="noopener noreferrer">http://www.nvda-project.org/</a></td>
        <td>Free</td>
    </tr>
    <tr>
        <td>System Access To Go</td>
        <td><a target="_blank" title="External website that opens in a new window" role="link" href="http://www.satogo.com/" rel="noopener noreferrer">http://www.satogo.com/</a></td>
        <td>Free</td>
    </tr>
    <tr>
        <td>Thunder</td>
        <td><a target="_blank" title="External website that opens in a new window" role="link" href="http://www.screenreader.net/index.php?pageid=2/" rel="noopener noreferrer">http://www.screenreader.net/index.php?pageid=2</a></td>
        <td>Free</td>
    </tr>
    <tr>
        <td>WebAnywhere</td>
        {{-- <td><a title="External website that opens in a new window" role="link" href="http://webanywhere.cs.washington.edu/wa.php/" rel="noopener noreferrer">http://webanywhere.cs.washington.edu/wa.php</a></td> --}}
        <td><a target="_blank" title="External website that opens in a new window" role="link" href="https://webinsight.cs.washington.edu/wa/" rel="noopener noreferrer">https://webinsight.cs.washington.edu/wa/</a></td>
        <td>Free</td>
    </tr>
    <tr>
        <td>Hal</td>
        <td><a target="_blank" title="External website that opens in a new window" role="link" href="https://yourdolphin.com/en-gb/products/individuals/screen-reader/" rel="noopener noreferrer">https://yourdolphin.com/en-gb/products/individuals/screen-reader/</a></td>
        <td>Commercial</td>
    </tr>
    <tr>
        <td>JAWS</td>
        <td><a target="_blank" title="External website that opens in a new window" role="link" href="https://www.freedomscientific.com/products/software/jaws/" rel="noopener noreferrer">https://www.freedomscientific.com/products/software/jaws/</a></td>
        <td>Commercial</td>
    </tr>
    <tr>
        <td>Supernova</td>
        <td><a target="_blank" title="External website that opens in a new window" role="link" href="https://yourdolphin.com/en-gb/products/individuals/screen-reader/"  rel="noopener noreferrer">https://yourdolphin.com/en-gb/products/individuals/screen-reader/</a></td>
        <td>Commercial</td>
    </tr>
    <tr>
        <td>Window-Eyes</td>
        {{-- <td><a title="External website that opens in a new window" role="link" href="http://www.gwmicro.com/Window-Eyes/" rel="noopener noreferrer">http://www.gwmicro.com/Window-Eyes/</a></td> --}}
        <td><a target="_blank" title="External website that opens in a new window" role="link" href="https://window-eyes.informer.com/download/" rel="noopener noreferrer">https://window-eyes.informer.com/download/</a></td>
        <td>Commercial</td>
    </tr>
</tbody>
</table>

</div>
</section>

<script>

$(document).ready(function(){
    $(".s-social").hide();
    $(".share").click(function(){
  $(".s-social").toggle();
});

})

   

</script>

@endsection