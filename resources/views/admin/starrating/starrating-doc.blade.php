<style>
.mb-3{
	margin-bottom: 0 !important;
	margin-right: 10px;
}
.btn-sm{
	padding: .375rem .75rem;
}
.rtside{
	float:right;
}
.ques{ background: #c5d6e9;
    padding: 10px;
}
.sub_ques_title{ float:left; margin-right:15px; }
</style>
<!-- <div class="content-wrapper">
	<section class="content-header">
      <div class="container-fluid">
		<div class="row mb-2">
          <div class="col-sm-6">
            <a class="" href="{{ route('admin.starratings.index') }}"> <i class="fas fa-long-arrow-alt-left"></i>Back </a>
           </div>
        </div>
		
        <div class="row mb-2">
          <div class="col-sm-6"> -->
            <h1>School Certification Details</h1>
       <!--    </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
				<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
				<li class="breadcrumb-item"><a href="{{ route('admin.starratings.index') }}">School Certificates</a></li>
				<li class="breadcrumb-item active" aria-current="page">Detail</li>
            </ol>
          </div>
        </div>
      </div>
    </section> -->


 

					<h3 class="card-title"> Request for Fit India {{ $flags->name }} </h3> 

				  
				
	
						
						  
						<table>
								<tr><th>Name</th><td>{{ $users[0]->name }}</td></tr>
								<tr><th>Email</th><td>{{ $users[0]->email }}</td></tr>
								<tr><th>Phone</th><td>{{ $users[0]->phone }}</td></tr>
								<tr><th>State</th><td>{{ $users[0]->state }}</td></tr>
								<tr><th>District</th><td>{{ $users[0]->district }}</td></tr>
								<tr><th>Block</th><td>{{ $users[0]->block }}</td></tr>

						</table>
						  
						  
						  <hr>
						  
						  
						 <?php  
						   // Three Star
						  
						 if($flags->id == 1622){
							 $threedata = $flagdata;
							 unset($flagdata);
							 $qno = 1;;
							 foreach($certques as $certque){  ?>
						  
								<dt class="col-sm-12 ques">{{ $qno }}. {{ $certque->title }} </dt>
								<dd class="col-sm-12 mt-3 ml-3">
								<?php
								$questypeid = $certque->questypeid;
										
										switch ($questypeid) {
											case "5": ?>
											
											<dl class="row mt-3">
											 <p style="displa:inline-block">No. of teachers in school :- 
											  <span>{{ $threedata->totnoteachers }}</span></p>
											  
											 <p style="displa:inline-block">No. of teachers in school spending at least 60 minutes/ day for physical activities :- 
														<span>{{ $threedata->noteachersplaying }}</span></p>
											  
											  
											   
											 <p style="displa:inline-block">School encourages teachers to participate in sports or fitness in school? 
														(attach picture/circular) :- 
													<span>
												@if(substr($threedata->encouragesdoc, -4) == '.pdf')
															<a href="{{ $threedata->encouragesdoc }}" target="_blank" > View </a>
															<br>
														@else
															<a href="{{ $threedata->encouragesdoc }}" target="_blank" ><img src="{{ $threedata->encouragesdoc }}" width="100" height="100" /></a>
															<br>
															
														@endif
													</span>
												</p>
											 
											  
											  
											  <p style="displa:inline-block">School motivates all teachers to do 60 minutes of physical activity every day 
														(eg. Posters, SMS, emails, circulars) (attach relevant doc)
													<span>
												
														 @if(substr($threedata->motivatesdoc, -4) == '.pdf') 
															<a href="{{ $threedata->motivatesdoc }}" target="_blank" > View </a>
															<br>
														@else 
															<a href="{{ $threedata->motivatesdoc }}" target="_blank" ><img src="{{ $threedata->motivatesdoc }}" width="100" height="100" /></a>
															<br>
														 @endif
													</span>
												</p>	 
											  
											  
											</dl>
											
											
												
												
											<?php
												break;
												case "6": ?>
												
												<dl class="row mt-3">
												  <p style="displa:inline-block">No. of teachers :- 
												  <span>{{ $threedata->trainedteacherno }}</span></p>
												</dl>
											
												
												
													

												<div class="sub_ques_row sub_ques-head  playground-section" id="trainedteacherrow" 
												@empty($threedata->trainedteacherno) @php  echo 'style="display:none"'; @endphp @endempty >
												
												
												@empty($threedata->trainedteacherno)
													@else
													<table border="1">
														<tr>
													 <td class="col-sm-1"># </td>
													 <td class="col-sm-5">Teacher/Coach Name </td>
													 <td class="col-sm-3">Sport 1 </td>
													 <td class="col-sm-3">Sport 2 </td>
													
												
													</tr>
													@php $i = 0; @endphp
														
													@if(!empty($threedata->trainedteacherno))
													@while($i < $threedata->trainedteacherno)
													<tr>
													<td class="col-sm-1">{{ ($i+1) }}</td>
													<td class="col-sm-5">{{ unserialize($threedata->trainedteachername)[$i] }} </td>
													<td class="col-sm-3">{{ unserialize($threedata->sportsone)[$i] }}</td>
													<td class="col-sm-3">{{ unserialize($threedata->sporttwo)[$i] }}</td>
													</tr>
													@php $i++; @endphp
													@endwhile
												</table>
													@endif
													
													
													</div>
													<div class="clear"></div>
												
												
												@endempty
												
												
												
												

												</div>
												<br>
											<?php	
												break;
												




												
												
												case "7": ?>
												
												
													
													<dl class="row mt-3">
													  <dt class="col-sm-4">Outdoor Sports ( minimum 2 ) </dt>
													  <dd class="col-sm-8">
														
														
														@php
														$outdoorfacil = unserialize($threedata->outdoorfacility);
														$outarr = 0;
														if(!empty($outdoorfacil)){
															$outarr = sizeof( $outdoorfacil );
														}
															$i = 0;
														@endphp
												
														@while($i < $outarr) 
															<div style="font-weight:400;"> {{ unserialize($threedata->outdoorfacility)[$i] }}
															@if(unserialize($threedata->outdoorfacility)[$i] == 'Any other sport including indigenous games') : {{ $threedata->outdoorextrafacility }}
															@endif
															</div>
															
														@php $i++; @endphp
														@endwhile
												
														</dd>
													</dl>
														
														
													
													
													<dl class="row">
													  <dt class="col-sm-4">Indoor Sports ( minimum 2 ) </dt>
													  <dd class="col-sm-8">
														
														
														@php
															$indoorfac =  unserialize($threedata->indoorfacility);
															$outarr =  0;
															if(!empty($indoorfac)){
																$outarr = sizeof( $indoorfac  );
															}
															$i = 0;
														@endphp
												
														@while($i < $outarr) 
															<div style="font-weight:400;"> {{ unserialize($threedata->indoorfacility)[$i] }}
															@if(unserialize($threedata->indoorfacility)[$i] == 'Any other sport including indigenous games') : {{ $threedata->indoorextrafacility }}
															@endif
															</div>
															
														@php $i++; @endphp
														@endwhile
														</dd>
													</dl>
														

													
												
												<?php	
												break;
												
												
												case "8":
												?>
												<div class="fitIndia-radio-col fitIndia-checkbox-col fit-no-width check-box-position" style="top:0; ">
													<label><input name="traditionalgames" type="checkbox" value="yes" @if(!empty( $threedata->traditionalgames )) {{ 'checked' }} @endif /> 
														<div class="back-end fitindia-r box fit-checkbox" ><span></span></div>
													</label>
												</div>

												<?php	
												break;
												
												
												case "9":
												?>
												<div class="inner-align" style="margin-top: 15px; width:97%;">
													@if(substr($threedata->schoolcertificate, -4) == '.pdf')
														<a href="{{ $threedata->schoolcertificate }}" target="_blank" > View </a>
														<br>
													@else
														<a href="{{ $threedata->schoolcertificate }}" target="_blank" ><img src="{{ $threedata->schoolcertificate }}" width="100" height="100" /></a>
														<br>
													@endif 
																								
												</div>
												
											<?php
												break;
												
											default:
												break;
										}
										?>
						  </dd>
							
						  <?php $qno++;
									}
						 }
						 ?>
						 
						 
						 
						 
						 
						 
						 <?php
						 
						 // Five Star
						  
						 if($flags->id == 1623){
							 $fivedata = $flagdata;
							 unset($flagdata);
							 $qno = 1;
							 foreach($certques as $certque){  ?>
						  
								<dt class="col-sm-12 ques">{{ $qno }}. {{ $certque->title }} </dt>
								<dd class="col-sm-12 mt-3 ml-3">
								<?php
								$questypeid = $certque->questypeid;
								
						 		switch ($questypeid){
												case "9":
												?>
												
												<p class="row">
											  <dt class="col-sm-10">
											  <input type="checkbox" name="intraschoolcomp[]" value="Conducts quarterly Intra-school Competitions" @if(!empty($fivedata->intraschoolcomp))
																	{{ (collect(unserialize($fivedata->intraschoolcomp))->contains("Conducts quarterly Intra-school Competitions")) ? 'checked':'' }}
																	@endif  />
												 Conducts quarterly Intra-school Competitions (need not be all classes) (attach document)

											  </dt>
											  <span style="float: right;">
												@if(substr($fivedata->quarterintraschooldoc, -4) == '.pdf')
													<a href="{{ $fivedata->quarterintraschooldoc }}" target="_blank" > View </a>
													<br>
												@else
													<a href="{{ $fivedata->quarterintraschooldoc }}" target="_blank" ><img src="{{ $fivedata->quarterintraschooldoc }}" width="100" height="100" /></a>
													<br>
												@endif
											  </span>
											</p>
											
											<br><br><br><br><br>
											<p class="row">
											  <dt class="col-sm-10">
											  <input type="checkbox" name="intraschoolcomp[]" value="Participates in Inter-school Competition" 
														@if(!empty( $fivedata->intraschoolcomp ))
																	{{ (collect( unserialize($fivedata->intraschoolcomp) )->contains("Participates in Inter-school Competition")) ? 'checked':'' }}
																	@endif
														/>  Participates in Inter-school Competition (attach document)

											  </dt>
											  <span class="col-sm-2" style="float: right;">
												@if(substr($fivedata->participateintraschooldoc, -4) == '.pdf')
													<a href="{{ $fivedata->participateintraschooldoc }}" target="_blank" > View </a>
													<br>
												@else
													<a href="{{ $fivedata->participateintraschooldoc }}" target="_blank" ><img src="{{ $fivedata->participateintraschooldoc }}" width="100" height="100" /></a>
													<br>
												@endif
											  </span>
											</p>
											<br><br><br><br><br>
												
												<p class="row">
												  <dt class="col-sm-10"><input type="checkbox" name="intraschoolcomp[]" value="Celebrate Annual Sports Day" 
														@if(!empty($fivedata->intraschoolcomp))
																	{{ (collect(unserialize($fivedata->intraschoolcomp))->contains("Celebrate Annual Sports Day")) ? 'checked':'' }}
																	@endif
														/>  Celebrate Annual Sports Day (attach document) </dt>
												  <span style="float: right;" class="col-sm-2">@if(substr($fivedata->celebrateannualsportdoc, -4) == '.pdf')
													<a href="{{ $fivedata->celebrateannualsportdoc }}" target="_blank" > View </a>
													<br>
												@else
													<a href="{{ $fivedata->celebrateannualsportdoc }}" target="_blank" ><img src="{{ $fivedata->celebrateannualsportdoc }}" width="100" height="100" /></a>
													<br>
												@endif</span>
												</p>
												
												<dl class="row">
												  <dt class="col-sm-10">Achievements, if any in Inter-school, District, State or National Level  </dt> <br><br><br><br>
												  <dd class="col-sm-2">{{ $fivedata->achievements }}</dd>
												</dl>
											
												
										
												<?php
												break;
												case "10":
												?>
													

												<dl class="row">
											  <dt class="col-sm-10"><input name="alltrainedpe" type="checkbox" value="yes" @if(!empty( $fivedata->alltrainedpe )) {{ 'checked' }}  @endif />
											  All teachers have attended some certified online/offline course on PE for at least one week
												<br>
												(Principal/ Management should certify this on school’s letterhead- attach document)


											  </dt>
											  <dd class="col-sm-2" style="float: right;">	
											  @if(substr($fivedata->pecertifieddoc, -4) == '.pdf')
													<a href="{{ $fivedata->pecertifieddoc }}" target="_blank" > View </a>
													<br>
												@else
													<a href="{{ $fivedata->pecertifieddoc }}" target="_blank" ><img src="{{ $fivedata->pecertifieddoc }}" width="100" height="100" /></a>
													<br>
												@endif
												</dd><br><br>
											</dl>
											
											<br><br>
											<?php
												break;
												
												
												
												
												
												case "11": ?>
												
												<dl class="row">
												  <p>No. of Sports Coaches <span>
												  {{ $fivedata->sportscoachno }}</span></p>
												</dl>
											
											
												
												<table border="1">
													<tr>
													  <th class="col-sm-1"> #	</th>
													  <th class="col-sm-3"> Coach Name	</th>
													  <th class="col-sm-3"> Sports	</th>
													</tr>										
													

												
												@if(!empty( $fivedata->sportscoachno ))
													
												
													
													@php $i = 0; @endphp
													@while($i < $fivedata->sportscoachno )
													
													<tr>
														<td> {{ ($i+1) }}	</td>
														<td> {{ unserialize($fivedata->sportscoachname)[$i] }}	</td>
														<td> {{ unserialize($fivedata->coachsports)[$i] }}	</td>
													</tr>
													@php $i++; @endphp	
													@endwhile
														</table>
												
												<br>
												
												
												@endif

												
											<?php	
												break;
											
											case "12": ?>
												
										
											  <p><strong> Board</strong> <span>
											  {{ $fivedata->peboard }}</span></p>
											  <p class="col-sm-2">@if(substr($fivedata->curriculumboarddoc, -4) == '.pdf')
													<a href="{{ $fivedata->curriculumboarddoc }}" target="_blank" > View </a>
													<br>
												@else
													<a href="{{ $fivedata->curriculumboarddoc }}" target="_blank" ><img src="{{ $fivedata->curriculumboarddoc }}" width="100" height="100" /></a>
													<br>
												@endif
												</p>
										
											
											
											
											
											
												
										<?php
											break;
											
											
											
											case "13": ?>
												
												 
												<p style="font-weight: 400;margin: 15px;"> Note: Minimum 80% of Students fitness assessment must be done </p>
												<table border="1">	
												<tr>
													<th class="col-sm-4">ID(School Affiliation Code)on schoolfitness.kheloindia.gov.in </th>
													<th class="col-sm-4">No of students </th>
													<th class="col-sm-4">No of students fitness assessment done </th>
												</tr>
												<tr>
													<td>{{ $fivedata->schoolfitnessid }} </td>	
													<td class="col-sm-4">{{ $fivedata->noofstudents }} </td>
													<td class="col-sm-4">{{ $fivedata->noofassessments }} </td>
												</tr>
											</table>
												
												
											<?php	
												break;
											
											
											case "14": ?>
												<table border="1">
													<tr>
															<th class="col-sm-4">Facilities </th>
															<th class="col-sm-4">Open to </th>
													</tr>
												
													
													
													<?php
														$i=0;
														while($i < 4){ ?>
														<tr>
															<td class="col-sm-4">{{ unserialize($fivedata->facilities)[$i] }}  </td>
															<td class="col-sm-4">{{ unserialize($fivedata->opento)[$i] }}  </td>
																 
														</tr>
														<?php $i++; } ?>
													</table>	
													
											<?php	
												break;
												
												

											
											default:
												break;
										}
										?>
						  </dd>
							
						  <?php $qno++;
									}
						 }
										
						?>
						 
						 </dl> 
						
						
						</div>
					</div>
				</div>
				  
				  
			</div> 







        </div>
      </div>
	  </div>

    </section>
    <!-- /.content -->
  </div>


