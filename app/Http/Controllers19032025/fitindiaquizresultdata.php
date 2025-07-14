<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\fitindiaquizresult;

class fitindiaquizresultdata extends Controller
{

    function index(){
        // dd(123);
        return view('result');
    }
    function getresult(Request $request){
        
        $request->validate(
            [
                'roll_no'=>'required|string|max:8'
            ],
            [
                'roll_no.required'=>'Roll number cannot be blank',
                'roll_no.max'=>'Entered roll number should not be more than 8 character'
            ]);
        $data=fitindiaquizresult::where('roll_no','=',$request->roll_no)->get();
        if(json_decode($data)!==[]){
        return $data;
        }else{
            return response()->json([
                "result"=>"Not Found"
            ]);
        }




    }

    function resultshow(){
        // dd(123);
        return view('resultshow');
    }
}
