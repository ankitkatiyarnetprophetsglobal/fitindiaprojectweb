<?php

namespace App\Http\Controllers\Admin\Auth\QuizMaster;
use App\Models\QuizmasterModel\QuizCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuizCategoryController extends Controller
{
    public function index() {

        $categories = QuizCategory::paginate(10);
        return view('admin.Quizmaster.quiz_categories.index', compact('categories'));
    }

    public function create() {
        return view('admin.Quizmaster.quiz_categories.create');
    }

    public function store(Request $request) {
       $validated = $request->validate([
        'name' => 'required|string|max:255',
        'icon' => 'nullable|url',
        'lang' => 'required|string|max:10',
        'status' => 'nullable|boolean',
    ]);

    // Default to active if not explicitly passed
     // If checkbox is unchecked, status won't be in request → default to 0
    $validated['status'] = $request->has('status') ? 1 : 0;

    QuizCategory::create($validated);
        return redirect()->route('admin.quiz-categories.index')->with('success', 'Category created.');
    }

    public function edit($id) {
        $quizCategory = QuizCategory::findOrFail($id);
        return view('admin.Quizmaster.quiz_categories.edit', compact('quizCategory'));
    }

    public function update(Request $request, $id)
{
    $quizCategory = QuizCategory::findOrFail($id);

    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'icon' => 'nullable|url',
        'lang' => 'required|string|max:10',
        'status' => 'nullable|boolean',
    ]);

    // If checkbox is unchecked, status will be missing in request, so default to 0
    $validated['status'] = $request->has('status') ? 1 : 0;

    $quizCategory->update($validated);

    return redirect()->route('admin.quiz-categories.index')->with('success', 'Quiz category updated.');
}


    public function destroy($id) {
        QuizCategory::destroy($id);
        return back()->with('success', 'Deleted');
    }
}
