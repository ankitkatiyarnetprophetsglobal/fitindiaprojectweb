<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EpisodeQuizResult extends Model
{
    use HasFactory;
    protected $table ='episode_quiz_result';
    protected $fillable = [
                        'user_id',
                        'q_id', 
                        'choosed_option', 
                        'choosed_option_index', 
                        'ans', 
                        'episode'
                    ];
 protected $dateFormat = 'Y-m-d H:i:s.u';
}
