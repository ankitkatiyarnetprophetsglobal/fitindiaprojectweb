<?php
namespace App\Exports;
use App\Models\Event;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Http\Request;

class EventExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        if(request()->has('ename') || request()->has('st') || request()->has('dst')|| request()->has('dbk')|| request()->has('cat')|| request()->has('dat')){

            return collect(Event::getAllSearch());

        }  else { 

          return collect(Event::getAllEvent());
       }
    }
   
    public function headings(): array
    {
        if(request()->input('cat')=='13056'){
            return[
                'Event_Name','Mobile','User_Name','Email','Event_Date','Image_1','Image_2','Video','Participants','State','District','Block','Application_Status','User_Created_Date'
            ];
        }else{
           return[
                'Event_Name','Mobile','User_Name','Email','Event_Date','KM','Participants','State','District','Block','Application_Status','User_Created_Date'
            ]; 
        }
		
    } 
}