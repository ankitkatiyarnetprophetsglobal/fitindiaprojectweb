<?php
namespace App\Http\Controllers\Admin\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\PostCat;
use App\Models\PostsComments;
use App\Models\Language;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
class PostController extends Controller
{

    public function index(Request $request){

        try{
            $post_category = PostCat::where('status','=',1)->get();

            if($request->input('search')=='search'){
                $postcategory = $request['postcategory'];
                $search_txt = $request->postcategory;
                // $posts = Post::select('id','title','post_category','description','image','post_category_wise','video_post','published','status')->where('status','=',1)->orderBy('id','desc')->where('post_category','LIKE','%'.$search_txt.'%')->paginate(10);
                // $posts = Post::select('id','title','post_category','description','image','post_category_wise','video_post','published','status')->with('getPostwiselanguage')->withCount('getPostwisecommentcount')->where('status','=',1)->where('post_category','LIKE','%'.$search_txt.'%')->orderBy('get_postwisecommentcount_count','DESC')->orderBy('published')->paginate(10);
                $posts = Post::select('id','title','post_category','description','image','post_category_wise','video_post','published','status')->with('getPostwiselanguage')->withCount('getPostwisecommentcount')->where('status','=',1)->where('post_category','LIKE','%'.$search_txt.'%')->orderBy('get_postwisecommentcount_count','DESC')->orderBy('id','DESC')->paginate(10);
                $post_count = count($posts);

            }else {
                $postcategory = $request['postcategory'] = null;
                // $posts = Post::with('getPostwisecommentcount')->where('status','=',1)->orderBy('id', 'DESC')->paginate(50);
                // $posts = Post::withCount('getPostwisecommentcount')->where('status','=',1)->orderBy('published')->orderBy('get_postwisecommentcount_count','DESC')->paginate(10);
                // $posts = Post::with('getPostwiselanguage')->withCount('getPostwisecommentcount')->where('status','=',1)->orderBy('published')->orderBy('get_postwisecommentcount_count','DESC')->paginate(10);
                // $posts = Post::with('getPostwiselanguage')->withCount('getPostwisecommentcount')->where('status','=',1)->orderBy('published')->orderBy('get_postwisecommentcount_count','DESC')->paginate(10);
                // $posts = Post::with('getPostwiselanguage')->withCount('getPostwisecommentcount')->where('status','=',1)->where('id','=',103)->orderBy('published')->orderBy('get_postwisecommentcount_count','DESC')->get();
                // $posts = Post::with('getPostwiselanguage')->withCount('getPostwisecommentcount')->where('status','=',1)->orderBy('get_postwisecommentcount_count','DESC')->orderBy('published')->paginate(10);
                $posts = Post::with('getPostwiselanguage')->withCount('getPostwisecommentcount')->where('status','=',1)->orderBy('get_postwisecommentcount_count','DESC')->orderBy('id','DESC')->paginate(10);

                // dd($posts);
                // dd($posts[0]['getPostwiselanguage'][0]['name']);
                $post_count = Post::where('status','=',1)->count();
            }
            return view('admin.posts.index',compact('posts','post_category','post_count','postcategory'));

        } catch(Exception $e) {

            dd($e->getMessage());
		}
    }

    public function create(){

        // $post_cat = PostCat::all();
        $post_cat = PostCat::where('status','=',1)->get();
        $language = Language::where('status','=','active')->get();
        return view('admin.posts.create', compact('post_cat','language'));

    }

    public function store(Request $request){

        // dd($request->all());
        $image = '';
        $year = date("Y/m");
        if($request->file('image'))
        {
            $image = $request->file('image')->store($year,['disk'=> 'uploads']);
            $image = url('wp-content/uploads/'.$image);
        }
		if($request->post_category_wise == 'post_article'){

            $request->validate([
                'title' => 'required',
                'post_category' => 'required',
                // 'image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                'description' => 'required',
                'language' => 'required',
            ],[
                'title.required' => 'Title field is required.',
                'post_category.required' =>'Please select post category.',
                'description.required' => 'The Description field is required.',
                'language.required' => 'The language field is required.',
                // 'image.required' =>'Post Image field is required.',
                'image.mimes' => 'Please upload jpg,png,jpeg,gif,svg',
                'image.max' => 'Image size should not be more than 2 MB',

            ]);
        }elseif($request->post_category_wise == 'video'){

            $request->validate([
                'title' => 'required',
                'post_category' => 'required',
                'language' => 'required',
                // 'image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                // 'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
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
                // 'video_post' => 'required',
            ],[
                'title.required' => 'Title field is required.',
                'post_category.required' =>'Please select post category.',
                'language.required' => 'The language field is required.',
                'description.required' => 'The Description field is required.',
                'video_post.required' => 'The video link is not valid field is required.',
                // 'image.required' =>'Post Image field is required.',
                // 'image.mimes' => 'Please upload jpg,png,jpeg,gif,svg',
                // 'image.max' => 'Image size should not be more than 2 MB',

            ]);

        }
        // dd($request->all());
        // dd(implode(',', $request->post_category));die;
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
    }

    public function show($id){
        // dd(123456);

        // $PostsComment = PostsComments::where("post_id","=",$id)->get();
        // dd($PostsComment);
        $post = Post::with('getPostwisecomment')->findOrFail($id);
        return view('admin.posts.show', compact('post'));
    }

    public function edit($id){
        // dd(13213131);
        $post_cat = PostCat::where('status','=',1)->get();
        // dd($post_cat);
        $post = Post::findOrFail($id);
        $language = Language::where('status','=','active')->get();
        // dd($language);
        // dd($post);
        return view('admin.posts.edit',compact('post','post_cat','language'));
    }

    public function SendToApproval($id){
        // dd($id);
        try{
            $category = Post::find($id);
            $category->published = 1;
            $category->save();
            return redirect()->route('admin.posts.index')->with('success','Post Send To Approval');
        } catch(Exception $e) {
            dd($e->getMessage());
            // $controller_name = 'PostsController';
            // $function_name = 'listshow';
            // $error_code = '901';
            // $error_message = $e->getMessage();
            // $send_payload = json_encode($request->all());
            // $response = null;
            // // $var = Helper::saverrorlogs($function_name,$controller_name,$error_code,$error_message,$send_payload,$response);3
            // $result = (new CommonController)->error_log($function_name,$controller_name,$error_code,$error_message,$response);

            // if(empty($request->Location)){
            //     return Response::json(array(
            //         'isSuccess' => 'false',
            //         'code'      => $error_code,
            //         'data'      => null,
            //         'message'   => $error_message
            //     ), 200);
            // }
		}
    }

    public function ReadyToPublish($id){
        // dd($id);
        try{
            $category = Post::find($id);
            $category->published = 2;
            $category->save();
            return redirect()->route('admin.posts.index')->with('success','Your Post Has Been Published');
        } catch(Exception $e) {
            dd($e->getMessage());
            // $controller_name = 'PostsController';
            // $function_name = 'listshow';
            // $error_code = '901';
            // $error_message = $e->getMessage();
            // $send_payload = json_encode($request->all());
            // $response = null;
            // // $var = Helper::saverrorlogs($function_name,$controller_name,$error_code,$error_message,$send_payload,$response);3
            // $result = (new CommonController)->error_log($function_name,$controller_name,$error_code,$error_message,$response);

            // if(empty($request->Location)){
            //     return Response::json(array(
            //         'isSuccess' => 'false',
            //         'code'      => $error_code,
            //         'data'      => null,
            //         'message'   => $error_message
            //     ), 200);
            // }
		}
    }

    public function Rejected($id){
        // dd($id);
        try{
            $category = Post::find($id);
            $category->published = 3;
            $category->save();
            return redirect()->route('admin.posts.index')->with('success','Your Post Has Been Published');
        } catch(Exception $e) {
            dd($e->getMessage());
            // $controller_name = 'PostsController';
            // $function_name = 'listshow';
            // $error_code = '901';
            // $error_message = $e->getMessage();
            // $send_payload = json_encode($request->all());
            // $response = null;
            // // $var = Helper::saverrorlogs($function_name,$controller_name,$error_code,$error_message,$send_payload,$response);3
            // $result = (new CommonController)->error_log($function_name,$controller_name,$error_code,$error_message,$response);

            // if(empty($request->Location)){
            //     return Response::json(array(
            //         'isSuccess' => 'false',
            //         'code'      => $error_code,
            //         'data'      => null,
            //         'message'   => $error_message
            //     ), 200);
            // }
		}
    }

    public function update(Request $request, $id){
        // dd($request->language);
        $image = '';
        $year = date("Y/m");

         /*$request->validate([
            'title' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'description' => 'required'
         ]);*/

		$request->validate([
            'title' => 'required',
            'post_category' => 'required',
            'image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            // 'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'description' => 'required',
        ],[
			'title.required' => 'Title field is required.',
			'post_category.required' =>'Please select post category.',
			// 'image.required' =>'Post Image field is required.',
			'image.mimes' => 'Please upload jpg,png,jpeg,gif,svg',
			'image.max' => 'Please upload max  2048 file',
			'description.required' => 'The block field is required.',
		]);
        // dd($request->all());
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



        //PostCat::whereId($id)->update($data);

        return redirect('admin/posts')->with(['status' => 'success' , 'msg' => 'Successfully Update']);
    }

    public function destroy(Request $request,Post $post){
        // dd($post->id);

        //   $post->delete();
        //    return redirect()->route('admin.posts.index')
        //     ->with('success','post deleted successfully');
        try{
            $category = Post::find($post->id);
            $category->status = 0;
            $category->save();
            return redirect()->route('admin.posts.index')->with('success','Post Deleted Successfully');
        } catch(Exception $e) {
            dd($e->getMessage());
            // $controller_name = 'PostsController';
            // $function_name = 'listshow';
            // $error_code = '901';
            // $error_message = $e->getMessage();
            // $send_payload = json_encode($request->all());
            // $response = null;
            // // $var = Helper::saverrorlogs($function_name,$controller_name,$error_code,$error_message,$send_payload,$response);3
            // $result = (new CommonController)->error_log($function_name,$controller_name,$error_code,$error_message,$response);

            // if(empty($request->Location)){
            //     return Response::json(array(
            //         'isSuccess' => 'false',
            //         'code'      => $error_code,
            //         'data'      => null,
            //         'message'   => $error_message
            //     ), 200);
            // }
        }

    }

    public function PostCommentStatus($id,$commitstatus,$postid){
        // dd($postid);
        $PostsComments = PostsComments::find($id);
        $PostsComments->comment_status = $commitstatus;
        $PostsComments->save();

        $post_cat = PostCat::all();
        // dd($post_cat);
        // $post = Post::findOrFail($id);
        $post = Post::with('getPostwisecomment')->findOrFail($postid);
        // dd($post);
        Session::flash('message', 'Comments Successfully Update');
        return view('admin.posts.show',compact('post','post_cat'));//->with(['status' => 'success' , 'message' => 'Comments Successfully Update']);
        // return redirect('admin/posts')->with(['status' => 'success' , 'msg' => 'Comments Successfully Update']);
    }
}
