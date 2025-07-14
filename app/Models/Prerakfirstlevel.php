<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Prerakfirstlevel extends Model
{
        use HasFactory;
        protected $table ='prerak_first_levels';
        protected $fillable = [
            'user_id',
            'name',
            'email',
            'contact',
            'designation',
            'state_name',
            'state_id',
            'district_name',
            'district_id',
            'block_name',
            'block_id',
            'pincode',
            'image',
            'facebook_profile',
            'facebook_profile_followers',
            'twitter_profile',
            'twitter_profile_followers',
            'instagram_profile',
            'instagram_profile_followers',
            'work_profession',
            'description',
            'status',  
            'user_checker', 
            'updated_by',
            'reason',   
            'created_at'  
        ];
}
