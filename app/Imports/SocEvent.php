<?php
namespace App\Imports;
use App\Models\Soceventmaster;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class SocEvent implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // dd($row[6]);
        // dd(count($row));

        // dd($row['venue']);
        if($row[0] != 'Event Venue'){
            // dd($row[0]);
            return new Soceventmaster([
                'venue' => $row[0],
                'cycle' => $row[1],
                't_shirt' => $row[2],
                'meal' => $row[3],
                'latitude' => $row[4],
                'longitude' => $row[5],
                'event_date' => $row[6],
            ]);
        }
    }
}
