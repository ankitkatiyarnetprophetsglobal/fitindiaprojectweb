<?php

namespace App\Http\Controllers\Admin\QuizMaster;
use App\Models\QuizmasterModel\QuizCategory;
use App\Models\QuizmasterModel\QuizTitleList;
use App\Models\QuizmasterModel\QuizQuestionAnswer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuizQuestionController extends Controller
{
    public function index() {
        $questions = QuizQuestionAnswer::with('quiz')->paginate(10);
        return view('admin.Quizmaster.quiz_questions.index', compact('questions'));
    }

    public function create() {
        $categories = QuizCategory::all();
        $quizzes = QuizTitleList::all();
        return view('admin.Quizmaster.quiz_questions.create', compact('categories', 'quizzes'));
    }

    public function store(Request $request) {
      $request->validate([
        'question' => 'required|string',
        'quiz_categories_id' => 'required|integer',
        'quiz_title_list_id' => 'required|integer',
        'option1' => 'required|string',
        'option2' => 'required|string',
        'option2' => 'required|string',
        'answer' => 'required|string',
        'mark' => 'required|integer', // ✅ validate mark is an integer
        'time' => 'required|integer', // ✅ validate mark is an integer
    ]);

        QuizQuestionAnswer::create($request->all());
        return redirect()->route('admin.quiz-questions.index')->with('success', 'Question added.');
    }

    public function edit($id) {
        $question = QuizQuestionAnswer::findOrFail($id);
        $categories = QuizCategory::all();
        $quizzes = QuizTitleList::all();
        return view('admin.Quizmaster.quiz_questions.edit', compact('question', 'categories', 'quizzes'));
    }

    public function update(Request $request, $id) {
    $request->validate([
        'question' => 'required|string',
        'quiz_categories_id' => 'required|integer',
        'quiz_title_list_id' => 'required|integer',
        'option1' => 'required|string',
        'option2' => 'required|string',
        'option2' => 'required|string',
        'answer' => 'required|string',
        'mark' => 'required|integer', // ✅ validate mark is an integer
        'time' => 'required|integer', // ✅ validate mark is an integer
    ]);
        $question = QuizQuestionAnswer::findOrFail($id);
        $question->update($request->all());
        return redirect()->route('admin.quiz-questions.index')->with('success', 'Updated.');
    }

    public function destroy($id) {
        QuizQuestionAnswer::destroy($id);
        return back()->with('success', 'Deleted');
    }
}
