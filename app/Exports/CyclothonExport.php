<?php
namespace App\Exports;
use App\Models\Eventorganizations;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CyclothonExport implements FromCollection, WithHeadings
{
    public function collection(){

        if(request()->has('allreortilldate')){
            // dd(4);
            $records = DB::table('users')  
                        ->join('usermetas', 'usermetas.user_id', '=', 'users.id')                
                        ->where([
                            ['users.created_at', '>', '2024-12-14 00:00:01'],
                            ['rolewise', '=', 'cyclothon-2024']
                        ])
                        ->orWhere('users.updated_at', '>', '2024-12-11 00:00:01')
                        ->select(
                            'users.name',
                            'users.email',
                            'users.phone',                                                        
                            'usermetas.cyclothonrole',                            
                            'usermetas.cycle',
                            DB::raw('IFNULL(usermetas.participant_number, 0) as participant_number'),
                            DB::raw('IFNULL(users.updated_at, users.created_at) as created_at')
                        )
                        ->get();
            // dd($records);            
            return $records;        
        }


    }
   
    public function headings(): array{
        
        if(request()->has('allreortilldate')){    
            // dd(3);    
            return[

                'Name',
                'Email',
                'Phone',
                'cyclothonrole',
                'Cycle',                
                'participant_number',
                'created_at'
            ];
        }
    }

}