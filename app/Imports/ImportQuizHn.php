<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\Quiztblhn;

class ImportQuizHn implements ToCollection
{
 
    public function collection(Collection $collections)
    {
        $collections->each(function($row, $key){
			if(!empty($row)){
				Quiztblhn::create([
					'ques' => $row[0],
					'opt1' => $row[1],
					'opt2' => $row[2],
					'opt3' => $row[3],
					'opt4' => $row[4],
					'ans' => $row[5]
				]);
				
			}			
		});
		
    }
}
