<?php

namespace App\Http\Controllers;

use App\Models\YogaCenter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class YogaCenterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id=null)
    {
        $id1 = base64_encode( $id );
        $id2 = base64_decode( $id );
        $yoga_user = YogaCenter::find($id2);
        $yoga_user_info ='';
        if(!empty($yoga_user)){
            $yoga_user_info = $yoga_user;
        }else{
             //return redirect('home');
            $yoga_user_info = "";
        }
        return view('certification_validator',compact('yoga_user_info'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\YogaCenter  $yogaCenter
     * @return \Illuminate\Http\Response
     */
    public function show(YogaCenter $yogaCenter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\YogaCenter  $yogaCenter
     * @return \Illuminate\Http\Response
     */
    public function edit(YogaCenter $yogaCenter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\YogaCenter  $yogaCenter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, YogaCenter $yogaCenter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\YogaCenter  $yogaCenter
     * @return \Illuminate\Http\Response
     */
    public function destroy(YogaCenter $yogaCenter)
    {
        //
    }
    public function yogaCertificate(Request $request){
       /* $sid = Auth::user()->id;
        $name = Auth::user()->name;
        $city = DB::table('users')
                ->join('usermetas','users.id','=','usermetas.user_id')
                ->select(['usermetas.city'])
                ->where('user_id', Auth::user()->id)
                ->first();
        $cities = current($city);*/
        
        $qr_data='';        
        $qr_data.='https://fitindia.gov.in/'."\r\n";
        //$qr_data.= 'School Name : '.$name. "\r\n".'City Name : '.$cities. "\r\n" .'User ID : '.$sid;
        //$qr_data.= $name."\r\n".'Fit India Yoga Center'. "\r\n" .'This certificate has been issued by Fit India Mission';
        //$qr_data.= $name."\r\n".'Fit India Yoga Center'. "\r\n" .'This certificate has been issued by Fit India Mission';
        
        $qrcode = QrCode::size(75)->generate($qr_data);     
       
        $pdf = PDF::loadView('test-certificate',compact('qrcode'))->setPaper(array(0,0,635,395));      
        return $pdf->stream("name".".pdf"); 
    }
}
