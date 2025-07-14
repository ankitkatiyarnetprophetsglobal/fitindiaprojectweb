<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usermapping extends Model
{
    use HasFactory;
	protected $table ='user_mappings';

	protected $fillable = [
        'id',
        'user_id',        
        'register_for',
        'status',
        'register_on',
        'created_at',
        'updated_at'        
    ];
}
