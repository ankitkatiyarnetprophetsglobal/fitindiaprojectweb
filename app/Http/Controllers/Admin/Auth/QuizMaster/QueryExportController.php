<?php

namespace App\Http\Controllers\Admin\Auth\QuizMaster;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ArrayExport;
class QueryExportController extends Controller
{


    public function index()
    {
        return view('admin.Quizmaster.Query_form.query_form');
    }

    public function export(Request $request)
    {

        $request->validate([
        'query' => 'required|string',
    ]);

    $query = $request->input('query');

    try {
        $results = DB::select(DB::raw($query));
         $data = collect($results)->map(function($item){
                return (array) $item;
            });

        return Excel::download(new ArrayExport($data), 'query_result.xlsx');
    } catch (\Exception $e) {
        return back()->withErrors(['query' => 'Invalid SQL: ' . $e->getMessage()]);
    }
    }

}
