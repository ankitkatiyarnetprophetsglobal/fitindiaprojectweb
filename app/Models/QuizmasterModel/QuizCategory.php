<?php

namespace App\Models\QuizmasterModel;

use Illuminate\Database\Eloquent\Model;

class QuizCategory extends Model
{
    protected $fillable = ['name', 'icon', 'lang', 'status'];

    public function quizzes()
    {
        return $this->hasMany(QuizTitleList::class, 'quiz_categories_id');
    }
}
