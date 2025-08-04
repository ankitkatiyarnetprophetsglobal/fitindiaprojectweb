<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PostCat;
use App\Models\PostsComments;
use App\Models\Language;

class Post extends Model
{
    
    use HasFactory;
    protected $fillable = ['title','lang_slug', 'description', 'post_category', 'image', 'video_post'];
    // protected $appends = ['postcat'];

// public function PostCat(){
//     dd($this);
//     return $this->hasMany(PostCat::class,'id','post_category');
// }



//     public function getPostcatAttributes(){
//       $ids = $this->getOriginal('post_category');
       
//        return PostCat::whereIn('id',explode(',',$ids))->get();
//         //return $this->hasMany(PostCat::class,'id','post_category_id');
//     }

    public function getPostCategoryAttribute($value){
        return PostCat::select('id','name')->whereIn('id',explode(',',$value))->get();
    }
    
    public function getPostwisecomment(){
        return $this->hasMany(PostsComments::class,'post_id','id');
        // return $this->hasMany(PostsComments::class,'post_id','id')->where('comment_status',true);
    }
    
    public function getPostwisecommentcount(){        
        return $this->hasMany(PostsComments::class,'post_id','id')->where('comment_status',false);
    }
    
    public function getPostwiselanguage(){        
        return $this->hasMany(Language::class,'lang_slug','lang_slug');
    }
    
}
