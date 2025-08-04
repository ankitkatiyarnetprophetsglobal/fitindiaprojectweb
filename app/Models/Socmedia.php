<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Socmedia extends Model
{
    use HasFactory;
    protected $table = 'socmedias';

    protected $fillable = [
        'id',
        'soc_info_id',
        'video_link',
        'photo',
        'status',
        'created_at',
        'updated_at',
    ];
}
