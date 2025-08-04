<?php
namespace App\Exports;
use App\Models\Eventorganizations;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FitindiaclubExport implements FromCollection, WithHeadings
{
    public function collection(){
        
        if(request()->has('registrationcynamofitIndiaclub')){

            $records = DB::table('users')                        
                        ->where([
                            ['users.created_at', '>', '2024-11-15 00:00:01'],
                            ['role', '=', 'namo-fitIndia-club']
                        ])
                        ->get([                                                            
                            DB::raw('count(1) as count'),
                        ]);
            return $records;
        
        }elseif(request()->has('reportrolewisecynamofitIndiaclub')){            
        
            $records = DB::table('users')
                            ->where([
                                ['users.created_at', '>', '2024-11-15 00:00:01'],
                                ['role', '=', 'namo-fitIndia-club'],
                                ['role', '!=', '']
                            ])
                            ->groupBy(DB::raw('case when rolelabel is null then role else rolelabel end'))
                            ->get([                                                            
                                DB::raw('case when users.rolelabel is null then users.role else users.rolelabel end as countname'),
                                DB::raw('count(1) as countnumber'),
                            ]);

                return $records;
        }elseif(request()->has('reportdatewisenamofitIndiaclub')){

            $records = DB::table('users')
                            ->where([
                                ['users.created_at', '>', '2024-11-15 00:00:01'],
                                ['role', '=', 'namo-fitIndia-club'],
                                ['role', '!=', '']
                            ])
                            ->groupBy(DB::raw('case when rolelabel is null then role else rolelabel end,cast(created_at as date)'))
                            ->get([                                                            
                                DB::raw('case when rolelabel is null then role else rolelabel end as rolename'),
                                DB::raw('cast(created_at as date) as date'),
                                DB::raw('count(1) as count_number'),
                            ]);
                return $records;
        
        }elseif(request()->has('reportwithimagefitIndiaclub')){

            $records = DB::table('event_organizations')
                            ->where("event_organizations.category",'=', 13077)
                            ->orderBy('event_organizations.id', 'desc')                            
                            ->get([                                
                                DB::raw('event_organizations.organiser_name, event_organizations.name, event_organizations.email, event_organizations.contact, event_organizations.eventstartdate, event_organizations.eventenddate,        
                                        event_organizations.event_bg_image, event_organizations.eventimg_meta, event_organizations.excel_sheet, IFNULL(event_organizations.participantnum, 0) as participantnum'),
                            ]);
                
            return $records;
        
        }elseif(request()->has('reportstatewisefitIndiaclub')){

            $records = DB::table('users')
                            ->join('usermetas', 'usermetas.user_id', '=', 'users.id')
                            ->where([
                                ['users.created_at', '>', '2024-11-15 00:00:01'],
                                ['role', '=', 'namo-fitIndia-club'],                                
                                ['state', '!=', ''],
                                // ['event_organizations.category', '=', '13077']
                            ])
                            // ->where("users.created_at",'>',"2024-09-27 00:00:01")
                            // ->join('event_organizations', 'usermetas.user_id', '=', 'event_organizations.user_id')
                            // ->whereNotNull('usermetas.state')
                            // ->where("event_organizations.category",'=', 13077)
                            ->orderBy('usermetas.state', 'asc')
                            ->groupBy('usermetas.state')
                            ->get([                                                            
                                DB::raw('usermetas.state'),
                                DB::raw('count(1) as count_number'),
                            ]);
                // dd($records);
                return $records;

        }else if(request()->has('registrationcountcyclothon2024')){
            // dd(4);
            $records = DB::table('users')                        
                        ->where([
                            ['users.created_at', '>', '2024-12-04 00:00:01'],
                            ['role', '=', 'cyclothon-2024']
                        ])
                        ->get([                                                            
                            DB::raw('count(1) as count'),
                        ]);
            return $records;
        
        }elseif(request()->has('reportrolewisecyclothon2024')){            
        
            $records = DB::table('users')
                            ->where([
                                ['users.created_at', '>', '2024-12-04 00:00:01'],
                                ['role', '=', 'cyclothon-2024'],
                                ['role', '!=', '']
                            ])
                            ->groupBy(DB::raw('case when rolelabel is null then role else rolelabel end'))
                            ->get([                                                            
                                DB::raw('case when users.rolelabel is null then users.role else users.rolelabel end as countname'),
                                DB::raw('count(1) as countnumber'),
                            ]);

                return $records;
        }elseif(request()->has('reportdatewisecyclothon2024')){

            $records = DB::table('users')
                            ->where([
                                ['users.created_at', '>', '2024-12-04 00:00:01'],
                                ['role', '=', 'cyclothon-2024'],
                                ['role', '!=', '']
                            ])
                            ->groupBy(DB::raw('case when rolelabel is null then role else rolelabel end,cast(created_at as date)'))
                            ->get([                                                            
                                DB::raw('case when rolelabel is null then role else rolelabel end as rolename'),
                                DB::raw('cast(created_at as date) as date'),
                                DB::raw('count(1) as count_number'),
                            ]);
                return $records;
        
        }elseif(request()->has('reportwithimagecyclothon2024')){

            $records = DB::table('event_organizations')
                            ->join('usermetas','usermetas.user_id', '=','event_organizations.user_id')
                            ->where("event_organizations.category",'=', 13078)
                            ->orderBy('event_organizations.id', 'desc')                            
                            ->get([                                
                                DB::raw('event_organizations.organiser_name, event_organizations.name, event_organizations.email, event_organizations.contact, event_organizations.eventstartdate, event_organizations.eventenddate,        
                                        event_organizations.event_bg_image, event_organizations.eventimg_meta, event_organizations.excel_sheet, IFNULL(event_organizations.participantnum, 0) as participantnum, event_organizations.state'),
                            ]);
                
            return $records;
        
        }elseif(request()->has('reportstatewisecyclothon2024')){
            // dd(9999);
            $records = DB::table('users')
                            ->join('usermetas', 'usermetas.user_id', '=', 'users.id')
                            ->where([
                                ['users.created_at', '>', '2024-12-04 00:00:01'],
                                ['role', '=', 'cyclothon-2024'],                                
                                ['state', '!=', ''],
                                // ['event_organizations.category', '=', '13078']
                            ])
                            // ->where("users.created_at",'>',"2024-09-27 00:00:01")
                            // ->join('event_organizations', 'usermetas.user_id', '=', 'event_organizations.user_id')
                            // ->whereNotNull('usermetas.state')
                            // ->where("event_organizations.category",'=', 13077)
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

        if(request()->has('registrationcynamofitIndiaclub')){    
            
            return[
            
                'Registration Count'
            
            ];

        }elseif(request()->has('reportrolewisecynamofitIndiaclub')){    
            
            return[

                'Role','Count'

            ];

        }elseif(request()->has('reportdatewisenamofitIndiaclub')){

            return[
                'Role','Date','Count',
            ];

        }elseif(request()->has('reportwithimagefitIndiaclub')){

            return[

                'Organiser Name', 'Name', 'Email', 'Contact', 'Event Start Date', 'Event End Date', 'Event BG Image', 'Eventimg Meta', 'Excel Sheet', 'Participant Num',

            ];
        
        }elseif(request()->has('reportstatewisefitIndiaclub')){

            return[

                'State','Count',
            
            ];

        }elseif(request()->has('registrationcountcyclothon2024')){    
            // dd(3);    
            return[
            
                'Registration Count'
            
            ];

        }elseif(request()->has('reportrolewisecyclothon2024')){    
            
            return[

                'Role','Count'

            ];

        }elseif(request()->has('reportdatewisecyclothon2024')){

            return[
                'Role','Date','Count',
            ];

        }elseif(request()->has('reportwithimagecyclothon2024')){

            return[

                'Organiser Name', 'Name', 'Email', 'Contact', 'Event Start Date', 'Event End Date', 'Event BG Image', 'Eventimg Meta', 'Excel Sheet', 'Participant Num', 'State',

            ];
        
        }elseif(request()->has('reportstatewisecyclothon2024')){
            // dd(333333);
            return[

                'State','Count',
            
            ];

        }
    }

}