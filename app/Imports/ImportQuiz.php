<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\Quiztbl;

class ImportQuiz implements ToCollection
{
    public function collection(Collection $collections)
    {
		
        $collections->each(function($row, $key){
			if(!empty($row)){
				Quiztbl::create([
					'ques' => $row[1],
					'opt1' => $row[2],
					'opt2' => $row[3],
					'opt3' => $row[4],
					'opt4' => $row[5],
					'ans' =>  $row[6],
					'quiz_type' => 'pkl_quiz'
				]);
			}			
		});
		
    }
}
