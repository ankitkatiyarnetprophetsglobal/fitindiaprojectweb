<?php
namespace App\Http\Controllers\Admin\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\PostCat;

class PostCatController extends Controller
{
    
    public function index(){

        //$categories = PostCat::all();
		$categories=PostCat::where("is_deleted","=",0)->orderBy('id', 'DESC')->paginate(50);	
		$categories_count = count($categories);
        return view('admin.category.index', compact('categories','categories_count'));
    }

    
    public function create(){

        // dd(1);   
        $categories = PostCat::all();
        // dd($categories);
        return view('admin.category.create');
    }

    
    public function store(Request $request){
        
        $image = '';
        $year = date("Y/m"); 
        if($request->file('image'))
        {
            $image = $request->file('image')->store($year,['disk'=> 'uploads']);
            $image = url('wp-content/uploads/'.$image);
        }
		
        $request->validate([
            'name' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
         ],[
			'name.required' => 'Category Name field is required.',			
			'image.required' =>'Category Image field is required.',
			'image.mimes' => 'Please upload jpg,png,jpeg,gif,svg',
			'image.max' => 'Please upload max  2048 file',
		]); 
		
        $category = new PostCat;
        $category->name = $request->name;
        $category->image = $image;
        $category->created_by = auth()->user()->id;
        $category->status = 1;
        $category->save();
     
        return redirect()->route('admin.category.index')
        ->with('success','Category has been created successfully.');
    }

   
    public function show(Post $post){

        return view('admin.category.show', compact('post'));

    }

    
    public function edit($id){

        $post = Post::where('post_category','LIKE',"%".$id."%")->get();
        $postcat = PostCat::findOrFail($id);        
        return view('admin.category.edit',compact('postcat','post'));

    }

    
    public function update(Request $request, $id){
        // dd($request->all());
        $image = '';
        $year = date("Y/m");         

        /*$request->validate([
            'name' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);*/
		
		$request->validate([
            'name' => 'required',
            // 'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
         ],[
			'name.required' => 'Category Name field is required.',			
			// 'image.required' =>'Category Image field is required.',
			'image.mimes' => 'Please upload jpg,png,jpeg,gif,svg',
			'image.max' => 'Please upload max  2048 file',
		]); 
		
		if (isset($request->image)) {

            if($request->file('image'))
            {
                $image = $request->file('image')->store($year,['disk'=> 'uploads']);
                $image = url('wp-content/uploads/'.$image);
            }

            $category = PostCat::find($id);
            $category->name = $request->name;
            $category->image = $image;
            $category->updated_by = auth()->user()->id;
            $category->status = $request->cat_status;
            $category->save();

        }else{
            
            $category = PostCat::find($id);
            $category->name = $request->name;            
            $category->updated_by = auth()->user()->id;
            $category->status = $request->cat_status;
            $category->save();
            
        }
        
        //PostCat::whereId($id)->update($data);

        return redirect('admin/category')->with(['status' => 'success' , 'msg' => 'Successfully added']);
    }

    
    public function destroy($id){
        // dd(())
        // $post=PostCat::findOrFail($id);
        // $post->delete();
        $category = PostCat::find($id);
        $category->is_deleted = 1;        
        $category->save(); 
        return redirect()->route('admin.category.index')->with('success','Category deleted successfully');
    }

    public function post_status(Request $request, $post_status, $id){
        $category = PostCat::findOrFail($id);
        $category->post_status = $post_status;
        $category->save();
        return redirect('admin/category')->with(['status ' => 'success', 'msg' => 'Added Successfully!!']);
    }
}
