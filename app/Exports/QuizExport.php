<?php
namespace App\Exports;
use App\Models\Quizreport;
use App\Models\User;
use App\Models\Usermeta;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Http\Request;

class QuizExport implements FromCollection,WithHeadings
{    
   public function collection()
    {
       
       if(request()->has('uname') || request()->has('st') || request()->has('month') || request()->has('org') ) {

            return collect(Quizreport:: getAllSearch());
        } 
        else{ 

          return collect(Quizreport::getAllUser());
		}
    }	
	
    public function headings():array{
		return[
			'ID',			
			'Quiz Organizer',
			'Participate Name',
			'Email',
			'Mobile',
			'City',
			'State',
			'Score',
			'CreatedOn'
		];
	}    
}
