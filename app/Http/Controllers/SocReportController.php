<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request, Response;

class SocReportController extends Controller
{
    public function index()
    {
        return view('admin.soc_reports.index');
    }

public function download(Request $request)
{
    $date = $request->input('date');
    $type = $request->input('type');

    $filename = public_path("event.csv");
    $handle = fopen($filename, 'w');

    // Common CSV header
    $header = [
        "User ID",
        "Name",
        "Email",
        "Phone",
        "Address Line One",
        "Address Line Two",
        "Cycle Booking",
        "Cycle Waiting",
        "Cycle",
        "Meal Booking",
        "Meal Waiting",
        "Meal",
        "Date",
    ];
    fputcsv($handle, $header);

    if ($type === 'booked') {
        $query = "SELECT users.email, users.phone, usermetas.address_line_one, usermetas.address_line_two,
                         sop.user_id, sop.uname, sop.event_date, sop.cycle_booking, sop.cycle_waiting, sop.cycle,
                         sop.meal_booking, sop.meal_waiting, sop.meal
                  FROM soc_event_participations as sop
                  INNER JOIN users ON users.id = sop.user_id
                  JOIN usermetas ON users.id = usermetas.user_id
                  LEFT JOIN soc_event_participation_receives as sopr 
                       ON sop.user_id = sopr.user_id AND sop.socemid = sopr.socemid
                  WHERE sop.event_date = :date";

        $data = DB::select(DB::raw($query), ['date' => $date]);

        foreach ($data as $each_user) {
            fputcsv($handle, [
                $each_user->user_id,
                $each_user->uname,
                $each_user->email,
                $each_user->phone,
                $each_user->address_line_one,
                $each_user->address_line_two,
                $each_user->cycle_booking,
                $each_user->cycle_waiting,
                $each_user->cycle,
                $each_user->meal_booking,
                $each_user->meal_waiting,
                $each_user->meal,
                $each_user->event_date,
            ]);
        }
        fclose($handle);
        return response()->download($filename, "Cycle-Booking.csv", ['Content-Type' => 'text/csv']);
    } 

    elseif ($type === 'allotted') {
        $query = "SELECT users.email, users.phone, usermetas.address_line_one, usermetas.address_line_two,
                         sopr.user_id, sopr.uname, sopr.event_date, sopr.cycle, sopr.meal
                  FROM soc_event_participation_receives as sopr
                  INNER JOIN users ON users.id = sopr.user_id
                  JOIN usermetas ON users.id = usermetas.user_id
                  WHERE  sopr.user_id IN (SELECT user_id FROM soc_event_participations WHERE event_date = :date)";
               

        $data = DB::select(DB::raw($query), ['date' => $date]);

        foreach ($data as $each_user) {
            fputcsv($handle, [
                $each_user->user_id,
                $each_user->uname,
                $each_user->email,
                $each_user->phone,
                $each_user->address_line_one,
                $each_user->address_line_two,
                "", "", // Cycle booking / waiting
                $each_user->cycle,
                "", "", // Meal booking / waiting
                $each_user->meal,
                $each_user->event_date,
            ]);
        }
        fclose($handle);
        return response()->download($filename, "Cycle-Allotted.csv", ['Content-Type' => 'text/csv']);
    }

    elseif ($type === 'returned') {
        $query = "SELECT users.email, users.phone, usermetas.address_line_one, usermetas.address_line_two,
                         sopr.user_id, sopr.uname, sopr.event_date, sopr.cycle, sopr.meal, 
                         sopr.cycle_return, sopr.cycle_return_admin_user_id
                  FROM soc_event_participation_receives as sopr
                  INNER JOIN users ON users.id = sopr.user_id
                  JOIN usermetas ON users.id = usermetas.user_id
                  WHERE sopr.event_date = :date";

        $data = DB::select(DB::raw($query), ['date' => $date]);

        foreach ($data as $each_user) {
            fputcsv($handle, [
                $each_user->user_id,
                $each_user->uname,
                $each_user->email,
                $each_user->phone,
                $each_user->address_line_one,
                $each_user->address_line_two,
                "", "", // Cycle booking / waiting
                $each_user->cycle,
                "", "", // Meal booking / waiting
                $each_user->meal,
                $each_user->event_date,
            ]);
        }
        fclose($handle);
        return response()->download($filename, "Cycle-Returned.csv", ['Content-Type' => 'text/csv']);
    }
}

}
