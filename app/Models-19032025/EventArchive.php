<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventArchive extends Model
{
    use HasFactory;	
	protected $table ='event_archive';	
	protected $fillable = [
		'title',
		'poster_image',		
		'link',	
		'language',	
		'start_date',	
		'end_date',	
		'status'			
	];  	
}
