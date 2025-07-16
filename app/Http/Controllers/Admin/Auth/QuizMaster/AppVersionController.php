<?php

namespace App\Http\Controllers\Admin\Auth\QuizMaster;
use App\Models\QuizmasterModel\AppVersion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AppVersionController extends Controller
{
    // List all versions
public function index() {
    $versions = AppVersion::all();
    return view('admin.Quizmaster.app_versions.index', compact('versions'));
}

// Show create form
public function create() {
    return view('admin.Quizmaster.app_versions.create');
}

// Store data
public function store(Request $request) {
    $request->validate([
        'name' => 'required|string',
        'platform' => 'required|integer',
        'version' => 'required|string',
        'type' => 'required|integer',
        'updateStatus' => 'required|integer',
        'status' => 'required|integer',
        'description' => 'nullable|string',
        'release_date' => 'required|date',
        'created_date' => 'required|date',
    ]);

    AppVersion::create($request->all());
    return redirect()->route('admin.app_versions.index')->with('success', 'Version created successfully');
}

// Edit form
public function edit($id) {
    $version = AppVersion::findOrFail($id);
    return view('admin.Quizmaster.app_versions.edit', compact('version'));
}

// Update data
public function update(Request $request, $id) {
    $request->validate([
        'name' => 'required|string',
        'platform' => 'required|integer',
        'version' => 'required|string',
        'type' => 'required|integer',
        'updateStatus' => 'required|integer',
        'status' => 'required|integer',
        'description' => 'nullable|string',
        'release_date' => 'required|date',
        'created_date' => 'required|date',
    ]);

    $version = AppVersion::findOrFail($id);
    $version->update($request->all());

    return redirect()->route('admin.app_versions.index')->with('success', 'Version updated successfully');
}

// Delete version
public function destroy($id) {
    AppVersion::destroy($id);
    return redirect()->route('admin.app_versions.index')->with('success', 'Version deleted successfully');
}

}
