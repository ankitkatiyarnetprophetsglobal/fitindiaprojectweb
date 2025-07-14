@extends('layouts.app')
@section('title', 'School Certificate Request | Fit India')
@section('content')
<!--<link rel="stylesheet" id="dashicons-css" href="https://fontawesome.com/v4.7.0/icons/" type="text/css" media="all"> -->
<div class="banner_area">
   <img src="{{ asset('resources/imgs/fitindia-bg-white.jpg') }}" alt="about-fitindia" class="img-fluid expand_img" />
   @include('event.userheader')	
    <div class="container">
        <div class="et_pb_row">
            <div class="row">
			   @include('event.sidebar')					
				<div class="col-sm-12 col-md-9 ">
                <div class="description_box wrap event-form accordion">
                    <h2>Fit India School Certification</h2>
                    
					
					@if($errors->any())
						<div class="alert alert-danger">
						{{ 'There is some validation error, please check each field and fill correct value' }}
							
					@php
						/*	<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>	
						*/
					@endphp		
							
						</div>
					@endif	
					
					@if (session('success'))
						<div class="alert alert-success">
							{{ session('success') }}
						</div>
					@endif
					
					@if (session('error'))
						<div class="alert alert-danger">
							{{ session('error') }}
						</div>
					@endif
					
					
					
					@if(strtolower($role) == 'school')
					
					@php
						$ii = 0;
						
						$statusarr = array( 'applied'=>'Applied', 'screeningcompleted' => 'Screen Committee Review Complete', 'infosought'=>'Further Info Sought', 'visitscheduled'=>'School Visit scheduled', 'awarded'=>'Awarded', 'rejected'=>'Rejected' );
		
						$sports = array( 'Archery', 'Athletics', 'Badminton', 'Basketball', 'Boxing', 'Canoeing', 'Cricket', 'Cycling', 'Fencing', 'Football', 'Gymnastics', 'Handball', 'Hockey', 'Judo', 'Kabaddi', 'Karate', 'Kayaking', 'Kho Kho', 'Lawn Tennis', 'Rowing', 'Sepaktakraw', 'Shooting', 'Softball', 'Swimming', 'Table Tennis', 'Taekwondo', 'Volleyball', 'Weightlifting', 'Wrestling', 'Wushu' );
								
						$indoorsports = array('Badminton', 'Basketball', 'Boxing', 'Fencing', 'Gymnastics', 'Judo', 'Kabaddi', 'Karate', 'Lawn Tennis', 'Shooting', 'Swimming', 'Table Tennis', 'Taekwondo', 'Volleyball', 'Carom', 'Chess', 'Weightlifting', 'Wrestling',);
						 
						$outdoorsports = array( 'Archery', 'Athletics', 'Badminton', 'Basketball', 'Canoeing', 'Cricket', 'Cycling', 'Football', 'Handball','Hockey', 'Judo', 'Kabaddi', 'Karate', 'Kayaking', 'Kho Kho', 'Lawn Tennis',  'Rowing', 'Sepaktakraw', 'Softball', 'Swimming', 'Taekwondo', 'Volleyball', 'Wushu');
								
					@endphp
			
<!-- Flag Request Start -->			
                    <div id="tab-1621" class="star-rating-content @if(!empty($flagstatusdata->status) && strtolower($flagstatusdata->status) == 'awarded' ){{'success'}}@endif @if($currentflag == 1621){{'current'}}@endif">
						<form name="flagrequest" method="post" action="{{ route('flagstore') }}" enctype="multipart/form-data">
						@csrf
						
						<div class="rating-heading">
							<h3>Request for Fit India School Flag </h3> <span class="default-i @if(!empty($flagstatusdata->status)) {{ strtolower($flagstatusdata->status) }} @endif">@if(!empty($flagstatusdata->cur_status)) @if($flagstatusdata->cur_status == 'awarded') <i class="fa fa-star-half-o" aria-hidden="true"> </i> @endif {{ ucwords($flagstatusdata->cur_status) }} @else <i class="fa fa-ban" aria-hidden="true"> </i>  {{ 'Not Applied' }} @endif</span>
						</div>
						
					
						<div class="inner" >
				
						<div class="um-field">
								<h2 for="event_name"> </h2>
								<input type="hidden" name="questions" value="4" />
								<input type="hidden" name="ratingreqid" value="1621" />
								<input type="hidden" name="user_id" value="{{ Auth::id() }}" />
						</div>

                        @foreach($flags as $que)
						
                            @php
								$postid = $que->id;
								$questypeid = $que->questypeid;
								
                            @endphp

								<div class="um-field">
									<div class="um-field-label ques check_div">
										<span class="star-ques-sr">{{++$ii}}.</span>
										<div class="check_flex">
										<label for="ques_name" class="star-questions star-questions-cust">{{$que->title}}</label>
										
									<?php 
									if(!empty($flagdata->id)){
										
										
										switch ($questypeid) {
											case "1": ?>
												<div class="sub_ques_row sub_ques-head sub_flex n-teacher">
													<div class="sub_ques_title"> No. of teachers trained in PE </div>
													<div class="sub_ques_elem"> 
														
														{{ $flagdata->peteacherno }}
													</div>
													<!-- <div class="clear"></div> -->
												</div>
												
												
												<div class="sub_ques_row pe-ques-detail sub_flex" id="peteachernamerow" >
												
												
													@if(!empty($flagdata->peteacherno))
													
													
														<div class="sub_ques_title"> Name of teachers </div>
														<div class="sub_ques_elem">
														<?php $i = 1; ?>
														
														<?php
														
														//print_r($flagdata->peteachernames);die;
														
														
															try{
																$peteachernames = unserialize($flagdata->peteachernames);
																if(!empty($peteachernames)){
																	echo "<ul>";
																	foreach($peteachernames as  $peteachernames){
																		echo "<li>".$peteachernames."</li>";
																	}
																	echo "</ul>";
																}
															}catch(Exception $e){ ?>
																<script>
																	window.location.href = '/cert-notification';
																</script>
															<?php	exit();
															}
														?>
														
														
															<!-- <div class="clear"></div> -->
														</div>
														<!-- <div class="clear"></div> -->
														
													@endif
												
												
												</div>
												
											<?php
												break;
											case "2": ?>
												<div class="sub_ques_row sub_ques-head playground-section play-col sub_flex">
													<div class="sub_ques_title"> No. of Playgrounds </div>
													<div class="sub_ques_elem"> 
													@if(!empty($flagdata->playgroundno)) 
														{{ $flagdata->playgroundno }}
													@endif
														
													</div>
													<!-- <div class="clear"></div> -->
												</div>
												
											<div class="sub_ques_row sub_ques-head sub_flex1" id="playgroundrow" >
												
												
												@if(!empty($flagdata->playgroundno))													
													
												<div class="sub_ques_title sub_flex_first"> Playgrounds </div>
												
												<div class="resTable">
													<table>
												
													<thead>
														<tr>
														<th scope="col" class="tb_cust_width">Choose Shape</th>
														<th scope="col">Area (sqft)</th>
														<th scope="col">Longest Side (ft)</th>
														<th scope="col" class="tb_cust_width">Distance from School(Km)</th>
														<th scope="col">Ground Image</th>
														</tr>
													</thead>
													
													<?php
															try{
																unserialize($flagdata->playgroundshape);
																unserialize($flagdata->playgroundarea);
																unserialize($flagdata->playgroundlside);
																unserialize($flagdata->schooldistance);
																unserialize($flagdata->playgroundimg);
																
															}catch(Exception $e){ ?>
																<script>
																	window.location.href = '/cert-notification';
																</script>
															<?php	exit();
															}
														?>
														
														<tbody>
														@php $i = 0; @endphp
														
														
													@if(!empty($flagdata->playgroundno))
													@while($i < $flagdata->playgroundno)
														
															<tr>
																<td data-label="Choose Shape">
																<div class="playgroundshape">
																	<div class="fitIndia-radio-col">
																		<label>
																			<input type="radio" name="playgroundshape[<?php echo $i;?>]" value="square"
																			@if(!empty(unserialize($flagdata->playgroundshape)[$i]))
																			{{ (collect(unserialize($flagdata->playgroundshape)[$i])->contains('square')) ? 'checked':'' }}
																			@endif
																			/>
																			<div class="back-end fitindia-r box fit-radio1"><span></span></div>
																		</label>
																		<label>
																			<input type="radio" name="playgroundshape[<?php echo $i;?>]" value="circle" 
																			@if(!empty(unserialize($flagdata->playgroundshape)[$i]))
																			{{ (collect(unserialize($flagdata->playgroundshape)[$i])->contains('circle')) ? 'checked':'' }}
																			@endif
																			
																			/>
																			<div class="back-end fitindia-r box fit-radio2"><span></span></div>
																		</label>  
																		<label>
																			<input type="radio" name="playgroundshape[<?php echo $i;?>]" value="Quadrilateral" 
																			@if(!empty(unserialize($flagdata->playgroundshape)[$i]))
																			{{ (collect(unserialize($flagdata->playgroundshape)[$i])->contains('Quadrilateral')) ? 'checked':'' }}
																			@endif
																			
																			/>
																			<div class="back-end fitindia-r box fit-radio3"><span></span></div>
																		</label> 
																	</div>
																</div>
																</td>
																<td data-label="Area (sqft)">
																	<div class="playgroundarea">
																		{{ unserialize($flagdata->playgroundarea)[$i] }} 
																	</div>
																</td>
																<td data-label="Longest Side (ft)">
																	<div class="playgroundlside">
																		{{ unserialize($flagdata->playgroundlside)[$i] }}
																	</div>
																</td>
																<td data-label="Distance from School(Km)">
																	<div class="schooldistance">
																		{{ unserialize($flagdata->schooldistance)[$i] }}
																	</div>
																</td>
																<td data-label="Ground Image">
																	@if(!empty( unserialize($flagdata->playgroundimg)[$i]) )
															
																		@if(substr(unserialize($flagdata->playgroundimg)[$i], -4) == '.pdf')
																			<a href="{{ unserialize($flagdata->playgroundimg)[$i] }}" target="_blank" > View </a>
																			<br>																
																		@else
																		<div class="img_table_grid">
																			<a href="{{ unserialize($flagdata->playgroundimg)[$i] }}" target="_blank" ><img src="{{ unserialize($flagdata->playgroundimg)[$i] }}" class="img-thumbnail img_fit_obj"/></a>
																		</div>
																			<br>
																		@endif
																		
																	@endif
																</td>
															</tr>
														@php $i++; @endphp
													@endwhile
													@endif	
															
														</tbody>
														</table>
												</div>
												
												<div class="clear"></div>
														
												
												<!-- <div class="clear"></div> -->
												
												
												@endif
												

											</div>
											
											<div class="sub_ques_row sub_ques-head  playground-section sub_ques-head-padding  playground-section sub_flex " id="outdoorsportsrow" >
												<div class="sub_ques_title">Outdoor Sports Played
												<div> (minimum 2) </div>
												</div>
												<div class="sub_ques_elem">
												@php
												$outarr = 0;
												if(!empty($flagdata->outdoorsports)){
													$outarr = sizeof( unserialize($flagdata->outdoorsports) );
												}
													$i = 0;
												@endphp
												
												@while($i < $outarr) 
													<div class="">
														<label>
														
														
														<?php if( unserialize($flagdata->outdoorsports)[$i] == "Any other sport including indigenous games"){
															echo unserialize($flagdata->outdoorsports)[$i]. " : ".$flagdata->othersportsplayed;
														}else{
															echo unserialize($flagdata->outdoorsports)[$i];
														}															?>
														</label>
														<span class="checkbox-span"></span>
													</div>
													@php $i++; @endphp
												@endwhile
													
													
												</div>	
												<div class="clear"></div>
											</div>
												
												


											<?php
												break;
												
											case "3":
											
												?>
												<div class="fitIndia-radio-col fitIndia-checkbox-col fit-no-width check-box-position check_div_inner">
													<label><input name="studentspending60min" type="checkbox" value="yes" 
													@if(!empty( $flagdata->studentspending60min )) {{ 'checked' }} @endif /> 
														<div class="back-end fitindia-r box fit-checkbox"><span></span></div>
													</label>
												</div>
												
												
											<?php
												break;
												
												
											case "4":
											
												?>
												<div class="sub_ques_row  sub_ques-head">
													<div class="sub_ques_title pt-2 pb-2"> Daily Physical Activities by Students </div>
													<div class="sub_ques_elem"> 
														<div class="phy-activity">
															<span>With the Assembly</span> 
															@if(!empty( $flagdata->assemblyactivityno ))
																{{ $flagdata->assemblyactivityno }}
															@endif
														</div>
														<div class="phy-activity">
															<span>Physical Education (PE) Periods</span> 
															@if(!empty( $flagdata->physeduperiodno ))
																{{ $flagdata->physeduperiodno }}
															@endif
															
														</div>
														<div class="phy-activity">
															<span>Before School hours/ after school hours:</span> 
															@if(!empty( $flagdata->schoolclosreno ))
																{{ $flagdata->schoolclosreno }}
															@endif
															
															
														</div>
														<div class="phy-activity">
															<span>Other/free play:</span> 
															@if(!empty( $flagdata->otheractivityno ))
																{{ $flagdata->otheractivityno }}
															@endif
															
														</div> 
														 
													</div>
												</div>
											<?php
												break;
												
											default:
												break;
										}	
										

									
									}else{
										
										switch ($questypeid) {
											case "1": ?>
												<div class="sub_ques_row sub_ques-head n-teacher">
													<div class="sub_ques_title"> No. of teachers trained in PE </div>
													<div class="sub_ques_elem"> 
														<input type="number" name="peteacherno" onkeyUp="peteacher(this.value,this)" onclick="peteacher(this.value,this)" class="fit-pe-inputs"  min="0" value="{{ old('peteacherno') }}"  />
														@error('peteacherno') <div class="alert alert-danger">{{ $message }}</div> @enderror
													</div>													
												</div>
												
												
												<div class="sub_ques_row pe-ques-detail " id="peteachernamerow" @empty(old('peteacherno')) @php  echo 'style="display:none"'; @endphp @endempty >
												
												
													@empty(old('peteacherno'))
													@else
													
														<div class="sub_ques_title"> Name of teachers </div>
														<div class="sub_ques_elem">
														@php $i = 0; @endphp
														
														@if(!empty(old('peteachernames')))
														@foreach(old('peteachernames') as $peteachernames)
															<div class="peteachernames-col">
																<span>{{$i+1}} </span>
																<input type="text" name="peteachernames[]" class="peteachernames" 
																value="<?php echo $peteachernames;?>" />
																														
																@error("peteachernames.$i") <div class="alert alert-danger">{{ $message }}</div>
																@enderror
															</div>
															
															@php $i++; @endphp
														@endforeach
														@endif
															<div class="clear"></div>
														</div>
														<div class="clear"></div>
														
													@endempty
												
												
												</div>
												
											<?php
												break;
											case "2": ?>
												<div class="sub_ques_row sub_ques-head playground-section play-col">
													<div class="sub_ques_title"> No. of Playgrounds </div>
													<div class="sub_ques_elem"> 
														<input type="number" name="playgroundno" onkeyUp="playground(this.value,this)" onclick="playground(this.value,this)"  class="fit-pe-inputs"  min="0" value="{{ old('playgroundno') }}" />
														@error('playgroundno') <div class="alert alert-danger">{{ $message }}</div> @enderror
													</div>
													<div class="clear"></div>
												</div>
												
											<div class="sub_ques_row sub_ques-head" id="playgroundrow"  @empty(old('playgroundno')) @php  echo 'style="display:none"'; @endphp @endempty >
												
												
												@empty(old('playgroundno'))
													@else
													
												<div class="sub_ques_title"> Playgrounds </div>
												
												
												
												<div class="resTable">
												
												
													
													@error("playgroundshape") <div class="alert alert-danger">{{ $message }}</div>@enderror
													@error("playgroundimg") <div class="alert alert-danger">{{ $message }}</div>@enderror
														
													<table>
												
													<thead>
														<tr>
														<th scope="col" class="tb_cust_width">Choose Shape</th>
														<th scope="col">Area (sqft)</th>
														<th scope="col">Longest Side (ft)</th>
														<th scope="col" class="tb_cust_width">Distance from School(Km)</th>
														<th scope="col">Ground Image</th>
														</tr>
													</thead>
													<tbody>
													
													
													@php $i = 0;
													

													@endphp
														
														
														
													@if(!empty(old('playgroundno')))
													@while($i < old('playgroundno'))
														
													<tr>
														<td data-label="Choose Shape">
															<div class="playgroundshape">
																<div class="fitIndia-radio-col">
																	<label>
																		<input type="radio" name="playgroundshape[<?php echo $i;?>]" value="square"
																		@if(!empty(old('playgroundshape')[$i]))
																		{{ (collect(old('playgroundshape')[$i])->contains('square')) ? 'checked':'' }}
																		@endif
																		/>
																		<div class="back-end fitindia-r box fit-radio1"><span></span></div>
																	</label>
																	<label>
																		<input type="radio" name="playgroundshape[<?php echo $i;?>]" value="circle" 
																		@if(!empty(old('playgroundshape')[$i]))
																		{{ (collect(old('playgroundshape')[$i])->contains('circle')) ? 'checked':'' }}
																		@endif
																		
																		/>
																		<div class="back-end fitindia-r box fit-radio2"><span></span></div>
																	</label>  
																	<label>
																		<input type="radio" name="playgroundshape[<?php echo $i;?>]" value="Quadrilateral" 
																		@if(!empty(old('playgroundshape')[$i]))
																		{{ (collect(old('playgroundshape')[$i])->contains('Quadrilateral')) ? 'checked':'' }}
																		@endif
																		
																		/>
																		<div class="back-end fitindia-r box fit-radio3"><span></span></div>
																	</label> 
																</div>
															</div>
														</td>
														
														<td data-label="Area (sqft)">
															<div class="playgroundarea">
																<input type="text" name="playgroundarea[]" class="playgroundarea" value="{{ old('playgroundarea')[$i] }}" />
															</div>
														</td>
														
														<td data-label="Longest Side (ft)">
															<div class="playgroundlside">
																<input type="text" name="playgroundlside[]" class="playgroundlside" value="{{ old('playgroundlside')[$i] }}" />
															</div>
														</td>
														
														<td data-label="Distance from School(Km)">
															<div class="schooldistance">
																<select name="schooldistance[]" class="schooldistance">
																<option value="">Please Select</option>
																<option @if (old('schooldistance')[$i] == 'Within School'){{ 'selected' }} @endif >Within School</option>
																<option  @if (old('schooldistance')[$i] == 'Within 500 mts'){{ 'selected' }} @endif >Within 500 mts</option>
																<option  @if (old('schooldistance')[$i] == 'Beyond 500 mts'){{ 'selected' }} @endif >Beyond 500 mts</option>
																</select>
															</div>
														</td>
														<td data-label="Ground Image">
															 <input name='playgroundimg[<?php echo $i;?>]' type='file'/><br/>
														</td>
													</tr>
													<tr>
													<td colspan="4">													
														@error("playgroundshape.$i") <div class="alert alert-danger">{{ $message }}</div>@enderror
														@error("playgroundarea.$i") <div class="alert alert-danger">{{ $message }}</div>@enderror
														@error("playgroundlside.$i") <div class="alert alert-danger">{{ $message }}</div>@enderror
														@error("schooldistance.$i") <div class="alert alert-danger">{{ $message }}</div>@enderror
														@error("playgroundimg.$i") <div class="alert alert-danger">{{ $message }}</div>@enderror
													</td>
													</tr>
																  
													@php $i++; @endphp
													@endwhile
													@endif
													</tbody>
													</table>
													
												</div>
												
												
												
												
												
												<div class="clear"></div>
												
												
												@endempty
												

											</div>
											
											<div class="sub_ques_row sub_ques-head  playground-section sub_ques-head-padding  playground-section  " id="outdoorsportsrow" @empty(old('playgroundno')) @php  echo 'style="display:none"'; @endphp @endempty >
												<div class="sub_ques_title ">Outdoor Sports Played
												<div> (minimum 2) </div>
												</div>
												<div class="sub_ques_elem sub_ques_width">												
												
												@foreach($sports as $sport) 
												@if($sport == 'Table Tennis') @php continue; @endphp @endif
												
													<div class="fitIndia-radio-col fitIndia-checkbox-col">
														<label>
														<input type="checkbox" name="outdoorsports[]" value="<?php echo $sport;?>" 
														
														@if(!empty(old('outdoorsports')) && in_array( $sport, old('outdoorsports') ) ) {{ 'checked' }} @endif />
														<div class="back-end fitindia-r box fit-checkbox"><span></span></div></label>
														<span class="checkbox-span"><?php echo ucwords($sport);?></span>
													</div>
												@endforeach
												<br>
													<div class="fitIndia-radio-col fitIndia-checkbox-col allwidth">
														<label><input type="checkbox" name="outdoorsports[]" 
														value="Any other sport including indigenous games" 
														@if( !empty(old('outdoorsports')) && in_array( "Any other sport including indigenous games", old('outdoorsports') ) ) {{ 'checked' }} @endif
														 onclick="othersports('othersportsdiv','othersportselem')" id="othersportselem"
														/> <div class="back-end fitindia-r box fit-checkbox"><span></span></div></label>
														<span class="checkbox-span">Any other sport including indigenous games</span>
													</div>
													
													<div id="othersportsdiv" @if( !empty(old('othersportsplayed')) ) @php echo 'style="display:block"'; @endphp @endif >
														Please specify <input type="text" name="othersportsplayed" value="{{ old('othersportsplayed') }}" placeholder="Any other sport" />
													</div>
													
												<div style="clear:both"></div>
												@error('outdoorsports') <div class="alert alert-danger">{{ $message }}</div> @enderror	
												</div>	
												<div class="clear"></div>
											</div>
												
												


											<?php
												break;
												
											case "3":
											
												?>
												<div class="fitIndia-radio-col fitIndia-checkbox-col fit-no-width check-box-position">
													<label><input name="studentspending60min" type="checkbox" value="yes" 
													@if(!empty( old('studentspending60min') )) {{ 'checked' }} @endif /> 
													
														<div class="back-end fitindia-r box fit-checkbox"><span></span></div>
													</label>
												</div>
												<div style="clear:both"></div>
												@error('studentspending60min') <div class="alert alert-danger">{{ $message }}</div> @enderror
												
											<?php
												break;
												
												
											case "4":
											
												?>
												<div style="clear:both"></div>
												
												@error('assemblyactivityno') <div class="alert alert-danger">{{ $message }}</div> @enderror
												
												<div class="sub_ques_row  sub_ques-head">
													<div class="sub_ques_title pt-2 pb-5"> Daily Physical Activities by Students </div>
													<div class="sub_ques_elem"> 
														<div class="phy-activity">
															<span>With the Assembly</span> 
															<select name="assemblyactivityno" class="fit-pe-inputs">
															<option value="">Minutes per day</option>
															@php $phyactmin = 5; @endphp
															@while($phyactmin <= 60)
																<option value="{{ $phyactmin }}" @if(!empty(old('assemblyactivityno')) && old('assemblyactivityno') == $phyactmin) {{ 'selected' }}
																@endif >{{ $phyactmin }} min</option>
																@php $phyactmin = $phyactmin+5; @endphp
															@endwhile
															</select>
														</div>
														<div class="phy-activity">
															<span>Physical Education (PE) Periods</span> 
															<select name="physeduperiodno" class="fit-pe-inputs">
															<option value="">Minutes per day</option>
															@php $phyactmin = 5; @endphp
															@while($phyactmin <= 60)
																<option value="{{ $phyactmin }}" @if(!empty(old('physeduperiodno')) && old('physeduperiodno') == $phyactmin) {{ 'selected' }}
																@endif >{{ $phyactmin }} min</option>
																@php $phyactmin = $phyactmin+5; @endphp
															@endwhile
															</select>
														</div>
														<div class="phy-activity">
															<span>Before School hours/ after school hours:</span> 
															<select name="schoolclosreno" class="fit-pe-inputs">
															<option value="">Minutes per day</option>
															@php $phyactmin = 5; @endphp
															@while($phyactmin <= 60)
																<option value="{{ $phyactmin }}" @if(!empty(old('schoolclosreno')) && old('schoolclosreno') == $phyactmin) {{ 'selected' }}
																@endif >{{ $phyactmin }} min</option>
																@php $phyactmin = $phyactmin+5; @endphp
															@endwhile
															</select>
														</div>
														<div class="phy-activity">
															<span>Other/free play:</span> 
															<select name="otheractivityno" class="fit-pe-inputs">
															<option value="">Minutes per day</option>
															@php $phyactmin = 5; @endphp
															@while($phyactmin <= 60)
																<option value="{{ $phyactmin }}" @if(!empty(old('otheractivityno')) && old('otheractivityno') == $phyactmin) {{ 'selected' }}
																@endif >{{ $phyactmin }} min</option>
																@php $phyactmin = $phyactmin+5; @endphp
															@endwhile
															</select>
														</div> 
														 
													</div>
												</div>
												
												
												
											<?php
												break;
												
											default:
												break;
										} 
										
									}
										
									?>
									
										</div>
										
										
									</div>
									
									<div style="clear:both"></div>
									
								</div>

							

                        @endforeach
						
						@if($currentflag == 1621)
						<div class="um-field">
							<div class="um-field-area declare-col">
								<div class="fitIndia-radio-col fitIndia-checkbox-col fit-no-width">
									<label><input type="checkbox" name="declation" value="1" @if(!empty( old('declation') )) {{ 'checked' }} @endif />
										<div class="back-end fitindia-r box fit-checkbox"><span></span></div>
									</label>
								</div>
								<span> I hereby declare that all the statements made in this application are Complete and Correct to the best of my knowledge and belief.
								</span>
							</div>
						</div>
						<div style="clear:both"></div>
						@error('declation') <div class="alert alert-danger">{{ $message }}</div> @enderror
						
						@endif
						
						
						<div class="um-field">
							@if($currentflag == 1621)
							<div class="um-field-area">
								<input type="submit" name="star-rating" value="Submit" />
							</div>
							@endif
						</div>
						
						</div>
						</form>
						
						
						
						<?php
						if(!empty($flagstatusdata->cur_status) && $flagstatusdata->cur_status == 'awarded'){ ?>
										
											<div class="um-field">
												<div class="um-field-area">
												<?php
													
														echo '<a href="https://fitindia.gov.in/wp-content/uploads/2019/11/FitIndia-Flag.zip"  class="flag-dwn" download >Download Fit India School Flag</a>';
														
														echo '<a class="flag-dwn" href="download-certificate">Download Certificate</a>';
														echo '<div class="success-msg">'.' <i class="fa fa-star-o" aria-hidden="true"></i> Congratulations you have awarded Fit India School Flag </div>';
													
												?>
												</div>
											</div>
										

						<?php	} ?>
										
										

                    </div>          



<!-- Flag Request Close -->



<!-- Three Star Request Start -->			
                    <div id="tab-1622" class="star-rating-content @if(!empty($threestatusdata->status)) @if(strtolower($threestatusdata->status) == 'awarded' ){{'success'}} @else {{strtolower($threestatusdata->status)}}@endif @endif @if($currentflag == 1622){{'current'}} @endif">
						<form name="threestarrequest" method="post" action="{{ route('threestar') }}" enctype="multipart/form-data">
						@csrf
						
						<div class="rating-heading">
							<h3>Request for 3 Star </h3> <span class="default-i @if(!empty($threestatusdata->cur_status)) {{ $threestatusdata->cur_status }} @endif">@if(!empty($threestatusdata->cur_status)) @if($threestatusdata->cur_status == 'applied')<i class="fa fa-thumbs-up" aria-hidden="true"></i> @endif{{ucwords($threestatusdata->cur_status)}} @else <i class="fa fa-ban" aria-hidden="true"> </i> {{ 'Not Applied' }} @endif</span>
						</div>
					
						<div class="inner" >
				
						@php
						$ii = 0;
						@endphp
						<div class="um-field">
								<h2 for="event_name"> </h2>
								<input type="hidden" name="questions" value="5" />
								<input type="hidden" name="ratingreqid" value="1622" />
								<input type="hidden" name="user_id" value="{{ Auth::id() }}" />
						</div>

                        @foreach($threestars as $que)
						
                            @php
								$postid = $que->id;
								$questypeid = $que->questypeid;
								
                            @endphp

								<div class="um-field">
									<div class="um-field-label ques">
										<span class="star-ques-sr">{{++$ii}}.</span>
										<label for="ques_name" class="star-questions ">{{$que->title}}</label>
										
										<?php 
									if(!empty($threestatusdata->id)){
										
										switch ($questypeid) {
											case "5": ?>
												<div class="sub_ques_row sub_ques-head sub_flex1 n-teacher">
													<div class="sub_ques_title"> No. of teachers in school</div>
													<div class="sub_ques_elem"> 
														{{ $threedata->totnoteachers }}
													</div>
													<!-- <div class="clear"></div> -->
												</div>
												
												<div class="inner-align allwidth">
													<ol>
														<li class="sub_ques_title list-btm-mrgn">
														No. of teachers in school spending at least 60 minutes/ day for physical activities
														<br>
														{{ $threedata->noteachersplaying }}
														</li>
														<li class="sub_ques_title list-btm-mrgn">
														School encourages teachers to participate in sports or fitness in school? 
														(attach picture/circular)
														<br>
														@if(empty($threedata->encouragesdoc))
														{{ 'Document not uploaded' }}
														@else
														@if(substr($threedata->encouragesdoc, -4) == '.pdf')
															<a href="{{ $threedata->encouragesdoc }}" target="_blank" > View </a>
															<br>
														@else
															<a href="{{ $threedata->encouragesdoc }}" target="_blank" ><img src="{{ $threedata->encouragesdoc }}" width="100" height="100" /></a>
															<br>
															
														@endif
														@endif
													
														</li>
														<li class="sub_ques_title list-btm-mrgn">
														School motivates all teachers to do 60 minutes of physical activity every day 
														(eg. Posters, SMS, emails, circulars) (attach max 20 MB relevant doc)
														<br>
														@if(empty($threedata->motivatesdoc))
														{{ 'Document not uploaded' }}
														@else
														@if(substr($threedata->motivatesdoc, -4) == '.pdf')
															<a href="{{ $threedata->motivatesdoc }}" target="_blank" > View </a>
															<br>
														@else
															<a href="{{ $threedata->motivatesdoc }}" target="_blank" ><img src="{{ $threedata->motivatesdoc }}" width="100" height="100" /></a>
															<br>
														@endif
														@endif
														</li>
													</ol>
												</div>
												
												
												
											<?php
												break;
												case "6": ?>
												<div class="sub_ques_row sub_ques-head flex-1 n-teacher">
													<div class="sub_ques_title"> No. of teachers </div>
													<div class="sub_ques_elem"> {{ $threedata->trainedteacherno }}</div>
													
												</div>
												
												
													

												<div class="sub_ques_row sub_ques-head  playground-section" id="trainedteacherrow" 
												@empty($threedata->trainedteacherno) @php  echo 'style="display:none"'; @endphp @endempty >
												
												
												@empty($threedata->trainedteacherno)
													@else
													
												
													<div class="resTable">
														<table>
															<thead>
																<tr>
																  <th scope="col">Teacher/Coach Name</th>
																  <th scope="col">Sport 1</th>
																  <th scope="col">Sport 2</th>
																</tr>
															</thead>
															<tbody>
													
													
															@php $i = 0; @endphp
																
															@if(!empty($threedata->trainedteacherno))
															@while($i < $threedata->trainedteacherno)
																<tr>
																	<td data-label="Teacher/Coach Name">
																		{{ unserialize($threedata->trainedteachername)[$i] }} 
																	</td>
																	
																	<td data-label="Sport 1">
																		{{ unserialize($threedata->sportsone)[$i] }} 
																	</td>
																	
																	<td data-label="Sport 2">
																		{{ unserialize($threedata->sporttwo)[$i] }}
																	</td>
																				
																</tr>
																@php $i++; @endphp
															@endwhile
															@endif
													
															</tbody>
														</table>
													</div>
													<div class="clear"></div>
												
												
												@endempty
												
												
												
												

												</div>
											<?php	
												break;
												
												
												case "7": ?>
												<div class="sub_ques_row sub_ques-head">
												<div>Keep CTRL key press while selecting multiple sports </div>
													<div class="sub_ques_elem halfwidth"> 
														<div>Outdoor Sports ( minimum 2 )</div>
														<div class="sports-row">
														
														
														@php
														$outarr = 0;
														if(!empty($threedata->outdoorfacility)){
															$outarr = sizeof( unserialize($threedata->outdoorfacility) );
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
												
														
														
														<div id="outdoor-sprts"  @empty(old('outdoorextrafacility')) @php  echo 'style="display:none"'; @endphp @endempty >
														
														<input type="text" name="outdoorextrafacility"  placeholder="Any other outdoor sport" value="{{ old('outdoorextrafacility') }}"  />
														</div>
														</div>
													</div>
													<div class="sub_ques_elem halfwidth"> 
													
														<div>Indoor Sports ( minimum 2 )</div>
														<div class="sports-row">
														
														@php
														$outarr = 0;
														if(!empty($threedata->indoorfacility)){
															$outarr = sizeof( unserialize($threedata->indoorfacility) );
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
														

														
														
														<div id="indoor-sprts"   @empty(old('indoorextrafacility')) @php  echo 'style="display:none"'; @endphp @endempty>
															<input type="text" name="indoorextrafacility" placeholder="Any other indoor sport" value="{{ old('indoorextrafacility') }}" />
														</div>
														</div>
													</div>
													<div class="clear"></div>
												</div>
												<?php	
												break;
												
												
												case "8":
												?>
												<div class="fitIndia-radio-col fitIndia-checkbox-col fit-no-width check-box-position" style="top:5px; ">
													<label><input name="traditionalgames" type="checkbox" value="yes" @if(!empty( $threedata->traditionalgames )) {{ 'checked' }} @endif /> 
														<div class="back-end fitindia-r box fit-checkbox" ><span></span></div>
													</label>
												</div>

												<?php	
												break;
												
												
												case "9":
												?>
												<div class="inner-align" style="margin-top: 15px; width:100%;">
												@if(empty($threedata->schoolcertificate))
														{{ 'Document not uploaded' }}
												@else
														
													@if(substr($threedata->schoolcertificate, -4) == '.pdf')
														<a href="{{ $threedata->schoolcertificate }}" target="_blank" > View </a>
														<br>
													@else
														<a href="{{ $threedata->schoolcertificate }}" target="_blank" ><img src="{{ $threedata->schoolcertificate }}" width="100" height="100" /></a>
														<br>
													@endif 
												@endif
																								
												</div>
												
											<?php
												break;
												
											default:
												break;
										}
									}else{
										
										
										switch ($questypeid) {
											case "5": ?>
												<div class="sub_ques_row sub_ques-head sub_flex1 ml-3">
													<div class="sub_ques_title sub_flex_first2"> No. of teachers in school</div>
													<div class="sub_ques_elem"> 
														<input type="number" name="totnoteachers"  class="fit-pe-inputs"  min="0" value="{{ old('totnoteachers') }}" />
														@error('totnoteachers') <div class="alert alert-danger">{{ $message }}</div> @enderror
													</div>
													<div class="clear"></div>
												</div>
												
												<div class="inner-align allwidth">
													<ol>
														<li class="sub_ques_title list-btm-mrgn">
														No. of teachers in school spending at least 60 minutes/ day for physical activities
														<br>
														<input type="number" name="noteachersplaying" class="fit-pe-inputs field_w"   min="0" value="{{ old('noteachersplaying') }}" />
														@error('noteachersplaying') <div class="alert alert-danger">{{ $message }}</div> @enderror
														</li>
														<li class="sub_ques_title list-btm-mrgn">
														School encourages teachers to participate in sports or fitness in school? 
														(attach picture/circular)
														<input type="file" name="encouragesdoc"/>
														@error('encouragesdoc') <div class="alert alert-danger">{{ $message }}</div> @enderror
														</li>
														<li class="sub_ques_title list-btm-mrgn">
														School motivates all teachers to do 60 minutes of physical activity every day 
														(eg. Posters, SMS, emails, circulars) (attach max 20 MB relevant doc)
														<input type="file" name="motivatesdoc"/>
														@error('motivatesdoc') <div class="alert alert-danger">{{ $message }}</div> @enderror
														</li>
													</ol>
												</div>
												
												<div class="clear"></div>
												
											<?php
												break;
												case "6": ?>
												<div class="sub_ques_row sub_ques-head flex-1 ml-4">
													<div class="sub_ques_title sub_flex_first"> No. of teachers </div>
													<div class="sub_ques_elem"> 
														<input type="number" name="trainedteacherno" onkeyUp="trainedteachernofn(this.value,this)"  onclick="trainedteachernofn(this.value,this)" class="fit-pe-inputs"  min="0" value="{{ old('trainedteacherno') }}" />
														@error('trainedteacherno') <div class="alert alert-danger">{{ $message }}</div> @enderror
													</div>
													<div class="clear"></div>
												</div>

												<div class="sub_ques_row sub_ques-head  playground-section" id="trainedteacherrow" 
												@empty(old('trainedteacherno')) @php  echo 'style="display:none"'; @endphp @endempty >
												
												
												@empty(old('trainedteacherno'))
													@else
													
												
													<div class="resTable">
														<table>
														  <thead>
															<tr>
															  <th scope="col">Teacher/Coach Name</th>
															  <th scope="col">Sport 1</th>
															  <th scope="col">Sport 2</th>
															</tr>
														  </thead>
														  <tbody>
															
															
															@error("trainedteachername") <div class="alert alert-danger">{{ $message }}</div>@enderror
													
															@php $i = 0; @endphp
														
															@if(!empty(old('trainedteacherno')))
															@while($i < old('trainedteacherno'))
															<tr>
															
																<td data-label="Teacher/Coach Name">
																	<input type="text" name="trainedteachername[]" placeholder="Teacher Name" value="@if(!empty(old('trainedteachername')[$i])) {{ old('trainedteachername')[$i] }} @endif" />
																	@error("trainedteachername.$i") <div class="alert alert-danger">{{ $message }}</div>@enderror
																</td>
															
																<td data-label="Sport 1">
																	<select name="sportsone[]" class="schooldistance">
																		<option value="">Please Select</option>
																		@foreach($sports as $sport){ 
																			<option 
																			@if(!empty(old('sportsone')[$i]))
																			@if(old('sportsone')[$i] == $sport){{ 'selected' }} @endif @endif
																			>{{ $sport }}</option>
																		@endforeach
																	</select>
																	@error("sportsone.$i") <div class="alert alert-danger">{{ $message }}</div>@enderror
																</td>
															
																<td data-label="Sport 1">
																	<select name="sporttwo[]" class="schooldistance">
																		<option value="">Please Select</option>
																		@foreach($sports as $sport){ 
																			<option 
																			@if(!empty(old('sporttwo')[$i]))
																			@if (old('sporttwo')[$i] == $sport){{ 'selected' }} @endif @endif
																			>{{ $sport }} </option>
																		@endforeach
																		
																	</select>
																
																	@error("sporttwo.$i") <div class="alert alert-danger">{{ $message }}</div>@enderror
																</td>
																		
															</tr>
															@php $i++; @endphp
															@endwhile
															@endif
													
													
														  </tbody>
														</table>
													</div>
													<div class="clear"></div>
												
												
												@endempty
												
												
												
												

												</div>
											<?php	
												break;
												
												
												case "7": ?>
												<div class="sub_ques_row sub_ques-head">
												<div>Keep CTRL key press while selecting multiple sports </div>
													<div class="sub_ques_elem halfwidth"> 
														<div>Outdoor Sports ( minimum 2 )</div>
														<div class="sports-row">
														<select name="outdoorfacility[]" multiple onclick="othersportspop(this,'outdoor-sprts')">
															@foreach($outdoorsports as $sport){
																<option 
																@if(!empty(old('outdoorfacility')))
																	{{ (collect(old('outdoorfacility'))->contains($sport)) ? 'selected':'' }}
																	@endif
																>{{ $sport }}</option>
															@endforeach
															<option @if(!empty(old('outdoorfacility')))
																	{{ (collect(old('outdoorfacility'))->contains('Any other sport including indigenous games')) ? 'selected':'' }}
																	@endif >Any other sport including indigenous games</option>
															
														</select>
														
														<div id="outdoor-sprts"  @empty(old('outdoorextrafacility')) @php  echo 'style="display:none"'; @endphp @endempty >
														
														<input type="text" name="outdoorextrafacility"  placeholder="Any other outdoor sport" value="{{ old('outdoorextrafacility') }}"  />
														</div>
														</div>
														@error('outdoorfacility') <div class="alert alert-danger">{{ $message }}</div> @enderror
														
													</div>
													<div class="sub_ques_elem halfwidth"> 
														<br>
														<div>Indoor Sports ( minimum 2 )</div><br>
														<div class="sports-row">
														
														<select name="indoorfacility[]" multiple onclick="othersportspop(this,'indoor-sprts')">
															@foreach($indoorsports as $sport)
																<option 
																@if(!empty(old('indoorfacility')))
																	{{ (collect(old('indoorfacility'))->contains($sport)) ? 'selected':'' }}
																	@endif
																>{{$sport}}</option>
															@endforeach
															<option @if(!empty(old('indoorfacility')))
																	{{ (collect(old('indoorfacility'))->contains('Any other sport including indigenous games')) ? 'selected':'' }}
																	@endif>Any other sport including indigenous games</option>
														</select>
														
														<div id="indoor-sprts"   @empty(old('indoorextrafacility')) @php  echo 'style="display:none"'; @endphp @endempty>
															<input type="text" name="indoorextrafacility" placeholder="Any other indoor sport" value="{{ old('indoorextrafacility') }}" />
														</div>
														</div>
														@error('indoorfacility') <div class="alert alert-danger">{{ $message }}</div> @enderror
													</div>
													<div class="clear"></div>
												</div>
												<?php	
												break;
												
												
												case "8":
												?>
												<div class="fitIndia-radio-col fitIndia-checkbox-col fit-no-width check-box-position" style="top:5px; ">
													<label><input name="traditionalgames" type="checkbox" value="yes" @if(!empty( old('traditionalgames') )) {{ 'checked' }} @endif /> 
														<div class="back-end fitindia-r box fit-checkbox" ><span></span></div>
													</label>
												</div>
												@error('traditionalgames') <div class="alert alert-danger">{{ $message }}</div> @enderror

												<?php	
												break;
												
												
												case "9":
												?>
												<div class="inner-align" style="margin-top: 15px; width:100%;">
													<input type="file" name="school_certificate"/>
													@error("school_certificate") <div class="alert alert-danger">{{ $message }}</div>@enderror
												</div>
												
											<?php
												break;
												
											default:
												break;
										} 
										
									}
										
										
									?>
										
										
										
									</div>
									
									<div style="clear:both"></div>
									
								</div>

							

                        @endforeach
						
						 
						<div class="um-field">
							@if($currentflag == 1622)
							<div class="um-field-area">
								<input type="submit" name="star-rating" value="Submit" />
							</div>
							@endif
						</div>
						
						</div>
						</form>
						
						
						
						
						<?php
						if(!empty($threestatusdata->cur_status)){ ?>
										
											<div class="um-field">
												<div class="um-field-area">
												<?php
													
													if($threestatusdata->cur_status == 'applied'){
														
														if(empty($fivestatusdata->status)){
																
															echo '<div class="info-msg">';
															echo "You have successfully filled up your application for Fit Inida School 3 Star Certification. Your application will be reviewed and you will receive further instruction on School visit. The Fit India Mission would get the claim verified and therafter issue an Online Certificate and Commendation Letter. 
															
															<br>If your school is ready for 5 Star Certification, please fill up the information required for 5 Star Certification. 
															<br> PN: Your application for 3 Star Certificate will be replaced by application for 5 Star Certification.";
															
															echo ' </div>';
														}else{
															echo '<div class="info-msg">';
															echo " PN: Your application for 3 Star Certificate have replaced by application for 5 Star Certification.";
															echo ' </div>';
														}
													}else{
														echo '<div class="info-msg">'.' Thank you for applying for FIT INDIA SCHOOL  Certification. Your application current status for 3 star is <strong> '.$threestatusdata->cur_status.' </strong></div>';
													}
													
												?>
												</div>
											</div>
										

						<?php	} ?>
						

                    </div>          



<!-- Three Star Close -->




<!-- Five Star Request Start -->			
                    <div id="tab-1623" class="star-rating-content @if(!empty($fivestatusdata->status)) @if(strtolower($fivestatusdata->status) == 'awarded' ){{'success'}} @else {{strtolower($fivestatusdata->status)}}@endif @endif @if($currentflag == 1623){{'current'}} @endif   ">
						<form name="threestarrequest" method="post" action="{{ route('fivestar') }}" enctype="multipart/form-data">
						@csrf
						
						<div class="rating-heading">
							<h3>Request for 5 Star </h3>
							<span class="default-i @if(!empty($fivestatusdata->cur_status)) {{ $fivestatusdata->cur_status }} @endif">@if(!empty($fivestatusdata->cur_status)) @if($fivestatusdata->cur_status == 'applied')<i class="fa fa-thumbs-up" aria-hidden="true"></i> @endif{{ucwords($fivestatusdata->cur_status)}} @else <i class="fa fa-ban" aria-hidden="true"> </i> {{ 'Not Applied' }} @endif</span>
							
							
						</div>
					
						<div class="inner" >
				
						@php
						$ii = 0;
						$opentos = array('Community','Parents','General Public', 'RWA');
						@endphp
						<div class="um-field">
								<h2 for="event_name"> </h2>
								<input type="hidden" name="questions" value="6" />
								<input type="hidden" name="ratingreqid" value="1623" />
								<input type="hidden" name="user_id" value="{{ Auth::id() }}" />
						</div>

                        @foreach($fivestars as $que)
						
                            @php
								$postid = $que->id;
								$questypeid = $que->questypeid;
							
                            @endphp

								<div class="um-field">
									<div class="um-field-label ques">
										<span class="star-ques-sr">{{++$ii}}.</span>
										<label for="ques_name" class="star-questions  ">{{$que->title}}</label>
									
										
										<?php 
									if(!empty($fivestatusdata->id)){
										
										
										
										switch ($questypeid){
												case "9":
												?>
												<div class="sub_ques_row sub_ques-head">
												<div class=""> 
												<div class="fitIndia-radio-col fitIndia-checkbox-col fullwidth">
													<label>
														<input type="checkbox" name="intraschoolcomp[]" value="Conducts quarterly Intra-school Competitions" @if(!empty($fivedata->intraschoolcomp))
																	{{ (collect(unserialize($fivedata->intraschoolcomp))->contains("Conducts quarterly Intra-school Competitions")) ? 'checked':'' }}
																	@endif  />
														<div class="back-end fitindia-r box fit-checkbox">
														<span></span></div>
													</label>
												<span class="checkbox-span">Conducts quarterly Intra-school Competitions (need not be all classes) (attach document)</span>
												</div>
												
												<div class="fivstarattachdoc">
												@if(empty($fivedata->quarterintraschooldoc))
														{{ 'Document not uploaded' }}
												@else
												
													@if(substr($fivedata->quarterintraschooldoc, -4) == '.pdf')
														<a href="{{ $fivedata->quarterintraschooldoc }}" target="_blank" > View </a>
														<br>
													@else
														<a href="{{ $fivedata->quarterintraschooldoc }}" target="_blank" ><img src="{{ $fivedata->quarterintraschooldoc }}" width="100" height="100" /></a>
														<br>
													@endif
												@endif

												</div>
												
												<div class="fitIndia-radio-col fitIndia-checkbox-col fullwidth">
														<label><input type="checkbox" name="intraschoolcomp[]" value="Participates in Inter-school Competition" 
														@if(!empty( $fivedata->intraschoolcomp ))
																	{{ (collect( unserialize($fivedata->intraschoolcomp) )->contains("Participates in Inter-school Competition")) ? 'checked':'' }}
																	@endif
														/><div class="back-end fitindia-r box fit-checkbox"><span></span></div></label>
														<span class="checkbox-span">Participates in Inter-school Competition (attach document)</span>
												</div>
												<div class="fivstarattachdoc"> 
												
												@if(empty($fivedata->participateintraschooldoc))
														{{ 'Document not uploaded' }}
												@else
												
													@if(substr($fivedata->participateintraschooldoc, -4) == '.pdf')
														<a href="{{ $fivedata->participateintraschooldoc }}" target="_blank" > View </a>
														<br>
													@else
														<a href="{{ $fivedata->participateintraschooldoc }}" target="_blank" ><img src="{{ $fivedata->participateintraschooldoc }}" width="100" height="100" /></a>
														<br>
													@endif
												@endif
												</div>
												
												<div class="fitIndia-radio-col fitIndia-checkbox-col fullwidth">
														<label><input type="checkbox" name="intraschoolcomp[]" value="Celebrate Annual Sports Day" 
														@if(!empty($fivedata->intraschoolcomp))
																	{{ (collect(unserialize($fivedata->intraschoolcomp))->contains("Celebrate Annual Sports Day")) ? 'checked':'' }}
																	@endif
														/><div class="back-end fitindia-r box fit-checkbox"><span></span></div></label>
														<span class="checkbox-span">Celebrate Annual Sports Day (attach document)</span>
												</div>
												<div class="fivstarattachdoc">
												@if(empty($fivedata->celebrateannualsportdoc))
														{{ 'Document not uploaded' }}
												@else
												
													@if(substr($fivedata->celebrateannualsportdoc, -4) == '.pdf')
														<a href="{{ $fivedata->celebrateannualsportdoc }}" target="_blank" > View </a>
														<br>
													@else
														<a href="{{ $fivedata->celebrateannualsportdoc }}" target="_blank" ><img src="{{ $fivedata->celebrateannualsportdoc }}" width="100" height="100" /></a>
														<br>
													@endif
												@endif	
												</div>
												</div>
												</div>
												
												<div class="sub_ques_row sub_ques-head">
												<div class="sub_ques_elem achievements fullwidth">
												<div class="fullwidth"> Achievements, if any in Inter-school, District, State or National Level </div>
													<div> {{ $fivedata->achievements }} </div>
												</div>
												</div>
												<?php
												break;
												case "10":
												?>
												<div class="fitIndia-radio-col fitIndia-checkbox-col fit-no-width pecheck-box">
													<label>
													<input name="alltrainedpe" type="checkbox" value="yes" @if(!empty( $fivedata->alltrainedpe )) {{ 'checked' }}  @endif /> 
													
														<div class="back-end fitindia-r box fit-checkbox"><span></span></div>
													</label>
												</div>
												<div class="sub_ques_title allwidth trainedpe">
													<p>All teachers have attended some certified online/offline course on PE for at least one week	</p>												
													<p>(Principal/ Management should certify this on school’s letterhead- attach document)	</p>	
												
												<div class="fivstarattachdoc"> 
													@if(empty($fivedata->pecertifieddoc))
															{{ 'Document not uploaded' }}
													@else
													
														@if(substr($fivedata->pecertifieddoc, -4) == '.pdf')
															<a href="{{ $fivedata->pecertifieddoc }}" target="_blank" > View </a>
															<br>
														@else
															<a href="{{ $fivedata->pecertifieddoc }}" target="_blank" ><img src="{{ $fivedata->pecertifieddoc }}" width="100" height="100" /></a>
															<br>
														@endif
													@endif
												</div>
												</div>
											<?php
												break;
												
												
												
												
												
												case "11": ?>
												<div class="sub_ques_row sub_ques-head flex-1">
													<div class="sub_ques_title"> No. of Sports Coaches  </div>
													<div class="sub_ques_elem"> 
														{{ $fivedata->sportscoachno }}
													</div>
													<div class="clear"></div>
												</div>

												<div class="sub_ques_row sub_ques-head  playground-section" id="sportscoachrow" 
													@if(empty( old('sportscoachno') )) {{ 'style="display:none"' }} @endif
												>
												
												@if(!empty( $fivedata->sportscoachno ))
												
													<div class="resTable">
														<table>
															<thead>
																<tr>
																  <th scope="col">Coach Name</th>
																  <th scope="col">Sports</th>
																  
																</tr>
															</thead>
													  <tbody>
														@php $i = 0; @endphp
														@while($i < $fivedata->sportscoachno )
															<tr>
																<td data-label="Coach Name">
																	<div class="teachername">
																		<div class="fitIndia-radio-col">
																			{{ unserialize($fivedata->sportscoachname)[$i] }} 
																		</div>
																	</div>
																</td>
																<td data-label="Sports">
																	<div class="schooldistance">
																	{{ unserialize($fivedata->coachsports)[$i] }}
																	</div>
																</td>
															</tr>
														@php $i++; @endphp	
														@endwhile
													  </tbody>
														</table>
													</div>
													<div class="clear"></div>
												
												
												@endif

												</div>
											<?php	
												break;
											
											case "12": ?>
												<div class="sub_ques_row sub_ques-head">
													<div class="sub_ques_title"> Board  </div>
													<div class="sub_ques_elem board"> 
													{{ $fivedata->peboard }}
											
											</div>
											<div class="clear"></div>
											</div>
											
											
											
											<div class="fivstarattachdoc"> 
											@if(empty($fivedata->curriculumboarddoc))
														{{ 'Document not uploaded' }}
											@else	
												@if(substr($fivedata->curriculumboarddoc, -4) == '.pdf')
													<a href="{{ $fivedata->curriculumboarddoc }}" target="_blank" > View </a>
													<br>
												@else
													<a href="{{ $fivedata->curriculumboarddoc }}" target="_blank" ><img src="{{ $fivedata->curriculumboarddoc }}" width="100" height="100" /></a>
													<br>
												@endif
											@endif
											</div>
											
											
												
										<?php
											break;
											
											
											
											case "13": ?>
												
												<div class="sub_ques_row sub_ques-head  playground-section"  >
												
												
													<div class="sub_ques_elem fullwidth"> 
														<div style="font-size: 12px;font-weight: 400;margin-bottom: 15px;"> Note: Minimum 80% of Students fitness assessment must be done </div>
															<div class="row playground-row playground-heading ">
																<div class="col-sm-12 col-md-4">
																	<div class="head_cert">
																		<p class="cer_p">ID(School Affiliation Code)on schoolfitness.kheloindia.gov.in</p>
																		<div class="schoolfitnessid">
																			{{ $fivedata->schoolfitnessid }}
																		</div>
																	</div>
																</div>																
																
																<div class="col-sm-12 col-md-4">
																	<div class="head_cert">
																		<p class="cer_p">No of students</p>
																		<div class="noofstudents">
																			{{ $fivedata->noofstudents }}
																		</div>
																	</div>
																</div>																
																
																<div class="col-sm-12 col-md-4">	
																	<div class="head_cert">
																		<P class="cer_p">No of students fitness assessment done</P>
																		<div class="noofassessments">
																		{{ $fivedata->noofassessments }}
																	</div>
																</div>
															</div>																
														</div>
													
														<!-- <div class="playground-row playground-heading "> -->
															<!-- <div class="schoolfitnessid">
																{{ $fivedata->schoolfitnessid }}
															</div> -->
															<!-- <div class="noofstudents">
																{{ $fivedata->noofstudents }}
															</div> -->
															<!-- <div class="noofassessments">
																{{ $fivedata->noofassessments }}
															</div> -->
																		
														<!-- <div style="clear:both"></div>
														</div> -->
														
													</div>
													<div class="clear"></div>
												

												</div>
											<?php	
												break;
											
											
											case "14": ?>
												
												<div class="sub_ques_row sub_ques-head  playground-section"  >
												
												
													<div class="sub_ques_elem fullwidth"> 
														<div class="row playground-row playground-heading">
															<!--  start Facilities -->
															<div class="col-sm-12 col-md-6"><p>Facilities</p>
															<?php
																	$i=0;
																	while($i < 4){ ?>
																	<div class="facility">
																		{{ unserialize($fivedata->facilities)[$i] }} 
																	</div>																	
															<?php $i++; } ?>
														
															</div><!--  End Facilities -->


                                                            <!--  start Open to-->
															<div  class="col-sm-12 col-md-6"><p>Open to</p>
																<?php
																	$i=0;
																	while($i < 4){ ?>
																		<div class="">																
																			{{ unserialize($fivedata->opento)[$i] }} 
																		</div>

																<?php $i++; } ?>
															</div><!--  End Open to-->
															
														</div>
													</div>
													<div class="clear"></div>	
												</div>
											<?php	
												break;

											
											default:
												break;
										}
										
									}else{
										
										
										switch ($questypeid){
												case "9":
												?>
												<div class="sub_ques_row sub_ques-head">
												@error("intraschoolcomp") <div class="alert alert-danger">{{ $message }}</div>@enderror
												
												<div class=""> 
												<div class="fitIndia-radio-col fitIndia-checkbox-col fullwidth">
													<label>
														<input type="checkbox" name="intraschoolcomp[]" value="Conducts quarterly Intra-school Competitions" @if(!empty(old('intraschoolcomp')))
																	{{ (collect(old('intraschoolcomp'))->contains("Conducts quarterly Intra-school Competitions")) ? 'checked':'' }}
																	@endif  />
														<div class="back-end fitindia-r box fit-checkbox">
														<span></span></div>
													</label>
												<span class="checkbox-span">Conducts quarterly Intra-school Competitions (need not be all classes) (attach document)</span>
												</div>
												
												<div class="inner-align" style="margin-top: 10px; width:100%;margin-bottom:10px;">
												 <input type="file" name="quarterintraschooldoc" /> </div>
												@error("quarterintraschooldoc") <div class="alert alert-danger">{{ $message }}</div>@enderror
												
												<div class="fitIndia-radio-col fitIndia-checkbox-col fullwidth">
														<label><input type="checkbox" name="intraschoolcomp[]" value="Participates in Inter-school Competition" 
														@if(!empty(old('intraschoolcomp')))
																	{{ (collect(old('intraschoolcomp'))->contains("Participates in Inter-school Competition")) ? 'checked':'' }}
																	@endif
														/><div class="back-end fitindia-r box fit-checkbox"><span></span></div></label>
														<span class="checkbox-span">Participates in Inter-school Competition (attach document)</span>
												</div>
												
												<div class="inner-align" style="margin-top: 10px; width:100%;margin-bottom:10px;"> <input type="file" name="participateintraschooldoc" /> </div>
												@error("participateintraschooldoc") <div class="alert alert-danger">{{ $message }}</div>@enderror
												
												<div class="fitIndia-radio-col fitIndia-checkbox-col fullwidth">
														<label><input type="checkbox" name="intraschoolcomp[]" value="Celebrate Annual Sports Day" 
														@if(!empty(old('intraschoolcomp')))
																	{{ (collect(old('intraschoolcomp'))->contains("Celebrate Annual Sports Day")) ? 'checked':'' }}
																	@endif
														/><div class="back-end fitindia-r box fit-checkbox"><span></span></div></label>
														<span class="checkbox-span">Celebrate Annual Sports Day (attach document)</span>
												</div>
												<div class="inner-align" style="margin-top: 10px; width:100%;margin-bottom:10px;"><input type="file" name="celebrateannualsportdoc" /> </div>
												@error("celebrateannualsportdoc") <div class="alert alert-danger">{{ $message }}</div>@enderror
												</div>
												</div>
												
												<div class="sub_ques_row sub_ques-head">
												<div class="sub_ques_elem achievements fullwidth">
												<div class="fullwidth"> Achievements, if any in Inter-school, District, State or National Level </div>
												<textarea name="achievements">{{ old('achievements') }} </textarea>
												
												</div>
												</div>
												<?php
												break;
												case "10":
												?>
												<div class="fitIndia-radio-col fitIndia-checkbox-col fit-no-width pecheck-box">
													<label><input name="alltrainedpe" type="checkbox" value="yes" @if(!empty( old('alltrainedpe'))) {{ 'checked' }}  @endif /> 
														<div class="back-end fitindia-r box fit-checkbox"><span></span></div>
													</label>
												</div>
												@error("alltrainedpe") <div class="alert alert-danger">{{ $message }}</div>@enderror
												
												<div class="sub_ques_row sub_ques-head">
												<p class="mb-0" style="font-weight:400;">All teachers have attended some certified online/offline course on PE for at least one week	</p>	
												
												<p style="font-weight:400;">(Principal/ Management should certify this on school’s letterhead- attach document)	</p>	
												
												<div class="inner-align" style="margin-top: 10px; width:100%;margin-bottom:10px;"> <input type="file" name="pecertifieddoc" /> </div>
												@error("pecertifieddoc") <div class="alert alert-danger">{{ $message }}</div>@enderror
												
											<?php
												break;
												
												
												
												
												
												case "11": ?>
												<div class="sub_ques_row sub_ques-head flex-1">
													<div class="sub_ques_title"> No. of Sports Coaches  </div>
													<div class="sub_ques_elem"> 
														<input type="number" name="sportscoachno" onkeyUp="sportscoachnos(this.value,this)" onclick="sportscoachnos(this.value,this)" class="fit-pe-inputs"  min="0" value="{{ old('sportscoachno')}}" />
													</div>
													<div class="clear"></div>
												</div>
												@error("sportscoachno") <div class="alert alert-danger">{{ $message }}</div>@enderror

												<div class="sub_ques_row sub_ques-head  playground-section" id="sportscoachrow" 
													@if(empty( old('sportscoachno') )) {{ 'style="display:none"' }} @endif >
												
												@if(!empty( old('sportscoachno')))
												
													<div class="resTable">
														<table>
															<thead>
																<tr>
																  <th scope="col">Coach Name</th>
																  <th scope="col">Sports</th>
																  
																</tr>
															</thead>
													  <tbody>
													
													 
													@php $i = 0; @endphp
													@while($i < old('sportscoachno') )
														<tr>
																<td data-label="Coach Name">
																	<div class="teachername">
																		<input type="text" name="sportscoachname[]" placeholder="Coach Name" value="{{ old('sportscoachname')[$i] }}"  />
																		
																		@error("sportscoachname.$i") <div class="alert alert-danger">{{ $message }}</div>@enderror
																	</div>
																</td>
																<td data-label="Sports">
																	<div class="schooldistance">
																		<select name="coachsports[]" class="schooldistance">
																			<option value="">Please Select</option>
																			@foreach($sports as $sport) 
																				<option @if (old('coachsports')[$i] == $sport){{ 'selected' }} @endif >{{ $sport }}</option>
																				
																			@endforeach
																		</select>
																		<div style="clear:both"></div>
																		@error("coachsports.$i") <div class="alert alert-danger">{{ $message }}</div>@enderror
																	</div>
																</td>
														</tr>
													@php $i++; @endphp	
													@endwhile
														
													</tbody>
														</table>
													</div>
													<div class="clear"></div>
												
												
												@endif

												</div>
											<?php	
												break;
											
											case "12": ?>
											<div class="sub_ques_row sub_ques-head">
												<!-- <div class="sub_ques_title"> Board  </div> -->
												<div class="sub_ques_elem board"> 
													
													<select name="peboard">
														<option value="">Select Board</option>
														<option @if (old('peboard') == 'NCERT'){{ 'selected' }} @endif >NCERT</option>
														<option @if (old('peboard') == 'CBSE'){{ 'selected' }} @endif >CBSE</option>
														<option @if (old('peboard') == 'SCERT'){{ 'selected' }} @endif >SCERT</option>
														<option @if (old('peboard') == 'ICSE'){{ 'selected' }} @endif >ICSE</option>
														<option @if (old('peboard') == 'Private organisation aligned with NCERT or CBSE or SCERT curriculum'){{ 'selected' }} @endif >Private organisation aligned with NCERT or CBSE or SCERT curriculum</option>
														
													</select>
													
													<div class="clear"></div>
													@error("peboard") <div class="alert alert-danger">{{ $message }}</div>@enderror
											
												</div>
												</div>	
										
											
											</div>										
											
											
											<div class="sub_ques_row sub_ques-head"> <input type="file" name="curriculumboarddoc" /> </div>
											<div class="clear"></div>
											@error("curriculumboarddoc") <div class="alert alert-danger">{{ $message }}</div>@enderror
											
												
										<?php
											break;
											
											
											
											
											
											case "13": ?>
												
												<div class="sub_ques_row sub_ques-head  playground-section"  >
													<div class="sub_ques_elem fullwidth"> 
														<div style="font-size: 12px;font-weight: 400;margin-bottom: 15px;"> Note: Minimum 80% of Students fitness assessment must be done </div>
															<div class=" row playground-row  mobile_flex_3">
															     
																<div class="col-sm-12 col-md-4 col-lg-4 ">
																	<div class="">
																		<span class="sp_id">ID(School Affiliation Code)on schoolfitness.kheloindia.gov.in</span>
																		<input type="text" name="schoolfitnessid" value="{{ old('schoolfitnessid') }}" class="input_block" />																	
																		@error("schoolfitnessid") <div class="alert alert-danger">{{ $message }}</div>@enderror
																	</div>
																</div>
																
																<div class="col-sm-12 col-md-4 col-lg-4 ">													
																	<div class="">
																		<span  class="sp_id sp_id2">No of students</span>
																		<input type="text" name="noofstudents" value="{{ old('noofstudents') }}"  class="input_block" />																		
																		@error("noofstudents") <div class="alert alert-danger">{{ $message }}</div>@enderror
																	</div>
																</div>

																<div class="col-sm-12 col-md-4 col-lg-4 ">																
																	<div class="">
																	<span  class="sp_id sp_id2">No of students fitness assessment done</span>
																		<input type="text" name="noofassessments" value="{{ old('noofassessments') }}"  class="input_block" />
																		@error("noofassessments") <div class="alert alert-danger">{{ $message }}</div>@enderror
																	</div>
																</div>														
														</div>
													</div>
												</div>
											<?php	
												break;
											
											
											case "14": ?>
												
												<div class="sub_ques_row sub_ques-head  playground-section"  >
												    <div class="sub_ques_elem fullwidth"> 
														<div class="row">
                                                          <div class="col-sm-12 col-md-6">
															  <h6>Facilities</h6>																
																	@error("facilities")
																		<div class="clear"></div>
																		<div class="alert alert-danger">{{ $message }}</div>
																	@enderror
																	<?php
																		$i=0;
																			while($i < 4){ ?>
																				<div class="facility">
																					<select name="facilities[]" >
																						<option value="">Please Select</option>
																						
																						@foreach($sports as $sport){ 
																							<option @if(!empty(old('facilities')[$i])) {{ (collect(old('facilities')[$i])->contains($sport)) ? 'selected':'' }} @endif > {{ $sport }}  </option>
																						
																						@endforeach
																					</select>
																				</div>
																	<?php $i++; } ?>																
														  </div>

															<div class="col-sm-12 col-md-6">
															  <h6>Open to</h6>																														
																	@error("opento") 
																		<div class="clear"></div>
																		<div class="alert alert-danger">{{ $message }}</div>
																	@enderror

																	<?php
																		$i=0;
																		while($i < 4){ ?>																
																			<div class="opento">
																				<select name="opento[]" >
																					<option value="">Please Select</option>
																					@foreach($opentos as $opento){ 
																						<option 
																						@if(!empty(old('opento')[$i]))
																						{{ (collect(old('opento')[$i])->contains($opento)) ? 'selected':'' }} @endif
																						>{{ $opento }} </option>
																						
																					@endforeach
																				</select>
																			</div>	
																	<?php $i++; } ?>

															
															</div>															
														</div>
													</div>	
												</div>
											<?php	
												break;

											default:
											break;
										} 
										
										
										}
										
									?>
										
										
										
									</div>
									
									<div style="clear:both"></div>
									
								</div>

							

                        @endforeach
						
						<div class="um-field">
							@if($currentflag == 1623)
							<div class="um-field-area">
								<input type="submit" name="star-rating" value="Submit" />
							</div>
							@endif
						</div>
						
						</div>
						</form>
						
						
						<?php
						if(!empty($fivestatusdata->cur_status)){ ?>
										
											<div class="um-field">
												<div class="um-field-area">
												<?php
													
													if($fivestatusdata->cur_status == 'applied'){
														echo '<div class="info-msg">';
														echo " You have successfully filled up your application for Fit Inida School 5 Star Certification. Your application will be reviewed and you will receive further instruction on School visit. The Fit India Mission would get the claim verified and therafter issue an Online Certificate and Commendation Letter.";
														echo ' </div>';
														
													}else{
														echo '<div class="info-msg">'.' Thank you for applying for FIT INDIA SCHOOL  Certification. Your application current status for 5 star is <strong> '.$fivestatusdata->cur_status.' </strong></div>';
													}
													
												?>
												</div>
											</div>
										

						<?php	} ?>
						
						

                    </div>          



<!-- Five Star Close -->



                    @else
                        <div class="event-form my-event">                    
                            <div class="all-events">
                                <div class="no-events">You aren't registered as school, you cannot apply for School Certification</div>
                            </div>
                        </div>

                    @endif

	
				</div>
                </div>

 
            </div>
        </div>
    </div>
            <br><br>
</div>
	
	
	<style>


	.star-rating-content.current {
		border: 2px solid #ccc;
    background-color: rgb(255 255 255);
	}

	.star-rating-content {
		margin-top: 30px;
		border: 1px solid #ccc;
		padding: 20px 30px 30px 30px;
		border-radius: 10px;
		position: relative;
	}
	
	/* .check_flex{display:flex;} */
	
	
	.rating-heading span.default-i {
		right: -1px;
		top: -1px;
	}
	
	.rating-heading span.default-i, .star-rating-content.success .rating-heading span.sucess-i, .star-rating-content.current .rating-heading span.apply-i, .star-rating-content.current .rating-heading span.info-i, .star-rating-content.rejected .rating-heading span.reject-i {
    position: absolute;
    padding: 8px 10px 8px 10px;
    border-radius: 0 10px 0 10px;
    font-style: normal;
}
span.default-i {
    color: #bbb!important;
    border: 1px solid #ccc;
}

.rating-heading span.default-i, .star-rating-content.success .rating-heading span.sucess-i, .star-rating-content.current .rating-heading span.apply-i, .star-rating-content.current .rating-heading span.info-i, .star-rating-content.rejected .rating-heading span.reject-i {
    position: absolute;
    padding: 8px 10px 8px 10px;
    border-radius: 0 10px 0 10px;
    font-style: normal;
}
	.star-rating-content .rating-heading span.default-i:before, .star-rating-content.success .rating-heading span.sucess-i:before, .star-rating-content .rating-heading span.apply-i:before, .star-rating-content .rating-heading span.info-i:before, .star-rating-content.rejected .rating-heading span.reject-i:before {
		font-size: 18px;
		margin-right: 4px;
		position: absolute;
		top: 10px;
		left: 12px;
	}
	.star-rating-content.current .rating-heading span.default-i, .star-rating-content.current .rating-heading span.apply-i, .star-rating-content.success .rating-heading span.sucess-i, .star-rating-content.current .rating-heading span.info-i, .star-rating-content.rejected .rating-heading span.reject-i {
		right: -2px;
		top: -2px;
	}
	
	.star-rating-content.current .rating-heading span.default-i, .star-rating-content.current .rating-heading span.apply-i, .star-rating-content.current .rating-heading span.info-i {
		border: 2px solid #a1d3fa;
		color: #2196f3 !important;
	}


	.star-rating-content.success .rating-heading span.sucess-i, .star-rating-content.current .rating-heading span.apply-i, .star-rating-content.current .rating-heading span.info-i, .star-rating-content.rejected .rating-heading span.reject-i {
		position: absolute;
		padding: 8px 10px 8px 10px;
		border-radius: 0 10px 0 10px;
		font-style: normal;
	}
	
	.rating-heading span.default-i, .star-rating-content.success .rating-heading span.sucess-i, .star-rating-content.current .rating-heading span.apply-i, .star-rating-content.current .rating-heading span.info-i, .star-rating-content.rejected .rating-heading span.reject-i {
    position: absolute;
    padding: 8px 10px 8px 10px;
    border-radius: 0 10px 0 10px;
    font-style: normal;
}
		.pecheck-box {  position: absolute;  top: 8px;  right: 0px;}
		.trainedpe{ margin-top:10px  }
		.fivstarattachdoc {  margin-left: 20px;  margin-bottom: 20px; } 
		.fivstarattachdoc input[type=file] {  border: none; }
		.extrafld{ margin:10px; display:none;}
		.inr-ans {margin-left: 20px; font-weight: 600;}
		/* .inner-align{ margin-left: 20px; } */
		.list-btm-mrgn { margin-bottom:25px; }
		.playground-img a img{ width:100px; height:100px; text-align:left;  }
		#othersportsdiv{ display:none; }
		.allwidth{ width:100% !important; margin-top:15px;}
			 span.cur-status { float: right; color: #ff8b0c; background: #fff; display: inline-block; padding: 5px 10px;
				margin-top: -5px; font-weight: 700; font-style: italic; margin-right: -5px; }
			.cur-ans { float: right; display: inline-block; padding: 5px 10px; margin-top: -5px; margin-right: -5px; }
			.sub_ques_elem { width: 100%; }
			.peteachernames-col { width: 49%; float: left; margin-right: 2%; margin-bottom: 12px; position: relative; }
			.peteachernames-col:nth-child(2n+2) { margin-right: 0; }
			.peteachernames-col span { position: absolute; top: 9px; left: 7px; color: #888; }
			.peteachernames-col input.peteachernames { padding-left: 25px !important; }
			.fit-pe-inputs{width: 100%; -moz-border-radius: 2px; -webkit-border-radius: 2px; border-radius: 2px; outline: none!important; cursor: text!important; font-size: 15px!important; height: 35px!important; box-sizing: border-box!important; box-shadow: none!important; margin: 0!important; position: static; outline: none!important; padding: 8px 10px!important;}
			.sub_ques_elem input[type="number"].fit-pe-inputs{width: 100px;}
			.event-form .star-rating-content .ques { position: relative; font-weight: 600; }
			.sub_ques_title { padding: 0px 0px 2px;  font-weight: 500; }
			.playground-row{width:100%}
			.playgroundno, .playgroundshape, .playgroundarea, .playgroundlside, .schooldistance, .teachername, .schoolfitnessid,.noofstudents, .noofassessments, .facility, .opento{
			display: inline-block;
				
			}
			.playgroundno{ width:20px; }
			/* .playgroundarea, .playgroundlside, .schooldistance{ width:88px; margin-left: 12px; margin-bottom: 0;padding:} */
			
			/* .sub_ques-head .sub_ques_title, .sub_ques-head .sub_ques_elem{
				float:left;
				width:auto;
			} */
			/* .sub_ques-head .sub_ques_title{ width:30%; margin-right:2%; } */
			/* .sub_ques-head .sub_ques_elem{ width:68%; } */
		
			
			/* .sub_ques_row.pe-ques-detail .sub_ques_title{width:30%; margin-right:2%; float:left; padding: 0px;} */
			/* .sub_ques_row.pe-ques-detail .sub_ques_elem { width:68%; float:left} */
			.fullwidth{ width:100% !important; }
			
			.sub_ques_row.pe-ques-detail .peteachernames-col {
				width: 100%;
				float: left;
				margin-right: 0px;
				margin-bottom: 12px;
				position: relative;
			}
			.sub_ques_row.pe-ques-detail { margin: 15px 15px 0px; }
			.sub_ques_row.sub_ques-head.sub_ques-head-padding {padding-top: 20px; }
			.event-form .star-rating-content .ques label { font-weight: bold; display: inline-table; }
			
			
			
						
			.fitIndia-radio-col input[type="radio"] { display: none; }
			.fitIndia-radio-col input[type="radio"]:checked + .box { background-color: #2196f3;  border: 1px solid #2196f3; }
			.fitIndia-radio-col input[type="radio"]:checked + .box span { color: white; transform: translateY(-6px); }
			.fitIndia-radio-col input[type="radio"]:checked + .box span:before { transform: translateY(0px); opacity: 1; }
			.fitIndia-radio-col .fitindia-r.box { width: 35px; height: 25px;margin-right: 5px; border: 1px solid #a1d3fa; transition: all 250ms ease; will-change: transition; display: inline-block; text-align: center; cursor: pointer; position: relative; font-family: "Dax", sans-serif; font-weight: 900; }
			.fitIndia-radio-col .fitindia-r.box:active { transform: translateY(10px); }
			.fitIndia-radio-col .box span {
			  position: absolute;
			  transform: translate(0, 0px);
			  left: 0;
			  right: 0;
			  transition: all 300ms ease;
			  font-size: 20px;
			  user-select: none;
			  color: #007e90;
			}
			.fitIndia-radio-col .fitindia-r.box span:before {
			  font-size: 1.2em;
			  font-family: FontAwesome;
			  display: block;
			  transform: translateY(-10px);
			  opacity: 0;
			  transition: all 300ms ease-in-out;
			  font-weight: normal;
			  color: white;
			}
			


			.fitIndia-radio-col .front-end.box.fit-radio1 {
				height: 25px;
				width: 35px;
				margin-right: 8px;
			}
			.fitIndia-radio-col .back-end.box.fit-radio2 {
				border-radius: 50%;
				height: 25px;
				width: 40px;
			}
			.fitIndia-radio-col .back-end.box.fit-radio3 {
			  margin-left: 15px;
				width: 35px;
				height: 24px;
				margin: 0 0;
				transform: perspective(2px) rotateX(0deg) rotateY(-1deg);
			}

			.fitIndia-radio-col label {
				width: auto !important;
				display: inline;
			}
						
			
			
			.fitIndia-radio-col input[type="checkbox"] { display: none; }
			.fitIndia-radio-col input[type="checkbox"]:checked + .box { background-color: #2196f3;  border: 1px solid #2196f3; }
			.fitIndia-radio-col input[type="checkbox"]:checked + .box span { color: white; transform: translateY(-2px); }
			.fitIndia-radio-col input[type="checkbox"]:checked + .box span:before { transform: translateY(0px); opacity: 1; }
			
			
			
		.fitIndia-radio-col .fit-checkbox.box {
			width: 20px;
			height: 20px;
		}
		.fitIndia-radio-col .fit-checkbox.box span{
			font-size:16px;
		}	
			
		.fitIndia-radio-col.fitIndia-checkbox-col{
			display: inline-flex;
			flex-wrap: wrap;
			margin-right: 10px;
			width: 130px;
			font-weight: 500;
		}
		span.checkbox-span {
			margin-left: 5px;
			display: inline-block;
		}
		.event-form .um-field {
			padding-top: 20px;
		}
		.fitIndia-radio-col.fitIndia-checkbox-col label+span {
			position: relative !important;
		}

		
		.playground-row.playground-heading .playgroundshape{width:140px;}
		.playground-row.playground-heading .teachername{width:48%;}
		.playground-row.playground-heading span{font-weight:400;}
		
		.playground-section.sub_ques-head .sub_ques_title {
			width: 20%;
		}
		.playground-section.sub_ques-head .sub_ques_elem {
			width: 78%;
		}
		.playground-section.sub_ques-head.play-col .sub_ques_title{width: 30%;}
		.playground-section.sub_ques-head.play-col .sub_ques_elem{width: 68%;}
		
		.playground-row.playground-heading .playgroundarea, .playground-row.playground-heading .playgroundlside, .playground-row.playground-heading .schooldistance {
			width: 90px !important;
			position: relative;
   			left:10px
		}
		
		.playground-row.playground-heading .schooldistance {
			width: 150px !important;
		}
		.playground-row.playground-heading span {
			font-size: 12px;
		}
		
		span.star-ques-sr{ 
		position: absolute;
		top: 10px;
    left: 15px;
		} 
		.event-form .star-rating-content .ques label.star-questions { 
			font-weight: bold;
    background: rgb(247 247 247);
    padding: 10px 15px 10px 30px;
    width: 100%;
    letter-spacing: .50px;
    /* border-bottom: 2px solid #a1d3fa; */
    border-radius: 5px;	
		}
		.event-form .star-rating-content .ques label.star-questions-cust{
			padding: 10px 50px 10px 30px;
		}
		.phy-activity {
			display: flex;
			margin-bottom: 15px;
			align-items: left;
		}
		.phy-activity span {
			width: 400px;
    font-weight: normal;
    margin-right: 20px;

		}
		.phy-activity select{cursor:pointer;}
		.fitIndia-radio-col.fitIndia-checkbox-col.fit-no-width{width: auto !important;}
		.fitIndia-radio-col.fitIndia-checkbox-col.check-box-position{
			position: absolute;
			top: 10px;
			right: 0px;
		}
		.declare-col{ 	display:flex; }
		.declare-col span{ margin-top: -4px; }
		.check-box-position.fitIndia-radio-col .fitindia-r.box{ border-color: #000;    margin-top: 5px;}
		.declare-col .fitIndia-radio-col input[type="checkbox"]:checked + .box span { color: white; transform: translateY(2px); }
		.halfwidth{ width:50% ; }
		.sports-row select{ height:150px !important; }
		.achievements textarea{ height:150px; width:100%}
		.playground-row.playground-heading .schoolfitnessid {  width: 35% !important; margin-right: 10px; }
		.playground-row.playground-heading .facility {  width: 48% !important; margin: 0 10px; }
		.playground-row.playground-heading .opento {  width: 48% !important; margin-right: 0 10px; }
		.playground-row.playground-heading .noofstudents {  width: 25% !important; margin-right: 10px; }
		.playground-row.playground-heading .noofassessments {  width: 25% !important;  }
		label {
    display: inline;
    margin-bottom: 0rem;
}

.clear {
    clear: both;
}

.playground-row.playground-heading .teachername {
    width: 46%;
}

.school-ratings-sidebar .event-form .star-rating-content input[type=submit] {
    background-color: #2196f3;
    box-shadow: 0 5px 10px rgba(33,150,243,0.3);
}

.star-rating-content .rating-heading span.default-i:before, .star-rating-content.success .rating-heading span.sucess-i:before, .star-rating-content .rating-heading span.apply-i:before, .star-rating-content .rating-heading span.info-i:before, .star-rating-content.rejected .rating-heading span.reject-i:before {
    font-size: 18px;
    margin-right: 4px;
    position: absolute;
    top: 10px;
    left: 12px;
}

.hidediv{ display:none !important; }
.alert-danger {
	color: #a94442;
    background-color: #f2dede;
    border-color: #ebccd1;
    font-weight: 200;
    padding: .35rem .55rem;
    font-size: .78rem;
}

.event-form input[type=submit] {
    background-color: #2196f3;
    box-shadow: 0 5px 10px rgb(33 150 243 / 30%);
}

.flag-dwn {
    background-color: #4caf50;
    box-shadow: 0 5px 10px rgb(76 175 80 / 30%);
    padding: 10px 20px;
    color: #fff;
    font-size: 14px;
    font-weight: 400;
    border-radius: 100px;
    border: 0px;
    text-transform: uppercase;
    cursor: pointer;
    margin-top: 10px;
    display: table;
    margin-bottom: 10px;
}
.success-msg {
    color: #4caf50;
}

.star-rating-content.success {
    border: 2px solid #ccc;
    background-color: rgba(76,175,80,0.07);
}

.star-rating-content.success .rating-heading span.awarded {
	border-left: 2px solid #ccc;
    border-bottom: 2px solid #ccc;
    color: #4caf50!important;
}

.fitIndia-radio-col input[type="checkbox"]:checked + .box span {
    color: white;
    transform: translateY(-2px);
	font-size: 12px;
}

.fitIndia-radio-col .back-end span:before {
    content: '\2714';
}

.star-rating-content.applied {
    border: 2px solid rgba(33,150,243,0.4);
    background-color: rgba(33,150,243,0.04);
}
span.applied  {
    border: 2px solid #a1d3fa;
    color: #2196f3!important;
}
.info-msg {
    color: #2196f3;
    margin-top: 10px;
}
.sub_flex{
  display: -webkit-box;      /* OLD - iOS 6-, Safari 3.1-6 */
  display: -moz-box;         /* OLD - Firefox 19- (buggy but mostly works) */
  display: -ms-flexbox;      /* TWEENER - IE 10 */
  display: -webkit-flex;     /* NEW - Chrome */
  display: flex;  
  flex-wrap: wrap; 
  justify-content: flex-start;
	
}
.flex-1{
	display: -webkit-box;      /* OLD - iOS 6-, Safari 3.1-6 */
  display: -moz-box;         /* OLD - Firefox 19- (buggy but mostly works) */
  display: -ms-flexbox;      /* TWEENER - IE 10 */
  display: -webkit-flex;     /* NEW - Chrome */
  display: flex;  
}
.flex-1 div:first-child{
	margin-right: 15px;width:30%;
}
.sub_flex1{
	display: -webkit-box;      /* OLD - iOS 6-, Safari 3.1-6 */
  display: -moz-box;         /* OLD - Firefox 19- (buggy but mostly works) */
  display: -ms-flexbox;      /* TWEENER - IE 10 */
  display: -webkit-flex;     /* NEW - Chrome */
  display: flex;  
 
  justify-content: flex-start;
}
.sub_flex1 .sub_flex_first2{
	width:42%;
	padding-top: 4px;
}
.sub_flex1 .sub_flex_first{
	width:15%;
}
.sub_flex div:first-child{
	width:40%;
}
.sub_flex div:last-child{
	width:60%;
}
.sub_ques_elem ul{list-style: none;padding:0;}
.sub_ques_elem ul li:first-child{
	margin: 0;
}
.sub_ques_elem ul li{ 
	display: inline-block;margin: 5px;padding: 5px 10px;font-weight: 300;
    background: #eee;border-radius: 100px;}

.check_div.check-box-position {
    position: absolute;
    top: 30px;
    left: 0px;
	padding-left:60px;
}
.um-field-area a:hover{color:#fff;}
.um-field-area a{display:inline-block;margin-right:15px;}
.sub_ques-head {margin-left:0;align-items: center;}
.playground-heading{margin-top:7px;margin-bottom:7px;}
/* .fitIndia-checkbox-col{margin:5px 0;} */
.playgroundno {
    top: -8px;
    width: 20px;
    position: relative;
}
.top_head{background:#eee;    background: #eee;
    padding: 5px 10px;
}
.facility{width:100%;margin-bottom:10px;}
.opento{width:100%;margin-bottom:10px;}

.border_btootm{
	margin-top: 15px;
border-bottom: 1px solid #a29e9e;}
.border_btootm img{margin-top:15px;}
/* .check_div>label{padding-left:50px!important;} */
/* .check_div_inner{
	position: absolute;
    top: 9px!important;
    left: 25px;
} */
.sports-row{margin-top:15px;}
.field_w{width:150px;}
@media (max-width: 991px){
.container, .container-lg, .container-md, .container-sm {
    max-width: 960px;
}
}
@media (max-width: 767px) {

	.star-rating-content { padding: 10px 10px 10px 10px;}
	.event-form .um-field {
    padding-top: 0;
}
.sub_flex div:last-child {
    width: auto;
	margin-right:10px;
	
}
.sub_flex div:first-child {
    width: auto;
	margin-right: 15px;
}
.sub_flex {
   
    align-items: center;
}
.sub_ques_elem ul{margin-bottom:0;}
.playground-section.sub_ques-head.play-col .sub_ques_title {
    width: auto;
}
.playground-section.sub_ques-head .sub_ques_title {
    width: auto;
}
.playground-section.sub_ques-head.play-col .sub_ques_elem {
    width: auto;
}
.halfwidth {
    width: 100%;
}
.sports-row{margin-top:15px;}

.mobile_flex_3{display:flex;}

.sp_id {
   
    padding: 0 0;
    width: 100%;
	
	margin-top:10px;
}
.sp_id2{height:20px;}
.input_block{display:block!important;}


.fitIndia-radio-col.fitIndia-checkbox-col{flex-wrap: nowrap;}
.flag-dwn {
   
    width: 100%;
    text-align: center;
}
#playgroundrow{flex-direction: column;}
.phy-activity{display: flex;
    flex-direction: column;
align-items: left;
text-align:left;
}



.phy-activity span {
     width: auto;;   
    text-align: left!important;
}



}

@media (max-width: 500px) {
	.sub_flex1{display:block;}
	.sub_flex1 .sub_flex_first { width: 100%;}

.ml-4{margin-left:0!important;}
.sub_ques_elem input[type="number"].fit-pe-inputs {
    width: 100%;
}
dl, ol, ul {
    padding:10px;
}
.field_w{width:100%;}
.um-field-area a {
    text-align:center;
    margin-right: 0;
}
.flag-dwn{width:100%;}
.flex-1{display: block;}
.flex-1 div:first-child{width:100%;}

}

.img_fit_obj{
	object-fit:cover;
}

.tb_cust_width{width:175px;}

.resTable table, th, td {
    border: 0px solid #000; 
    vertical-align: top;
}
.resTable{width:100%}
.resTable table {
    border: 1px solid #ccc;
    border-collapse: collapse;
    margin: 0;
    padding: 0;
    table-layout: fixed;
    width: 100%;
  }
  
  .resTable table tr {
    background-color: #f8f8f800;
    border: 1px solid #ddd;
    padding: .35em;
  }
  
  .resTable table th,
  .resTable table td {
    padding: .625em;
    text-align: center;

 
}
  @media screen and (max-width: 600px) {
	  .sub_flex1{flex-direction: column;}
    .resTable table thead {
      border: none;
      clip: rect(0 0 0 0);
      height: 1px;
      margin: -1px;
      overflow: hidden;
      padding: 0;
      position: absolute;
      width: 1px;
	  
    }
	#outdoorsportsrow{display:flex;}
    .event-form .star-rating-content .ques label.star-questions {
 
    padding: 10px 20px 10px 30px;}
    /* .resTable table tr {
      border-bottom: 3px solid #ddd;
      display: block;
    } */

	.event-form .star-rating-content .ques label.star-questions-cus {
 
 padding: 10px 54px 10px 30px;}

 
	.resTable table tr {
		border: 0px solid #ddd; 
     	padding: .0em; 
		border-bottom: 10px solid #2196f3;
		display: block;
		margin-bottom: 10px;
}

.resTable table tr {
    background-color: #f8f8f800;
   
}
    
    .resTable table td {
      border-bottom: 1px solid #ddd;
      display: block;
      text-align: right;
    }
    
    .resTable table td::before {
      content: attr(data-label);
      float: left;
    }
	.sub_ques_elem input[type="number"].fit-pe-inputs {
    width: 100%;
}
.fitIndia-radio-col.fitIndia-checkbox-col {
    display: inline-flex;
    flex-wrap: nowrap;
  }
}

		</style>
		<script>
		function othersportspop(elem,cont){
			var opts = [];
			
			for (var i=0, len=elem.options.length; i<len; i++) {
				if (elem.options[i].selected) {
					 opts.push(elem.options[i].value);
				}
			}
			
			var chk = opts.includes("Any other sport including indigenous games");
			var text = document.getElementById(cont);

			if (chk){
				text.style.display = "block";
			} else {
				text.style.display = "none";
			}
		}
		
		

		function othersports(cont, chkbox){
			var checkBox = document.getElementById(chkbox);
			var text = document.getElementById(cont);

			if (checkBox.checked == true){
				text.style.display = "block";
			} else {
				text.style.display = "none";
			}
  
		}
		
		function peteacher(num,elem){
			if(num && num > 0 && num <= 50){
					var i = 1; var text ='';
					text +='<div class="sub_ques_title"> Name of teachers </div>';
					text +='<div class="sub_ques_elem">'; 
						while (i <= num) {
						  text += "<div class='peteachernames-col'><span>"+i+". </span>"+"<input type='text' name='peteachernames[]' class='peteachernames' /></div>";
						  i++;
						}  
					text +='<div class="clear"></div></div><div class="clear"></div>';
					document.getElementById("peteachernamerow").innerHTML = text;
					document.getElementById("peteachernamerow").style.display = "block";
					
					text = null;
					i= null;
			}else if(num && num > 50){	
				elem.value = 0;
				document.getElementById("peteachernamerow").innerHTML = '';
				document.getElementById("peteachernamerow").style.display = "none";
				
				alert('No. of Teachers trained in Physical Education must not be greater than 50');
					
			}else{
				document.getElementById("peteachernamerow").innerHTML = '';
				document.getElementById("peteachernamerow").style.display = "none";
			}
			
		}		
		 
		function playground(num,elem){
			 		 
			if(num && num > 0 && num <= 20){
				var i = 1; var text ='';
				text +='<div class="sub_ques_title"> Playgrounds </div>';
				
				text += '<div class="resTable"><table><thead><tr><th scope="col" class="tb_cust_width">Choose Shape</th><th scope="col">Area (sqft)</th><th scope="col">Longest Side (ft)</th><th scope="col" class="tb_cust_width">Distance from School(Km)</th><th scope="col">Ground Image</th></tr></thead><tbody>';
					while (i <= num) {
						
						text += "<tr>";
						
						text += "<td data-label='Choose Shape'><div class='playgroundshape'>" +" <div class='fitIndia-radio-col'> <label><input type='radio' name='playgroundshape["+(i-1)+"]' value='square' /><div class='front-end fitindia-r box fit-radio1'><span></span></div></label> <label><input type='radio' name='playgroundshape["+(i-1)+"]' value='circle' /><div class='back-end fitindia-r box fit-radio2'><span></span></div></label>   <label><input type='radio' name='playgroundshape["+(i-1)+"]' value='Quadrilateral' /><div class='back-end fitindia-r box fit-radio3'><span></span></div></label> </div>  "+"</div></td>";
						
						text += "<td data-label='Area (sqft)'><div class='playgroundarea'>" +"<input type='text' name='playgroundarea[]' class='playgroundarea' />"+"</div></td>";
						text += "<td data-label='Longest Side (ft)'><div class='playgroundlside'>" +"<input type='text' name='playgroundlside[]' class='playgroundlside' />"+"</div></td>";
						
						text += "<td data-label='Distance from School(Km)'><div class='schooldistance'>" +"<select name='schooldistance[]' class='schooldistance'><option value=''>Please Select</option><option>Within School</option><option>Within 500 mts</option><option>Beyond 500 mts</option></select>"+"</div></td>";
						text += "<td data-label='Ground Image'>  <input name='playgroundimg["+(i-1)+"]' type='file'/> </td>";
						
						text += "</tr>";
					  i++;
					  
					}  
				text +='</tbody></table></div><div class="clear"></div>';
				document.getElementById("playgroundrow").innerHTML = text;
				text = null;
				i= null;
				document.getElementById("playgroundrow").style.display = "block";
				document.getElementById("outdoorsportsrow").style.display = "block";
				
			}else if(num && num > 20){
				elem.value = 0;
				document.getElementById("playgroundrow").innerHTML = '';
				document.getElementById("playgroundrow").style.display = "none";
				document.getElementById("outdoorsportsrow").style.display = "none";
				alert('No. of Playgrounds must not be greater than 20');
			}else{
				document.getElementById("playgroundrow").innerHTML = '';
				document.getElementById("playgroundrow").style.display = "none"; 
				document.getElementById("outdoorsportsrow").style.display = "none";
			}
			
			
			
		 }
		 
		
		 
		 function trainedteachernofn(num,elem){
			if(num && num > 0 && num <= 20){
				var i = 1; var text ='';
				var sports = [ 'Archery', 'Athletics', 'Badminton', 'Basketball', 'Boxing', 'Canoeing', 'Cricket', 'Cycling', 'Fencing', 'Football', 'Gymnastics', 'Handball', 'Hockey', 'Judo', 'Kabaddi', 'Karate', 'Kayaking', 'Kho Kho', 'Lawn Tennis', 'Rowing', 'Sepaktakraw', 'Shooting', 'Softball', 'Swimming', 'Table Tennis', 'Taekwondo', 'Volleyball', 'Weightlifting', 'Wrestling', 'Wushu' ];
				
				text +='<div class="resTable">'; 
				text += '<table><thead><tr><th scope="col">Teacher/Coach Name</th><th scope="col">Sport 1</th><th scope="col">Sport 2</th></tr></thead><tbody>';
					while (i <= num) {
						
						text += "<tr>";
						text += '<td data-label="Teacher/Coach Name">' + " <input type='text' name='trainedteachername["+i+"]' placeholder='Teacher/Coach Name' /> "+"</td>";
						
						text += '<td data-label="Sport 1">' +"<select name='sportsone["+i+"]' class='schooldistance'><option value=''>Please Select</option>";
						j=0;
						while(j < sports.length){
							text +="<option>"+sports[j]+"</option>";
							j++;
						}
						text +="</select>"+"</td>";
						
						text += '<td data-label="Sport 1">' +"<select name='sporttwo["+i+"]' class='schooldistance'><option value=''>Please Select</option>";
						j=0;
						while(j < sports.length){
							text +="<option>"+sports[j]+"</option>";
							j++;
						}
						text +="</select>"+"</td>";
						text += "</tr>";
					  i++;
					}  
				text +='</tbody></table></div>';
				document.getElementById("trainedteacherrow").innerHTML = text;
				text = null;
				i= null;
				sports = null;
				document.getElementById("trainedteacherrow").style.display = "block";
			}else if(num && num > 20){
				elem.value = 0;
				document.getElementById("trainedteacherrow").innerHTML = '';
				document.getElementById("trainedteacherrow").style.display = "none";
				alert('No. of trained teachers must not be greater than 20');
			}else{
				document.getElementById("trainedteacherrow").innerHTML = '';
				document.getElementById("trainedteacherrow").style.display = "none"; 
			}
		 }
		 
		 function sportscoachnos(num,elem){
			if(num && num > 0 && num <= 20){
				var i = 1; var text ='';
				var sports = [ 'Archery', 'Athletics', 'Badminton', 'Basketball', 'Boxing', 'Canoeing', 'Cricket', 'Cycling', 'Fencing', 'Football', 'Gymnastics', 'Handball', 'Hockey', 'Judo', 'Kabaddi', 'Karate', 'Kayaking', 'Kho Kho', 'Lawn Tennis', 'Rowing', 'Sepaktakraw', 'Shooting', 'Softball', 'Swimming', 'Table Tennis', 'Taekwondo', 'Volleyball', 'Weightlifting', 'Wrestling', 'Wushu' ];
				
				text +='<div class="resTable">'; 
				text += '<table><thead><tr><th scope="col">Coach Name</th><th scope="col">Sports</th></tr></thead><tbody>';
					while (i <= num) {
						
						text += '<tr>';
						text += '<td data-label="Coach Name"><div class="teachername">';
						
						text += " <input type='text' name='sportscoachname[]' placeholder='Coach Name' />"+"</div></td>";
						
						text += '<td data-label="Sports"><div class="schooldistance">' +"<select name='coachsports[]' class='schooldistance'><option value=''>Please Select</option>";
						j=0;
						while(j < sports.length){
							text +="<option>"+sports[j]+"</option>";
							j++;
						}
						text +="</select>";
						text += "</div></td></tr>";
					  i++;
					}  
				text +='</tbody></table></div>';
				document.getElementById("sportscoachrow").innerHTML = text;
				text = null;
				i= null;
				sports = null;
				document.getElementById("sportscoachrow").style.display = "block";
			}else if(num && num > 20){
				elem.value = 0;
				document.getElementById("sportscoachrow").innerHTML = '';
				document.getElementById("sportscoachrow").style.display = "none"; 
				alert('No. of Sports Coaches must not be greater than 20');
			}else{
				document.getElementById("sportscoachrow").innerHTML = '';
				document.getElementById("sportscoachrow").style.display = "none"; 
			}
		 }
		 
		
		</script>
		
@endsection
