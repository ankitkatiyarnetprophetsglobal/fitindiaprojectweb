<?php
namespace App\Http\Controllers\Admin\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\PostCat;
use App\Models\PostsComments;
use App\Models\Language;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;

class PostController extends Controller
{
    
    public function index(Request $request){
        
        try{            
            $post_category = PostCat::where('status','=',1)->get();
            
            if($request->input('search')=='search'){
                $postcategory = $request['postcategory']; 
                $search_txt = $request->postcategory;
                $posts = Post::select('id','title','post_category','description','image','post_category_wise','video_post','published','status')->with('getPostwiselanguage')->withCount('getPostwisecommentcount')->where('status','=',1)->where('post_category','LIKE','%'.$search_txt.'%')->orderBy('get_postwisecommentcount_count','DESC')->orderBy('id','DESC')->paginate(10);                
                $post_count = count($posts);

            }else {                                
                $postcategory = $request['postcategory'] = null;                
                $posts = Post::with('getPostwiselanguage')->withCount('getPostwisecommentcount')->where('status','=',1)->orderBy('get_postwisecommentcount_count','DESC')->orderBy('id','DESC')->paginate(10);
                $post_count = Post::where('status','=',1)->count();
            }
            return view('admin.posts.index',compact('posts','post_category','post_count','postcategory'));
        
        } catch(Exception $e) {

            return abort(404);            
		}
    }
    
    public function create(){        

        try{

            $post_cat = PostCat::where('status','=',1)->get(); 
            $language = Language::where('status','=','active')->get();                
            return view('admin.posts.create', compact('post_cat','language'));

        } catch(Exception $e){

            return abort(404);
        }
    }

    public function store(Request $request){
        
        try{

            $image = '';
            $year = date("Y/m"); 

            if($request->file('image')){
                $image = $request->file('image')->store($year,['disk'=> 'uploads']);
                $image = url('wp-content/uploads/'.$image);
            }

            if($request->post_category_wise == 'post_article'){
                
                $request->validate([
                    'title' => 'required',
                    'post_category' => 'required',        
                    'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                    'description' => 'required',
                    'language' => 'required',                
                ],[
                    'title.required' => 'Title field is required.',
                    'post_category.required' =>'Please select post category.',
                    'description.required' => 'The Description field is required.', 
                    'language.required' => 'The language field is required.',                     
                    'image.mimes' => 'Please upload jpg,png,jpeg,gif,svg',
                    'image.max' => 'Image size should not be more than 2 MB',
                    
                ]);

            }elseif($request->post_category_wise == 'video'){

                $request->validate([
                    'title' => 'required',
                    'post_category' => 'required',
                    'language' => 'required',                    
                    'video_post' => [
                        'required',
                        'url',
                        function ($attribute, $value, $fail) {
                            if (!preg_match('/(youtube.com|youtu.be)\/(watch)?(\?v=)?(\S+)?/', $value)) {
                                $fail(trans("general.not_youtube_url", ["name" => trans("general.url")]));
                            }
                        },
                    ],
                    'description' => 'required',
                ],[
                    'title.required' => 'Title field is required.',
                    'post_category.required' =>'Please select post category.',
                    'language.required' => 'The language field is required.', 
                    'description.required' => 'The Description field is required.', 
                    'video_post.required' => 'The video link is not valid field is required.', 
                ]);

            }            
            
            $post = new Post;
            $post->image = $image;
            $post->title = $request->title;
            $post->lang_slug = $request->language;
            $post->post_category = implode(',', $request->post_category);
            $post->description = $request->description;        
            $post->post_category_wise = $request->post_category_wise;        
            $post->video_post = $request->video_post;        
            $post->created_by = auth()->user()->id;        
            $post->published = 0;        
            $post->status = 1;        
            $post->save();
        
            return redirect()->route('admin.posts.index')
            ->with('success','Post has been created successfully.');

        }catch (Exception $ex){

            return abort(404);
        }  
    }
        
    public function show($id){
        try{

            $post = Post::with('getPostwisecomment')->findOrFail($id);       
            return view('admin.posts.show', compact('post'));

        }catch (Exception $ex){

            return abort(404);
        }  
    }
    
    public function edit($id){
           
        try{
        
            $post_cat = PostCat::where('status','=',1)->get();             
            $post = Post::findOrFail($id);        
            $language = Language::where('status','=','active')->get(); 
            return view('admin.posts.edit',compact('post','post_cat','language')); 
        
        }catch (Exception $ex){

            return abort(404);
        }            
    }
        
    public function SendToApproval($id){

        try{ 

            $category = Post::find($id);
            $category->published = 1;        
            $category->save();        
            return redirect()->route('admin.posts.index')->with('success','Post Send To Approval');   

        }catch (Exception $ex){

            return abort(404);

        }          
    }
    
    public function ReadyToPublish($id){
    
        try{ 
            // dd($id);                        
            // dd(11);
            $contents = File::get(base_path('config/fit-india-mobile-app.json'));
            $firebase = (new Factory)->withServiceAccount($contents);
            // Replace with the target device token
            $deviceToken = 'fi6NB9qUQReDCPYvkDj630:APA91bGNvHwhmZsd0fAqHQC2ZE2qDXs63h7aA7YQqdBRbRmmXRKZQXjr3AWNkqvllNFCuT_qa2pO3FOKqAs5E5CPPCtnCiGBBg2NwrNbK1HC_awWHYU9viY6l3tGzSgaBo8_WtduJFBQ'; 
            $messaging = $firebase->createMessaging();
            $message = CloudMessage::fromArray([
                'notification' => [
                    'title' => 'Hello from Firebase!',
                    'body' => 'This is a test notification.'
                ],
    
                'token' => $deviceToken
                // 'topic' => 'global'
            ]);
    
            $messaging->send($message);
            // $category = Post::find($id);
            // $category->published = 2;        
            // $category->save();        
            return redirect()->route('admin.posts.index')->with('success','Your Post Has Been Published');   

        }catch (Exception $ex){

            return abort(404);
        }     
    }

    public function Rejected($id){

        try{ 
        
            $category = Post::find($id);
            $category->published = 3;        
            $category->save();        
            return redirect()->route('admin.posts.index')->with('success','Your Post Has Been Published');   
        
        }catch (Exception $ex){

            return abort(404);

        }     
    }
   
    public function update(Request $request, $id){
        
        try{
            $image = '';
            $year = date("Y/m");
            
            $request->validate([
                'title' => 'required',
                'post_category' => 'required',
                'image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',                
                'description' => 'required',
            ],[
                'title.required' => 'Title field is required.',
                'post_category.required' =>'Please select post category.',            
                'image.mimes' => 'Please upload jpg,png,jpeg,gif,svg',
                'image.max' => 'Please upload max  2048 file',
                'description.required' => 'The block field is required.',
            ]); 	 
            
            if (isset($request->image)) {

                if($request->file('image')){

                    $image = $request->file('image')->store($year,['disk'=> 'uploads']);
                    $image = url('wp-content/uploads/'.$image);                
                }

                $post = Post::find($id);
                $post->title = $request->title;
                $post->lang_slug = $request->language;
                $post->post_category = implode(',', $request->post_category);
                $post->description = $request->description;
                $post->image = $image;
                $post->post_category_wise = $request->post_category_wise; 
                $post->video_post = $request->video_post;     
                $post->published = 0;
                $post->updated_by = auth()->user()->id;        
                $post->status = 1;  
                $post->save();

            }else{
                
                $post = Post::find($id);
                $post->title = $request->title;
                $post->lang_slug = $request->language;
                $post->post_category = implode(',', $request->post_category);
                $post->description = $request->description;            
                $post->post_category_wise = $request->post_category_wise; 
                $post->video_post = $request->video_post;     
                $post->published = 0;
                $post->updated_by = auth()->user()->id;        
                $post->status = 1;           
                $post->save();
            }        

            return redirect('admin/posts')->with(['status' => 'success' , 'msg' => 'Successfully Update']);

        }catch (Exception $ex){

            return abort(404);
        }
    }

    public function destroy(Request $request,Post $post){
        try{ 
        
            $category = Post::find($post->id);
            $category->status = 0;        
            $category->save();        
            return redirect()->route('admin.posts.index')->with('success','Post Deleted Successfully');   
        
        }catch (Exception $ex){

            return abort(404);
        }
    }

    public function PostCommentStatus($id,$commitstatus,$postid){

        try{
        
            $PostsComments = PostsComments::find($id);
            $PostsComments->comment_status = $commitstatus;            
            $PostsComments->save();
            $post_cat = PostCat::all();

            $post = Post::with('getPostwisecomment')->findOrFail($postid);        
            Session::flash('message', 'Comments Successfully Update'); 
            return view('admin.posts.show',compact('post','post_cat'));
        
        }catch (Exception $ex){

            return abort(404);

        }            
    }
}
