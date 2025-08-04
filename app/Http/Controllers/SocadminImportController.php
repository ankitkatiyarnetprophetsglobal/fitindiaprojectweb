<?php

namespace App\Http\Controllers;

use App\Service\SmsServiceProvider;
use Illuminate\Http\Request, Response, Redirect;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\YourImportClass;
use App\Exports\ExportUser;
use App\Models\User;

class SocadminImportController extends Controller
{


    public function index(Request $request){
        // dd("Done");
        return view('excel-import');
        // return view('ambassador',compact('states'));
    }

    public function import(Request $request){

        // Validate the uploaded file
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);
        // Get the uploaded file
        // dd("done 3333");
        $file = $request->file('file');
        // dd($file);
        // Process the Excel file
        Excel::import(new YourImportClass, $file);
        return redirect()->back()->with('success', 'Excel file imported successfully!');
    }
}
