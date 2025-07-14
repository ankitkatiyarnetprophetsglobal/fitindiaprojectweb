<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeletedUsers extends Model
{
    use HasFactory;
    protected $table ='deletedusers';
	
    protected $fillable = [
        'id',
    	'user_id',
        'email',
        'phone',
        'request_date',
        'os_details',
        'status',
        'created_at',
        'updated_at',        
    ]; 
}