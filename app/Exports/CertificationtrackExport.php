<?php
namespace App\Exports;
use App\Models\Eventorganizations;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CertificationtrackExport implements FromCollection, WithHeadings
{
    public function collection(){
        
        if(request()->has('report')){

            $records = DB::table('certification_trackings')                        
                        // ->where([                            
                        //     ['user_type', '=', 'organiser']
                        // ])
                        ->select(
                            'certification_trackings.name',
                            'certification_trackings.user_type',
                            'certification_trackings.event_name',
                            'certification_trackings.event_participant_certification_name',
                            'certification_trackings.created_at',
                            )
                        ->get();
            dd($records);            
            return $records;        
        }


    }
   
    public function headings(): array{

        if(request()->has('report')){    
            
            return[
            
                'Name',
                'User Type',
                'Event Name',
                'Event Participant Certification Name',
                'Created at'
            
            ];
        }
    }

}