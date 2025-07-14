<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EpisodeQuiz;
use App\Models\EpisodeQuizResult;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class EpisodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $auth_id = $_REQUEST['Fit_id'];
        $user = User::find($auth_id);
        if(!empty($user)){
            $current_date = date('d-m-Y'); 
            $current_time = date('Y-m-d H:i:s',strtotime('+330 minutes')); 
            //$quiz_episode = EpisodeQuiz::where('episode_date',$current_date)->orderBy(\DB::raw('RAND()'))->limit(1)->get();
            $quiz_episode = EpisodeQuiz::where('episode_date',$current_date)->where('status','1')->where('updated_at','<=',$current_time)->get();
            return view('episode_quiz/quiz',compact('quiz_episode','auth_id')); 
        }else{
            abort(404);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            $request->validate([
                'choosed_option' => 'required',
            ],
            [
                'choosed_option.required' => 'Option is required'
            ]);


            $epi_quiz = new EpisodeQuizResult();
            $epi_quiz->user_id = $request->user_id;
            $epi_quiz->q_id = $request->q_id;
            $epi_quiz->episode = $request->episode;
            $epi_quiz->episode_date = $request->episode_date;
            $epi_quiz->choosed_option_index = $request->choosed_option;
            $epi_quiz->ans = $request->ar_value;
            $section_val = $request->section_val;
            $epi_quiz->choosed_option = trim($request->ch_option);
            if($epi_quiz->save())
            {
                return redirect('episode-quiz?Fit_id='.$request->user_id.'#section'.$section_val)->with('msg', 'Success');   
            }else{
                return redirect('episode-quiz?Fit_id='.$request->user_id.'#section'.$section_val)->with('msg', 'Failed');   
            }    


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
