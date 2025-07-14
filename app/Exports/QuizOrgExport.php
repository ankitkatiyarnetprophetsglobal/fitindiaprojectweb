<?php
namespace App\Exports;
use App\Models\Quizreport;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuizOrgExport implements FromCollection,WithHeadings
{    
	public function collection()
    {
		$organisers = Quizreport::select("school_id","users.name as name", "users.email as email", "users.phone as mobile",  DB::raw('DATE_FORMAT(users.created_at,"%d-%m-%Y") as Date'))->leftJoin ('users', 'quiz_report.school_id', '=', 'users.id')->orderBy('users.id', 'DESC')->groupBy('school_id')->get(); 
       return collect( $organisers );
		
    }	
	
    public function headings():array{
		return[
			'ID',
			'Name',
			'Email',
			'Mobile',
			'Date' 
		];
	}
    
}
