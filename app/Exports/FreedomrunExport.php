<?php
namespace App\Exports;
use App\Models\Freedomrun;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Http\Request;

class FreedomrunExport implements FromCollection, WithHeadings 
{
    public function collection()
    {
        if(request()->has('ename') || request()->has('type')){

            return collect(Freedomrun::getAllSearch());

        }  else { 

          return collect(Freedomrun::getAllFreedomrun());
       }
    }
	
	public function headings(): array
    {
        if(request()->input('type')=='organizer'){
        return[
            'Organizer_Name','User_Email','User_Phone','total_participant','total_kms','Role','State','District','Block','School_Category','Registered_As','Image','Video_Link','Event_Startdate','Event_Enddate','created_at'
        ];
        }else{
           return[
            'User_Name','Mobile','Email','Organiser','kmrun','Role','Event_Startdate','Event_Enddate'
        ]; 
       }		
    } 
}