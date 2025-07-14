<?php

namespace App\Models\QuizmasterModel;

use Illuminate\Database\Eloquent\Model;

class QuizTitleList extends Model
{
    protected $fillable = ['quiz_categories_id', 'name', 'description', 'icon', 'duration', 'status'];

    public function category()
    {
        return $this->belongsTo(QuizCategory::class, 'quiz_categories_id');
    }

    public function questions()
    {
        return $this->hasMany(QuizQuestionAnswer::class, 'quiz_title_list_id');
    }
}
