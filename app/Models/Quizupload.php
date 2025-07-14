<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quizupload extends Model
{
    use HasFactory;
	
	protected $table = 'quizupload';
    public $timestamps = false;
    protected $fillable = ['user_id', 'mainimage', 'luckywinnerimage']; 
}
