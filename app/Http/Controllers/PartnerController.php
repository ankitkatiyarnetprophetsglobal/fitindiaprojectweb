<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request, Response, Redirect;
use App\Models\Partner;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('become-partner');
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
    public function store(Request $request){        
         //dd($request);		 
				
		/* $request->validate([
            'name' => 'required|string|regex:/(^[a-zA-Z ]+$)+/',
            'email' => 'required|string|unique:partners|max:255',
            'contact' => 'required|digits:10',
            'designation'=> 'required|string|regex:/(^[a-zA-Z ]+$)+/',
            'sociallink' => 'required|string',
            'story' => 'required|string',
            'specify' => 'required|string',
			
          ]
		); */
		
				
		$request->validate([
            'name' => 'required|string|regex:/(^[a-zA-Z ]+$)+/',  
            'specify' => 'required|string',			
			'email' => 'required|email|unique:partners',
            'contact' => 'required|digits:10',
            'designation'=> 'required|string|regex:/(^[a-zA-Z ]+$)+/',
            'sociallink' => 'required|url',
            'story' => 'required|string',
            
        ],[
			'name.required'=> 'Please enter your name.',
			'specify.required'=>'Are you representing an Organisation or Group (specify name)? field is required.',
			'designation.required'=>'Please enter a valid designation.',
			'designation.regex'=>'Please enter character value only.',
			'email.required' =>'Please enter a valid email address.',
			'email.email' =>'Please enter correct email format.',
			'email.unique' =>'Email already exist.',
			'contact.required' =>'Please enter a valid mobile no.',
			'contact.digits' =>'Mobile No field must have 10 digit.',
			'sociallink.required' => 'Please enter Website/Social Page.',
			'sociallink.url' => 'Please enter a valid URL.',
			'story.required' => 'Please enter the contribute to FIT INDIA as a Partner?.',			
		 ]	
		);
        
        $partners = new Partner();
        $partners->name = $request->name;
        $partners->email = $request->email;
        $partners->contact = $request->contact;
        $partners->designation = $request->designation;
        $partners->sociallink = $request->sociallink;
        $partners->story = $request->story;
        $partners->specify = $request->specify;
        $partners->save();
		
        return back()->with('success','Your information has been  Sucessfully submited !!! Thank you for your interest'); 

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
