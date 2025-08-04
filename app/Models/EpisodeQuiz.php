<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EpisodeQuiz extends Model
{
    use HasFactory;
    protected $table ='episode_quiz';
    protected $fillable = [
                        'ques',
                        'opt1', 
                        'opt2', 
                        'opt3', 
                        'opt4', 
                        'ans'
                    ];


                    


}
