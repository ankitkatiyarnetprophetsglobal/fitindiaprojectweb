<?php
namespace App\Http\Controllers\Admin\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request,Response,Redirect;
use App\Models\ArchiveRole;
use App\Models\EventArchive;
use App\Models\WebsiteBanner;
use App\Models\Language;
use App\Models\Role;
use Illuminate\Support\Facades\DB;

class EventArchiveController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $eventarchive = EventArchive::all();

        $archiverole  = DB::table('event_archive')
		                ->leftJoin('archive_role', 'event_archive.id', '=', 'archive_role.archive_id')
		                ->leftJoin('roles', 'roles.id', '=', 'archive_role.role_id')
						->get();

		$eventarchive_count = count($eventarchive);
        return view('admin.eventarchive.index',compact('archiverole','eventarchive','eventarchive_count'));
    }

    public function create()
    {
		$roles = Role::orderby('name')->get();
        $language = Language::orderby('name')->get();
		return view('admin.eventarchive.create',compact('roles','language'));
       // return view('admin.eventarchive.create');
    }

    public function store(Request $request){
           //dd($request);
		   $request->validate([
		        'title' => 'required|unique:event_archive',
				'start_date' => 'required',
				'end_date' => 'required',
				'role' => 'required',
				'link' => 'required|url',
				'language' => 'required',
				'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
			],
			[
				'title.required' => 'Event Archive Name field is required.',
				'title.unique' => 'Event Archive Name alredy exist.',
				'start_date.required' => 'Start Date field is required.',
				'end_date.required' => 'End Date field is required.',
				'role.required' =>  'Role field is required.',
				'link.required' =>  'Archive Link is required.',
				'link.url' =>  'Please enter valid URL',
				'language.required' =>  'Language field is required.',
				'image.required' =>  'Poster Image field is required.',
				'image.image' =>  'Please upload valid image',
				'image.mimes' =>  'Please upload valid image like jpg,png,jpeg,gif,svg',
				'image.max' =>  'Please upload maximum 2 MB Data.',
			]);

			$image = '';
			$year = date("Y/m");

			if($request->file('image')){
				$image = $request->file('image')->store($year,['disk'=> 'uploads']);
				$image = url('wp-content/uploads/'.$image);
			}


			$archive = new EventArchive();

			if(!empty($image)){
			   $archive->poster_image = $image;
			}

			$archive->title = $request->title;
			$archive->start_date = $request->start_date;
			$archive->end_date = $request->end_date;
			$archive->link = $request->link;
			$archive->language = $request->language;
			$archive->status = $request->status;
			$archive->save();

			if($archive->save()){
             if(!empty($request->role)){
			    foreach($request->role as $value){
					$data = array(
						'archive_id' => $archive->id,
					    'role_id' => $value
					);

					$count = DB::table('archive_role')
							->where('archive_id', $archive->id)
							->where('role_id', $value)
							->count();

					if($count > 0){
					  //exist;
					}else{
						DB::table('archive_role')->insert($data);
					}
			      }
		        }
		    }

         return redirect('admin/eventarchive')->with(['status' => 'success' , 'msg' => 'Successfully added']);
    }

    public function edit($id)
    {

        $roles = Role::orderby('name')->get();
        $language = Language::orderby('name')->get();
	    $archive = EventArchive::findOrFail($id);
		$arcole = ArchiveRole::where('archive_id', $id)->get();
		$archiverole=array();

		if(!empty($arcole)){
		  foreach($arcole as $sact){
			array_push($archiverole,$sact->role_id);
		  }
		}

        return view('admin.eventarchive.edit',compact('roles','archiverole','language','archive'));
    }

    public function update(Request $request, $id)
    {
		   $request->validate([
		        'start_date' => 'required',
				'end_date' => 'required',
				'role' => 'required',
				'link' => 'required|url',
			]);

			$image = '';
			$year = date("Y/m");

			$archive = EventArchive::find($id);

			if($request->file('image')!=''){
				$image = $request->file('image')->store($year,['disk'=> 'uploads']);
				$image = url('wp-content/uploads/'.$image);
				$archive->poster_image = $image;
			}

            // dd($image);
            if($id == 58){
                WebsiteBanner::query()->where(['id' => 14])->take(1)->update(['banner_url' => $image]);
            }

			$archive->title = $request->title;
			$archive->start_date = $request->start_date;
			$archive->end_date = $request->end_date;
			$archive->link = $request->link;
			$archive->language = $request->language;
			$archive->status = $request->status;

			if($archive->save()){

             if(!empty($request->role)){

				DB::table('archive_role')->where('archive_id', $id)->delete();

				foreach($request->role as $value){

					$data = array(
						'archive_id' => $archive->id,
					    'role_id' => $value
					);

					$count = DB::table('archive_role')
							->where('archive_id', $archive->id)
							->where('role_id', $value)
							->count();

					if($count > 0){
					  //exist;
					}else{
						DB::table('archive_role')->insert($data);
					}
			      }
		        }
		    }

        return redirect('admin/eventarchive')->with(['status' => 'success' , 'msg' => 'Successfully added']);
    }

    public function destroy($id)
    {
        $archiverole = DB::table('archive_role')->where('archive_id',$id)->delete();
		$eventarchive = EventArchive::findOrFail($id);
		$eventarchive->delete();

		return redirect('admin/eventarchive')->with(['status' => 'success', 'msg' => 'Successfully added']);
    }

    public function status(Request $request,$type,$id)
    {
        $eventarchive = EventArchive::findOrFail($id);
        $eventarchive->status = $type;
        $eventarchive->save();

        return redirect('admin/eventarchive')->with(['status' => 'success','msg' => 'successfully added']);
    }
}
