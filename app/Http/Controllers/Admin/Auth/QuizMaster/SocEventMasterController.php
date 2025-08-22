<?php

namespace App\Http\Controllers\Admin\Auth\QuizMaster;
use App\Models\QuizmasterModel\SocEventMaster;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\SocEvent;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\Role;

class SocEventMasterController extends Controller
{
    // List all versions
public function index()
    {
        $events = SocEventMaster::paginate(10);
        return view('admin.Quizmaster.soc_events.index', compact('events'));
    }

    public function create()
    {
        return view('admin.Quizmaster.soc_events.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'venue' => 'required|string',
            'cycle' => 'required|integer',
            't_shirt' => 'required|integer',
            'meal' => 'nullable|integer',
            'latitude' => 'required',
            'longitude' => 'required',
            'event_date' => 'required|date_format:Y-m-d',
            'status' => 'required|boolean',
        ]);

        SocEventMaster::create($request->all());

        return redirect()->route('admin.soc-events.index')->with('success', 'Event Created Successfully.');
    }

    public function edit(SocEventMaster $soc_event)
    {
        return view('admin.Quizmaster.soc_events.edit', compact('soc_event'));
    }

    public function update(Request $request, SocEventMaster $soc_event)
    {
        $request->validate([
            'venue' => 'required|string',
            'cycle' => 'required|integer',
            't_shirt' => 'required|integer',
            'meal' => 'nullable|integer',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'event_date' => 'required|date_format:Y-m-d',
            'status' => 'required|boolean',
        ]);

        $soc_event->update($request->all());

        return redirect()->route('admin.soc-events.index')->with('success', 'Event Updated Successfully.');
    }

    public function destroy(SocEventMaster $soc_event)
    {
        $soc_event->delete();
        return redirect()->route('admin.soc-events.index')->with('successupload', 'Event Deleted Successfully.');
    }

    public function upload(Request $request){
         
          $request->validate([

                        'file' => 'required|file|mimes:xlsx,xls|max:10240',  // 10MB max size

                    ],[
                        'file.mimes' => 'Please upload a valid Excel file. Only .xlsx and .xls formats are allowed.',
                        'file.max' => 'The file size exceeds the maximum limit of 10MB.',
                    ]
                );

        $rows = Excel::toCollection(new SocEvent, $request->file('file'));
        // dd($rows);
        foreach( $rows as $key => $element) {

            $allvenue = [];
            $v = 0;
            $vv = 0;
            $allrow = [];
            $i = 0;
            $allcyclerowblank = [];
            $i = 0;
            $ii = 0;
            $allrowt_shirt = [];
            $k = 0;
            $allrowt_shirt_blank = [];
            $kk = 0;
            $allrowmeal = [];
            $m = 0;
            $allrowmeal_blank = [];
            $mm = 0;
            $allevent_date = [];
            $ed = 0;
            $edb = 0;
            foreach ($element as $row) {

                if($row !== 'Cycle_Count'){


                    if ($row[0] !== 'Event Venue') {
                        $vv++;
                        if ($row[0] == '') {

                            $allvenue[$v++] =  "Venue line no:- ".$vv;
                        }
                    }
                    if ($row[1] != 'CycleCount') {
                        $ii++;
                        if ($row[1] == '') {

                            $allcyclerowblank[$ii] =  "Cycle line no:- ".$ii;
                        }
                    }
                    if ($row[2] !== 'T Shirt Count') {
                        $kk++;
                        if ($row[2] > 0){

                            $allrowt_shirt_blank[$kk] =  "T Shirt line no:- ".$kk;
                        }
                    }
                    if ($row[3] !== 'Meal Count') {
                        $mm++;
                        if ($row[3] == '') {

                            $allrowmeal_blank[$mm] =  "Meal line no:- ".$mm;
                        }
                    }
                    if ($row[6] !== 'Event Date(YYYY-MM-DD)') {
                        $edb++;
                        if ($row[6] == '') {

                            $allevent_date[$edb] =  "Event date line no:- ". $edb;
                        }
                    }
                    // Skip header row where column 1 is 'cycle'

                    if (isset($row[1]) && trim($row[1]) !== 'Cycle Count') {

                        // Check if $row[1] is not an integer
                        if (!is_int($row[1])) {

                            $allrow[$i++] = "Cycle column text error (".$row[1]. ")";
                        }
                    }
                    // if (isset($row[2]) && strtolower(trim($row[2])) !== 'T Shirt Count') {
                    if (isset($row[2]) && trim($row[2]) !== 'T Shirt Count') {

                        // Check if $row[1] is not an integer
                        if (!is_int($row[2])) {

                            // $allrowt_shirt[$k++] = $row[2];
                            $allrowt_shirt[$k++] = "T Shirt column text error (".$row[2]. ")";
                        }
                    }
                    if (isset($row[3]) && trim($row[3]) !== 'Meal Count') {

                        // Check if $row[1] is not an integer
                        if (!is_int($row[3]) || ($row[3] < 0)) {

                            // $allrowmeal[$m++] = $row[3];
                            $allrowmeal[$m++] = "Meal column text error (".$row[3]. ")";
                        }
                    }
                    if (isset($row[6]) && trim($row[6]) !== 'Event Date(YYYY-MM-DD)') {

                        if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$row[6])) {
                            // $allevent_date[$ed++] = $row[6];
                            $allevent_date[$ed++] = "Event date column text error (".$row[6]. ")";
                        }
                    }
                }
            }

            if(
                count($allvenue) > 0
                || count($allcyclerowblank) > 0
                || count($allrowt_shirt_blank) > 0
                || count($allrowmeal_blank) > 0
                || count($allevent_date) > 0
                || count($allvenue) > 0
                || count($allcyclerowblank) > 0
                || count($allrowt_shirt_blank) > 0
                || count($allrowmeal_blank) > 0
                || count($allevent_date) > 0){
                $main_array = array(
                                    array('allvenue' => $allvenue),
                                    array('allcyclerowblank' => $allcyclerowblank),
                                    array('allrowt_shirt_blank' => $allrowt_shirt_blank),
                                    array('allrowmeal_blank' => $allrowmeal_blank),
                                    array('allevent_date' => $allevent_date),
                                );
                $main_array_error = array(
                                    // array('allvenue' => $allvenue),
                                    array("cycle_array" => $allrow),
                                    array('allrowt_shirt'=> $allrowt_shirt),
                                    array('allrowmeal' => $allrowmeal),
                                    array('allevent_date' => $allevent_date),
                                );

                $events = SocEventMaster::paginate(10);
                return view('admin.Quizmaster.soc_events.index', compact('main_array','main_array_error','events'));

            }

            if($row[0] !== 'Event Venue'){

                    $data = Soceventmaster::
                            whereDate('event_date', $row[6])
                            ->where([
                                        ['status','=' ,1],
                                        ['venue','=' , trim($row[0])]

                                    ])
                            ->select(
                                    'id',
                                    'venue',
                                    'cycle',
                                    't_shirt',
                                    'meal',
                                )
                                ->get();

                    if(count($data) > 0){

                        foreach ($data as $datarow) {

                                    Soceventmaster::where([
                                    ['soc_event_masters.id', '=', $datarow['id']],
                                ])
                                ->update(
                                    [
                                        'soc_event_masters.status' => 0,
                                    ]
                                );
                            }
                    }

                }

            $rows = Excel::import(new SocEvent, $request->file('file')->store('files'));
            return redirect()->route('admin.soc-events.index')->with('success', 'File uploaded successfully.');
            // return back()->with('success','File uploaded successfully');
        }
    }

}
