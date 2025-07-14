<?php
namespace App\Http\Controllers\Api;
use App\Models;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request,Response;
use Illuminate\Support\Facades\Validator;
use App\Models\ArchiveRole;
use App\Models\EventArchive;
use Illuminate\Support\Facades\DB;

class EventArchiveController extends Controller
{	
	 public function eventarchive(Request $request){

        //dd($request);		 
	    		 
		 try { 		   
	   
			$data = EventArchive::leftJoin('archive_role','archive_role.archive_id', '=', 'event_archive.id')			
					 ->select(['event_archive.*']);
					
			if($request->role_id){				
			   
			   $data = $data->where('archive_role.role_id', $request->role_id);
			}
			
			if(!empty($request->archid)){			
			 
			  $data = $data->where('event_archive.id', $request->archid);
			}	

            if($request->language){
				
			   $data = $data->where('event_archive.language', 'like', '%'.$request->language.'%');
			}			
				
			if($request->name){
				
			   $data = $data->where('event_archive.title', 'like', '%'.$request->name.'%');
			}			
									  
		    //$archive=$data->where('event_archive.status','=','Active')->orderBy('title','ASC')->groupBy('event_archive.id')->get();	
		    $archive=$data->where('event_archive.status','=','Active')->orderBy('priority','ASC')->groupBy('event_archive.id')->get();						
			
			$event_archive=array();
		 
		    if(!empty($archive)){
				
			   foreach($archive as $cval){

                 $archrole  = DB::table('archive_role')
				                ->leftJoin('roles', 'roles.id', '=', 'archive_role.role_id')
								->where('archive_id', $cval->id)	
								->get();

                if(!empty($archrole)){
				$archiverole=array();
				  foreach($archrole as $rol){					  
					 $roldata=array(
						"roleid" => $cval->id,
						"role" => $rol->name						
					);

                    array_push($archiverole,$roldata);					
				  }
				}								
               
               	 $achdata=array(
						"id" => $cval->id,
						"name" => $cval->title,
						"poster_image" => $cval->poster_image,
						"link" => $cval->link,
						"language" => $cval->language,
						"role_name" => $archiverole,
						"start_date" => $cval->start_date,
						"end_date" => $cval->end_date,												
						"status" => $cval->status
					);
					
				  array_push($event_archive,$achdata);	
			    }				
			}
			
			/* $New_start_index = 1;
  
            $event_archive = array_combine(range($New_start_index,count($event_archive) + ($New_start_index-1)), array_values($event_archive));
			*/
			if(!empty($event_archive)){
			  return Response::json(array(
				'status'    => 'success',
				'code'      =>  200,
				'message'   => $event_archive, 
			  ), 200);
			  
			} else {
				
			  return Response::json(array(
				'status'    => 'error',
				'code'      =>  404,
				'message'   => 'Data not found.', 
			  ), 404);					
			}			
			
		} catch(Exception $e){ 
		   
			return Response::json(array(
					'status'    => 'error',
					'code'      =>  404,
					'message'   =>  'Unauthorized : '.$e->getmessage()
				), 404);
		}			
	}
	
	public function eventarchivevone(Request $request){   
	    		 
		try { 		   
	   
			$data = EventArchive::leftJoin('archive_role','archive_role.archive_id', '=', 'event_archive.id')			
					 ->select(['event_archive.*']);
			
			if($request->role_id){
				
			   $data = $data->where('archive_role.role_id', $request->role_id);
			//    print_r(DB::getQueryLog());
			
			}
			
			if(!empty($request->archid)){			
				// dd(13246);	
			  $data = $data->where('event_archive.id', $request->archid);
			}	
			
            if($request->language){
				// dd($request->language);
				// $data = $data->where('event_archive.language', 'like', '%'.$request->language.'%');				
				// $data = $data->where('event_archive.language', 'like', $request->language.'%');				
				// $data = $data->where('event_archive.language', '=', $request->language)->get();
				switch ($request->language) {
					case "en":
						// echo 'English';
						$data = $data->where('event_archive.language', '=', 'English');	
					break;

					case "hi":
						// echo 'Hindi';
						$data = $data->where('event_archive.language', '=', 'Hindi');	
					break;					

					default:
						// echo 'no value';
						$data = $data->where('event_archive.language', '=', 'English');	
				}
				// exit;
				// dd($data);
			}			
			
			if($request->name){
				
				$data = $data->where('event_archive.title', 'like', '%'.$request->name.'%');
				// dd($request->name);
			}			
									  
		    //$archive=$data->where('event_archive.status','=','Active')->orderBy('title','ASC')->groupBy('event_archive.id')->get();	
			// dd($data);
		    $archive=$data->where('event_archive.status','=','Active')->orderBy('priority','ASC')->groupBy('event_archive.id')->get();						
		    // $archive=$data->where('event_archive.status','=','Active')->orderBy('priority','ASC')->get();						
			// dd($archive);
			$event_archive=array();
		 
		    if(!empty($archive)){
				
			   foreach($archive as $cval){

                 $archrole  = DB::table('archive_role')
				                ->leftJoin('roles', 'roles.id', '=', 'archive_role.role_id')
								->where('archive_id', $cval->id)	
								->get();

                if(!empty($archrole)){
				$archiverole=array();
				  foreach($archrole as $rol){					  
					 $roldata=array(
						"roleid" => $cval->id,
						"role" => $rol->name						
					);

                    array_push($archiverole,$roldata);					
				  }
				}								
               
               	 $achdata=array(
						"id" => $cval->id,
						"name" => $cval->title,
						"poster_image" => $cval->poster_image,
						"link" => $cval->link,
						"language" => $cval->language,
						"role_name" => $archiverole,
						"start_date" => $cval->start_date,
						"end_date" => $cval->end_date,												
						"status" => $cval->status
					);
					
				  array_push($event_archive,$achdata);	
			    }				
			}
			
			/* $New_start_index = 1;
  
            $event_archive = array_combine(range($New_start_index,count($event_archive) + ($New_start_index-1)), array_values($event_archive));
			*/
			if(!empty($event_archive)){
			  return Response::json(array(
				'status'    => 'success',
				'code'      =>  200,
				'story_view'=>	'1',
				'abha_view'=>	'0',
				'message'   => $event_archive, 
			  ), 200);
			  
			} else {
				
			  return Response::json(array(
				'status'    => 'error',
				'code'      =>  404,
				'message'   => 'Data not found.', 
			  ), 404);					
			}			
			
		} catch(Exception $e){ 
		   
			return Response::json(array(
					'status'    => 'error',
					'code'      =>  404,
					'message'   =>  'Unauthorized : '.$e->getmessage()
				), 404);
		}			
	}
	
 }