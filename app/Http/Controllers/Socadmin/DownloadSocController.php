<?php

namespace App\Http\Controllers\Socadmin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use Illuminate\Http\Request;


class DownloadSocController extends Controller
{

    function soc_download_event_report(){

        $query = "SELECT users.email,users.phone,usermetas.address_line_one,usermetas.address_line_two,sop.user_id,sop.uname, sop.event_date,sop.cycle_booking,sop.cycle_waiting,sop.cycle,sop.meal_booking,sop.meal_waiting,sop.meal
                    FROM soc_event_participations as sop INNER join users on users.id = sop.user_id join usermetas on users.id = usermetas.user_id LEFT join soc_event_participation_receives as sopr on sop.user_id = sopr.user_id and sop.socemid = sopr.socemid
                    where sop.socemid = 8;";

        $data = DB::select(DB::raw($query));

            $headers = array(
                'Content-Type' => 'text/csv'
            );


            $filename =  public_path("event.csv");
            $handle = fopen($filename, 'w');


            fputcsv($handle, [
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

            ]);

            foreach ($data as $each_user) {
                fputcsv($handle, [
                        $each_user->user_id,
                        $each_user->uname,
                        $each_user->email,
                        $each_user->phone,
                        $each_user->address_line_one,
                        $each_user->address_line_one,
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
            // return Response::download($filename, "soceventdata.csv", $headers);
            return response()->download($filename, "soceventdata.csv", $headers);
    }


    function soc_download_event_report_data(){

        $query = "SELECT users.email,users.phone,usermetas.address_line_one,usermetas.address_line_two,sopr.user_id,sopr.uname,sopr.event_date,sopr.cycle,sopr.meal FROM soc_event_participation_receives as sopr INNER join users on users.id = sopr.user_id join usermetas on users.id = usermetas.user_id where sopr.socemid = 8 and sopr.user_id not in (select user_id from soc_event_participations where socemid = 8);";

        $data = DB::select(DB::raw($query));

            $headers = array(
                'Content-Type' => 'text/csv'
            );


            $filename =  public_path("event.csv");
            $handle = fopen($filename, 'w');


            fputcsv($handle, [
                    "User ID",
                    "Name",
                    "email",
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

            ]);

            foreach ($data as $each_user) {
            //    dd($each_user);
                fputcsv($handle, [
                        $each_user->user_id,
                        $each_user->uname,
                        $each_user->email,
                        $each_user->phone,
                        $each_user->address_line_one,
                        $each_user->address_line_two,
                        "",
                        "",
                        $each_user->cycle,
                        "",
                        "",
                        $each_user->meal,
                        $each_user->event_date,
                ]);

            }

            fclose($handle);
            return Response()->download($filename, "soceventdatadata.csv", $headers);
    }

     function soc_download_report_both_data(){
        $query = "SELECT users.email,users.phone,usermetas.address_line_one,usermetas.address_line_two,sopr.user_id,sopr.uname,sopr.event_date,sopr.cycle,sopr.meal FROM soc_event_participation_receives as sopr INNER join users on users.id = sopr.user_id join usermetas on users.id = usermetas.user_id where sopr.socemid = 8 and sopr.user_id in (select user_id from soc_event_participations where socemid = 8);";

        $data = DB::select(DB::raw($query));

            $headers = array(
                'Content-Type' => 'text/csv'
            );


            $filename =  public_path("event.csv");
            $handle = fopen($filename, 'w');


            fputcsv($handle, [
                    "User ID",
                    "Name",
                    "email",
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

            ]);

            foreach ($data as $each_user) {

                fputcsv($handle, [
                        $each_user->user_id,
                        $each_user->uname,
                        $each_user->email,
                        $each_user->phone,
                        $each_user->address_line_one,
                        $each_user->address_line_two,
                        "",
                        "",
                        $each_user->cycle,
                        "",
                        "",
                        $each_user->meal,
                        $each_user->event_date,
                ]);

            }

            fclose($handle);
            return Response()->download($filename, "soceventdatadata.csv", $headers);
    }

    function soc_download_report_cycle_return_data(){

        $query = "SELECT users.email,
                            users.phone,
                            usermetas.address_line_one,
                            usermetas.address_line_two,
                            sopr.user_id,
                            sopr.uname,
                            sopr.event_date,
                            sopr.cycle,
                            sopr.meal,
                            sopr.cycle_return,
                            sopr.cycle_return_admin_user_id
                    FROM soc_event_participation_receives as sopr
                    INNER join users on users.id = sopr.user_id
                    join usermetas on users.id = usermetas.user_id
                    where sopr.socemid = 7 and sopr.user_id;";

        $data = DB::select(DB::raw($query));

            $headers = array(
                'Content-Type' => 'text/csv'
            );


            $filename =  public_path("event.csv");
            $handle = fopen($filename, 'w');


            fputcsv($handle, [
                    "User ID",
                    "Name",
                    "email",
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

            ]);

            foreach ($data as $each_user) {

                fputcsv($handle, [
                        $each_user->user_id,
                        $each_user->uname,
                        $each_user->email,
                        $each_user->phone,
                        $each_user->address_line_one,
                        $each_user->address_line_two,
                        "",
                        "",
                        $each_user->cycle,
                        "",
                        "",
                        $each_user->meal,
                        $each_user->event_date,
                ]);

            }

            fclose($handle);
            return Response()->download($filename, "soc_report_cycle_return_data.csv", $headers);
    }

}
