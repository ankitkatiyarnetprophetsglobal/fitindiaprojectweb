<?php
namespace App\Exports;
use App\Models\CertStatus;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Http\Request;

class CertExport implements FromCollection,WithHeadings
{
     public function collection(){
      
       if(request()->has('name') || request()->has('state') || request()->has('dst') || request()->has('blk') || request()->has('month') || request()->has('cert')){
			
			return collect(CertStatus::getAllSearch());

        }  else { 
		
			return collect(CertStatus::getAllCert());
       }
    }
	
    public function headings(): array
    {
        return[
            'School_Name','Email','Phone','U-Dise Number','State','District','Block','category','Status', 'CreatedOn'
        ];
    }    

}