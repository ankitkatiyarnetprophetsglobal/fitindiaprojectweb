<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiziymcontests extends Model
{
    use HasFactory;
    protected $table = 'quiz_iym_contests';
    protected $fillable = [
        'master_id',
        'associate_id',
        'question_id',
        'question_ans',
        'user_id',
        'user_name',
        'user_ans',
        'score',
        'sec',
        'date',
        'slot_in',
        'slot_over',
        'created_at'
    ];

}
