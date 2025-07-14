<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Webreward extends Model
{
    use HasFactory;
    protected $table ='organization_rewards';
    
    protected $fillable = [
        'award_group_type_id',
        'award_type_name',
        'awardee_id',
        'awardee_name',
        'awardee_image',
        'status',
        'created_at',
        'updated_at'        
    ];  
}
