<?php
namespace App\Exports;
use App\Models\Eventorganizations;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventorganizationsExport implements FromCollection, WithHeadings
{
    public function collection(){        

            if(request()->has('reportrolewise')){

                $records = DB::table('users')
                            // ->where("users.created_at",'>',"2024-09-27 00:00:01")
                            ->where([
                                ['users.created_at', '>', '2024-09-27 00:00:01'],
                                ['role', '!=', 'namo-fit-india-cycling-club'],
                                ['role', '!=', 'namo-fitIndia-club'],
                                ['role', '!=', 'cyclothon-2024'],
                                ['role', '!=', '']
                            ])
                            ->groupBy(DB::raw('case when rolelabel is null then role else rolelabel end'))
                            ->get([                                                            
                                DB::raw('case when users.rolelabel is null then users.role else users.rolelabel end as countname'),
                                DB::raw('count(1) as countnumber'),
                            ]);

                return $records;

            }else if(request()->has('reportdatewise')){
                
                $records = DB::table('users')
                            // ->where("users.created_at",'>',"2024-09-27 00:00:01")
                            ->where([
                                ['users.created_at', '>', '2024-09-27 00:00:01'],
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
                
            }else if(request()->has('reportwithimage')){
                
                // dd('reportwithimage');
                // $query = "SELECT                 
                //         eo.user_id,
                //         eo.organiser_name,
                //         eo.name,
                //         eo.email,
                //         eo.contact,        
                //         eo.eventstartdate,
                //         eo.eventenddate,        
                //         eo.event_bg_image,
                //         eo.eventimg_meta,
                //         eo.excel_sheet,
                //         IFNULL(eo.participantnum, 0) as participantnum
                //         FROM event_organizations AS eo where category = 13065 order by id desc";


                $records = DB::table('event_organizations')
                            ->where("event_organizations.category",'=', 13065)
                            ->orderBy('event_organizations.id', 'desc')                            
                            ->get([                                
                                DB::raw('event_organizations.organiser_name, event_organizations.name, event_organizations.email, event_organizations.contact, event_organizations.eventstartdate, event_organizations.eventenddate,        
                                        event_organizations.event_bg_image, event_organizations.eventimg_meta, event_organizations.excel_sheet, IFNULL(event_organizations.participantnum, 0) as participantnum'),
                            ]);
                // dd($records);
                return $records;

            }else if(request()->has('registrationcount')){

                $records = DB::table('users')
                            // ->where("users.created_at",'>',"2024-09-27 00:00:01")
                            ->where([
                                ['users.created_at', '>', '2024-09-27 00:00:01'],
                                ['users.role', '!=', 'namo-fit-india-cycling-club'],
                                ['users.role', '!=', 'namo-fitIndia-club'],
                                ['users.role', '!=', '']
                            ])
                            ->get([                                                            
                                DB::raw('count(1) as count'),
                            ]);
                return $records;
            
            }else if(request()->has('reportstatewise')){
                
                
                // SELECT um.state,
                // count(1) as count_number 
                // FROM users as u 
                // inner JOIN usermetas as um on um.user_id = u.id 
                // inner join event_organizations  as eo on um.user_id = eo.user_id 
                // where um.state is not null and eo.category = 13061 and eo.event_name_store = 'national_sports_day_2023' GROUP BY um.state order by um.state;
                $records = DB::table('users')
                            ->join('usermetas', 'usermetas.user_id', '=', 'users.id')
                            // ->where("users.created_at",'>',"2024-09-27 00:00:01")
                            ->where([
                                ['users.created_at', '>', '2024-09-27 00:00:01'],
                                ['role', '!=', 'namo-fit-india-cycling-club'],
                                ['role', '!=', 'namo-fitIndia-club'],
                                ['role', '!=', ''],
                                // ['event_organizations.category', '=', '13065']
                            ])
                            // ->join('event_organizations', 'usermetas.user_id', '=', 'event_organizations.user_id')
                            // ->whereNotNull('usermetas.state')
                            // ->where("event_organizations.category",'=', 13065)
                            ->orderBy('usermetas.state', 'asc')
                            ->groupBy('usermetas.state')
                            ->get([                                                            
                                DB::raw('usermetas.state'),
                                DB::raw('count(1) as count_number'),
                            ]);
                // dd($records);
                return $records;
            
            }else{

                dd('Not Done');

            }
            // $records = DB::table('users')
            //                 ->where("users.created_at",'>',"2024-09-27 00:00:01")
            //                 ->get([                                                            
            //                     DB::raw('count(1) as count'),
            //                 ]);
                        // ->join('usermetas', 'users.id', '=', 'usermetas.user_id')
                        // ->whereIn('users.id', function($query)
                        //     {
                        //         $query->select('event_organizations.user_id')
                        //             ->from('event_organizations')
                        //             ->where('category', '=' ,'13064');
                        //     })
                        // ->where("users.created_at",'>',"2024-08-14 00:00:01")
                        // // ->get([
                        // //         'users.id'
                        // //     ]);
                        // // case when rolelabel is null then role else rolelabel end
                        // ->groupBy(DB::raw('case when rolelabel is null then role else rolelabel end'))
                        // ->get([                                
                        //         DB::raw('case when users.rolelabel is null then users.role else users.rolelabel end as countname'),
                        //         DB::raw('count(1) as countnumber'),
                        //     ]);
            // dd($records);
            
            // return collect(Eventorganizations::getAllEvent());       
    }
   
    public function headings(): array{
        
        if(request()->has('reportrolewise')){

            return[
                'Role','Count'
            ];

        }else if(request()->has('reportwithimage')){

            return[
                'Organiser Name', 'Name', 'Email', 'Contact', 'Event Start Date', 'Event End Date', 'Event BG Image', 'Eventimg Meta', 'Excel Sheet', 'Participant Num',
            ];

        }else if(request()->has('reportstatewise')){

            return[
                'State','Count',
            ];

        }else if(request()->has('reportdatewise')){

            return[
                'Role','Date','Count',
            ];

        }else if(request()->has('registrationcount')){

            return[
                'Registration Count'
            ];

        }
        // else{
        //     return[
        //         'Registration Count'
        //     ];
        // }
        
    } 
}