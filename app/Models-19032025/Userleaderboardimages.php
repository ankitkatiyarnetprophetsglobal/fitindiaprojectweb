<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Userleaderboardimages extends Model
{
    use HasFactory;

    protected $table = 'user_leaderboard_images';
    protected $fillable = [
        'id', 
        'user_id', 
        'user_cycle_image', 
        'status', 
        'created_at', 
        'updated_at',        
    ]; 
}
