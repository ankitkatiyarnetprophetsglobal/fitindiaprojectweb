<?php
namespace App\Exports;
use App\Models\Freedomrunpartners;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Http\Request;

class PartnerExport implements FromCollection, WithHeadings 
{
    public function collection()
    {
        if(request()->has('ename') || request()->has('type')){

            return collect(Freedomrunpartners::getAllSearch());

        }  else { 

          return collect(Freedomrunpartners::getAllFreedomrun());
       }
    }
   
    public function headings(): array
    {
        return[
            'Organization_Name','Event_Name','Email','Mobile','From_Date','To_Date'
        ];				
    } 
}