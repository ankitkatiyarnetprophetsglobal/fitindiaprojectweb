<?php
namespace App\Exports;
use App\Models\Eventorganizations;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Fiw2024Export implements FromCollection, WithHeadings
{
    public function collection(){
        
        if(request()->has('registrationcyfiw-2024')){

            $records = DB::table('users')                        
                        ->where([
                            ['users.created_at', '>', '2024-11-15 00:00:01'],
                            ['role', '!=', 'namo-fit-india-cycling-club'],
                            ['role', '!=', 'namo-fitIndia-club'],
                        ])
                        ->get([                                                            
                            DB::raw('count(1) as count'),
                        ]);
            return $records;
        
        }elseif(request()->has('reportrolewisecyfiw-2024')){            
        
            $records = DB::table('users')
                            ->where([
                                ['users.created_at', '>', '2024-11-15 00:00:01'],
                                ['role', '!=', 'namo-fit-india-cycling-club'],
                                ['role', '!=', 'namo-fitIndia-club'],
                                ['role', '!=', '']
                            ])
                            ->groupBy(DB::raw('case when rolelabel is null then role else rolelabel end'))
                            ->get([                                                            
                                DB::raw('case when users.rolelabel is null then users.role else users.rolelabel end as countname'),
                                DB::raw('count(1) as countnumber'),
                            ]);

                return $records;
        }elseif(request()->has('reportdatewisefiw-2024')){

            $records = DB::table('users')
                            ->where([
                                ['users.created_at', '>', '2024-11-15 00:00:01'],
                                ['role', '!=', 'namo-fit-india-cycling-club'],
                                ['role', '!=', 'namo-fitIndia-club'],
                                ['rolewise', '!=', 'cyclothon-2024'],
                                ['role', '!=', 'cyclothon-2024'],
                                ['role', '!=', '']
                            ])
                            ->groupBy(DB::raw('case when rolelabel is null then role else rolelabel end,cast(created_at as date)'))
                            ->get([                                                            
                                DB::raw('case when rolelabel is null then role else rolelabel end as rolename'),
                                DB::raw('cast(created_at as date) as date'),
                                DB::raw('count(1) as count_number'),
                            ]);
                return $records;
        
        }elseif(request()->has('reportwithimagefiw-2024')){

            $records = DB::table('event_organizations')
                            ->where("event_organizations.category",'=', 13076)
                            ->orderBy('event_organizations.id', 'desc')                            
                            ->get([                                
                                DB::raw('event_organizations.organiser_name, event_organizations.name, event_organizations.email, event_organizations.contact, event_organizations.eventstartdate, event_organizations.eventenddate,        
                                        event_organizations.event_bg_image, event_organizations.eventimg_meta, event_organizations.excel_sheet, IFNULL(event_organizations.participantnum, 0) as participantnum'),
                            ]);
                
            return $records;
        
        }elseif(request()->has('reportstatewisefiw-2024')){

            $records = DB::table('users')
                            ->join('usermetas', 'usermetas.user_id', '=', 'users.id')
                            ->where([
                                ['users.created_at', '>', '2024-11-15 00:00:01'],
                                ['role', '!=', 'namo-fit-india-cycling-club'], 
                                ['role', '!=', 'namo-fitIndia-club'],                               
                                ['state', '!=', ''],
                                // ['event_organizations.category', '=', '13076']
                            ])
                            // ->where("users.created_at",'>',"2024-09-27 00:00:01")
                            // ->join('event_organizations', 'usermetas.user_id', '=', 'event_organizations.user_id')
                            // ->whereNotNull('usermetas.state')
                            // ->where("event_organizations.category",'=', 13076)
                            ->orderBy('usermetas.state', 'asc')
                            ->groupBy('usermetas.state')
                            ->get([                                                            
                                DB::raw('usermetas.state'),
                                DB::raw('count(1) as count_number'),
                            ]);
                // dd($records);
                return $records;

        }


    }
   
    public function headings(): array{

        if(request()->has('registrationcyfiw-2024')){    
            
            return[
            
                'Registration Count'
            
            ];
        }else if(request()->has('reportrolewisecyfiw-2024')){    
            
            return[

                'Role','Count'

            ];
        }elseif(request()->has('reportdatewisefiw-2024')){

            return[
                'Role','Date','Count',
            ];        
        }elseif(request()->has('reportwithimagefiw-2024')){

            return[

                'Organiser Name', 'Name', 'Email', 'Contact', 'Event Start Date', 'Event End Date', 'Event BG Image', 'Eventimg Meta', 'Excel Sheet', 'Participant Num',

            ];
        
        }elseif(request()->has('reportstatewisefiw-2024')){

            return[

                'State','Count',
            
            ];

        }
    }

}