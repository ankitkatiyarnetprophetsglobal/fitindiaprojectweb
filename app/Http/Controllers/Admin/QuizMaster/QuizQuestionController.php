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
        $questions = QuizQuestionAnswer::with('quiz')->get();
        return view('admin.Quizmaster.quiz_questions.index', compact('questions'));
    }

    public function create() {
        $categories = QuizCategory::all();
        $titles = QuizTitleList::all();
        return view('admin.Quizmaster.quiz_questions.create', compact('categories', 'titles'));
    }

    public function store(Request $request) {

        $request->validate([
            'question' => 'required',
            'quiz_categories_id' => 'required|exists:quiz_categories,id',
            'quiz_title_list_id' => 'required|exists:quiz_titles,id',
            'option1' => 'required',
            'option2' => 'required',
            'answer' => 'required',
            'ans_remark' => 'nullable|string',
            'mark' => 'required|integer|min:0',
            'time' => 'required|date_format:H:i',
            'lang' => 'nullable|string|max:10',
            'status' => 'boolean',
        ]);

        $data = $request->all();

        // Ensure status is set (checkbox may be missing if unchecked)
        $data['status'] = $request->has('status') ? 1 : 0;

        QuizQuestionAnswer::create($data);
        return redirect()->route('admin.quiz-questions.index')->with('success', 'Question added.');
    }

    public function edit($id) {
        $question = QuizQuestionAnswer::findOrFail($id);
        $categories = QuizCategory::all();
        $quizzes = QuizTitleList::all();
        return view('admin.Quizmaster.quiz_questions.edit', compact('question', 'categories', 'quizzes'));
    }

    public function update(Request $request, $id) {
        $question = QuizQuestionAnswer::findOrFail($id);
        $question->update($request->all());
        return redirect()->route('admin.quiz-questions.index')->with('success', 'Updated.');
    }

    public function destroy($id) {
        QuizQuestionAnswer::destroy($id);
        return back()->with('success', 'Deleted');
    }
}
