<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;

class WebsiteBanner extends Model
{
    use HasFactory;
	protected $table ='website_banners';
	public $timestamps = false;
	
	protected $fillable = [
		'id',
		'name',
        'active_css',
        'landing_url',
		'banner_url',
		'language',
		'start_from',
		'end_to',
		'order',
		'status',		
		'created_at',
		'updated_at',		
	]; 


}
