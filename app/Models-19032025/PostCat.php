<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;
class PostCat extends Model
{
    use HasFactory;
    protected $fillable = ['id','name', 'image'];
        protected $appends  = ['posts'];
 
    public function getPostsAttribute(){
       return Post::where('post_category','LIKE',"%".$this->id."%")->get()->count();
    }


}
