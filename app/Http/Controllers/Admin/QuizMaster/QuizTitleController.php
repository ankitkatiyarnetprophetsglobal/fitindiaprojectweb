<?php

namespace App\Http\Controllers\Admin\QuizMaster;
use App\Models\QuizmasterModel\QuizCategory;
use App\Models\QuizmasterModel\QuizTitleList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuizTitleController extends Controller
{
    public function index() {
        $titles = QuizTitleList::with('category')->paginate(10);
        return view('admin.Quizmaster.quiz_titles.index', compact('titles'));
    }

    public function create() {
        $categories = QuizCategory::all();
        return view('admin.Quizmaster.quiz_titles.create', compact('categories'));
    }

   public function store(Request $request)
{
    $request->validate([
        'quiz_categories_id' => 'required|exists:quiz_categories,id',
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'duration' => 'nullable|integer',
        'status' => 'required|boolean',
    ]);

    $quizTitle = new QuizTitleList();
    $quizTitle->quiz_categories_id = $request->quiz_categories_id;
    $quizTitle->name = $request->name;
    $quizTitle->description = $request->description;
    $quizTitle->duration = $request->duration;
    $quizTitle->status = $request->status;

    if ($request->hasFile('icon')) {
        $filePath = $request->file('icon')->store('quiz_icons', 'public');
        $quizTitle->icon = $filePath;
    } else {
        // Set default icon path when no file is uploaded
        $quizTitle->icon = 'quiz_icons/default.png'; // adjust this path as per your setup
    }

    $quizTitle->save();

    return redirect()->route('admin.quiz-titles.index')->with('success', 'Quiz Title created successfully!');
}


    public function edit($id) {
        $quiz = QuizTitleList::findOrFail($id);
        $categories = QuizCategory::all();
        return view('admin.Quizmaster.quiz_titles.edit', compact('quiz', 'categories'));
    }

   public function update(Request $request, QuizTitleList $quizTitle)
{
    $request->validate([
        'quiz_categories_id' => 'required|exists:quiz_categories,id',
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'duration' => 'nullable|integer',
        'status' => 'required|boolean',
    ]);

    $quizTitle->quiz_categories_id = $request->quiz_categories_id;
    $quizTitle->name = $request->name;
    $quizTitle->description = $request->description;
    $quizTitle->duration = $request->duration;
    $quizTitle->status = $request->status;

    if ($request->hasFile('icon')) {
    // Delete old icon if exists
    if ($quizTitle->icon && Storage::disk('public')->exists($quizTitle->icon)) {
        Storage::disk('public')->delete($quizTitle->icon);
    }

    // Store new icon
    $filePath = $request->file('icon')->store('quiz_icons', 'public');
    $quizTitle->icon = $filePath;
} else {
    // If icon is explicitly set to null (like from a checkbox or form input), assign default icon path
    if ($request->input('icon') === null) {
        // Delete old icon if exists
        if ($quizTitle->icon && Storage::disk('public')->exists($quizTitle->icon)) {
            Storage::disk('public')->delete($quizTitle->icon);
        }

        // Set default icon path
        $quizTitle->icon = 'quiz_icons/default.png'; // make sure this default image exists
    }
    // else: keep old icon as is
}

    $quizTitle->save();

    return redirect()->route('admin.quiz-titles.index')->with('success', 'Quiz Title updated successfully!');
}


    public function destroy($id) {
        QuizTitleList::destroy($id);
        return back()->with('success', 'Deleted');
    }
}
