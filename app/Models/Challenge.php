<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Challenge extends Model
{
    use HasFactory;
    protected $table = 'challenge';
    public $timestamps = true;
    protected $fillable = [
	                       'from_userid', 
						   'from_email',
						   'to_userid',
						   'to_email',
						   'status',						   
						 ];
		
  
}
