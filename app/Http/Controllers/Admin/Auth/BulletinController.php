<?php
namespace App\Http\Controllers\Admin\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bulletin;
use Illuminate\Support\Facades\DB;

class BulletinController extends Controller
{
    public function index()
    {
        $bulletin = Bulletin::orderBy('title', 'ASC')->get();
		$bulletin_count = count($bulletin);
        return view('admin.bulletin.index',compact('bulletin','bulletin_count'));
    }
   
    public function create()
    {
        return view('admin.bulletin.create');
    }
   
    public function store(Request $request)
    {    
	        $request->validate([
				'title' => 'required',
				'url' => 'required|url',
				/* 'description' => 'required',           
				'doc' => 'required|mimes:doc,xlsx,pdf,jpg,png,jpeg,gif,svg|max:1000000' */
			],[
				'title.required' => 'Title field is required.',
				'url.required' =>'URL field is required.',				
				'url.url' =>'Please enter a valid URL.',				
				/*'description.required' => 'Description field is required.',
				'doc.required' => 'Please upload attachment file.',
				'doc.mimes' => 'Please upload doc,xlsx,pdf,jpg,png,jpeg,gif,svg.',
				'doc.max' => 'Please upload maximum 1000000 size file.', */
			 ]	
			);  
			
			$doc = '';
			$document_url = '';
			$year = date("Y/m"); 
				
			if($request->file('doc')!='')
			{
				$document_url = $request->file('doc')->store('doc',['disk'=> 'uploads']);
				$document_url = url('wp-content/uploads/'.$document_url);
			}       

		   $bulletin = new Bulletin;
		   $bulletin->attachment = $document_url;
		   $bulletin->title = $request->title;
		   $bulletin->url = $request->url;
		   $bulletin->bulletin_date = $request->bulletin_date;
		   $bulletin->description = $request->description; 
		   $bulletin->status = $request->status; 
		   $bulletin->save();
		   
		   return redirect()->route('admin.bulletin.index')->with('success','Bulletin has been created successfully.');
    }
    
    public function show($id)
    {
        //
    }

   
    public function edit($id)
    {
        //dd($id);die;
        $bulletin = Bulletin::findOrFail($id);
        return view('admin.bulletin.edit',compact('bulletin'));
    }

    
    public function update(Request $request, $id)
    {
        $image = '';
        $document_url = '';
        $year = date("Y/m"); 
		
		$request->validate([
            'title' => 'required',
            'url' => 'required|url',
           /*  'description' => 'required',         */  
            
        ]); 	
         
       if($request->file('doc')!='')
        {
            $document_url = $request->file('doc')->store('doc',['disk'=> 'uploads']);
            $document_url = url('wp-content/uploads/'.$document_url);
        }

        $bulletin = Bulletin::find($id);
		
		$bulletin->attachment = $document_url;           
		$bulletin->url = $request->url;
		$bulletin->bulletin_date = $request->bulletin_date;
		$bulletin->title = $request->title;
		$bulletin->description = $request->description; 
		$bulletin->status = $request->status;        
        $bulletin->save();
    
        return redirect('admin/bulletin')->with(['status' => 'success' , 'msg' => 'Successfully added']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bulletin = Bulletin::findOrFail($id);
        $bulletin->delete();
        return redirect('admin/bulletin')->with(['status' => 'success', 'msg' => 'Successfully added']);
    }

   
}
