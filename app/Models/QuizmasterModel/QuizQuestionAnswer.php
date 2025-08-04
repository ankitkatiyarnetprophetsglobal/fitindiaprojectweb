<?php

namespace App\Models\QuizmasterModel;

use Illuminate\Database\Eloquent\Model;

class QuizQuestionAnswer extends Model
{
       protected $table = 'quiz_master_question_answers';
    protected $fillable = [
        'quiz_categories_id', 'quiz_title_list_id', 'question',
        'option1', 'option2', 'option3', 'option4', 'option5',
        'answer', 'ans_remark', 'mark', 'time', 'lang', 'status'
    ];
    protected static function booted()
    {
        static::creating(function ($model) {
            if (is_null($model->mark)) {
                $model->mark = 1; // Set default mark
            }
        });
    }
    public function quiz()
    {
        return $this->belongsTo(QuizTitleList::class, 'quiz_title_list_id');
    }
}
