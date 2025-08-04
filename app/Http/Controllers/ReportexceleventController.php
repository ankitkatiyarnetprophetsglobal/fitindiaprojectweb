<?php

namespace App\Http\Controllers;
use App\Models\SchoolWeek;
use App\Models\Eventorganizations;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request,Response;
use App\Models\DeletedUsers;
use App\Models\User;
use Excel;
use App\Exports\EventorganizationsExport;
use App\Exports\CyclingeventExport;
use App\Exports\Fiw2024Export;
use App\Exports\FitindiaclubExport;
use App\Exports\CertificationtrackExport;
use App\Exports\CyclothonExport;
use App\Models\EventCat;

class ReportexceleventController extends Controller
{    
    
    public function getallevent(){
        $query = "SELECT * FROM event_cats where status = '2'";
        $data = DB::select(DB::raw($query));
        foreach ($data as $x => $y) {
            echo $y->id;
            echo "         ";
            echo $y->name;
            echo '<br>';
          }
        dd($data);
    }

    public function registration_count(){ 
        
        try{
            if(request()->has('reportrolewise')){

                return Excel::download(new EventorganizationsExport,'Role Wise User Registration.xlsx');

            }else if(request()->has('reportdatewise')){

                return Excel::download(new EventorganizationsExport,'Registration Report Date Wise.xlsx');
                
            }else if(request()->has('reportstatewise')){
                
                return Excel::download(new EventorganizationsExport,'Report State Wise.xlsx');

            }else if(request()->has('reportwithimage')){
                
                return Excel::download(new EventorganizationsExport,'Report With Image.xlsx');
            
            }else if(request()->has('registrationcount')){

                return Excel::download(new EventorganizationsExport,'Registration Count.xlsx');

            }else{

                dd('No Report');

            }

        }catch (Exception $e) {

            return abort(404);
        
        }
    } 
    
    public function registration_cycling_event(){ 
        
        try{
            
            if(request()->has('registrationcyclingevent')){

                return Excel::download(new CyclingeventExport,'Cling Event Registration Count.xlsx');

            }else if(request()->has('reportrolewisecyclingevent')){

                return Excel::download(new CyclingeventExport,'Cling Event Role Wise User Registration.xlsx');

            }else if(request()->has('reportdatewisecyclingevent')){
                
                return Excel::download(new CyclingeventExport,'Cling Event Registration Report Date Wise.xlsx');
            
            }else if(request()->has('reportwithimagecyclingevent')){
                
                return Excel::download(new CyclingeventExport,'Cling Event Report With Image.xlsx');
            
            }else if(request()->has('reportstatewisecyclingevent')){
                
                return Excel::download(new CyclingeventExport,'Cling Event Report State Wise.xlsx');

            }

        }catch (Exception $e) {

            return abort(404);
    
        }        
    } 
        
    public function excelregistrationfiw2024(){ 
        
        try{
            
            if(request()->has('registrationcyfiw-2024')){

                return Excel::download(new Fiw2024Export,'Fit India week 2024 Registration Count.xlsx');

            }else if(request()->has('reportrolewisecyfiw-2024')){

                return Excel::download(new Fiw2024Export,'Fit India week 2024 Role Wise User Registration.xlsx');

            }else if(request()->has('reportdatewisefiw-2024')){
                
                return Excel::download(new Fiw2024Export,'Fit India week 2024 Registration Report Date Wise.xlsx');
            
            }else if(request()->has('reportwithimagefiw-2024')){
                
                return Excel::download(new Fiw2024Export,'Fit India week 2024 Report With Image.xlsx');
            
            }else if(request()->has('reportstatewisefiw-2024')){
                
                return Excel::download(new Fiw2024Export,'Fit India week 2024 Report State Wise.xlsx');

            }

        }catch (Exception $e) {

            return abort(404);
    
        }        
    } 
    
    public function excelregistrationnamofitindiaclub(){ 
        
        try{
            
            if(request()->has('registrationcynamofitIndiaclub')){

                return Excel::download(new FitindiaclubExport,'Fit India Club Registration Count.xlsx');

            }else if(request()->has('reportrolewisecynamofitIndiaclub')){

                return Excel::download(new FitindiaclubExport,'Fit India Club Role Wise User Registration.xlsx');

            }else if(request()->has('reportdatewisenamofitIndiaclub')){
                
                return Excel::download(new FitindiaclubExport,'Fit India Club Registration Report Date Wise.xlsx');
            
            }else if(request()->has('reportwithimagefitIndiaclub')){
                
                return Excel::download(new FitindiaclubExport,'Fit India Club Report With Image.xlsx');
            
            }else if(request()->has('reportstatewisefitIndiaclub')){
                
                return Excel::download(new FitindiaclubExport,'Fit India Club Report State Wise.xlsx');

            }

        }catch (Exception $e) {

            return abort(404);
    
        }        
    }
    
    public function excelallreport(Request $request){ 

        // dd($request->all());

        $categories = EventCat::where('status',2)->orderBy('id', 'DESC')->get();
        // dd($categories);
        return view('event.excelfitindiaweekreportcopy', [
            'categories' => $categories
        ]);
        // $date_from = date('Y-m-d', strtotime($request->date_from));
        // $date_to = date('Y-m-d', strtotime($request->date_to));

    }
    
    public function certification_trackings_tracking(Request $request){ 
        // dd("done2");
        if(request()->has('report')){
            // dd("done");
            return Excel::download(new CertificationtrackExport,'Certification Trackings Tracking.xlsx');

        }
    }
    
    public function registration_cyclothon2024(Request $request){ 
        // dd("done2");
        if(request()->has('allreortilldate')){
            // dd("done");
            return Excel::download(new CyclothonExport,'Excel Registration Cyclothon2024.xlsx');

        }
    }
    
}
