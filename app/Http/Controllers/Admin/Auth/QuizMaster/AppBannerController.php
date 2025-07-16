<?php

namespace App\Http\Controllers\Admin\Auth\QuizMaster;
use App\Models\QuizmasterModel\AppBanner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AppBannerController extends Controller
{

public function index()
{
    $banners = AppBanner::orderBy('id', 'desc')->paginate(10);
    return view('admin.Quizmaster.app_banners.index', compact('banners'));
}

public function create()
{
    return view('admin.Quizmaster.app_banners.create');
}

public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string',
        'type' => 'required|in:s,c',
        'landing_url' => 'nullable|string',
        'banner_url' => 'required|url',
        'language' => 'required|string|max:5',
        'duration' => 'nullable|integer',
        'start_from' => 'nullable|date',
        'end_to' => 'nullable|date',
        'order' => 'required|integer',
        'status' => 'required|in:0,1',
    ]);

    AppBanner::create($request->all());

    return redirect()->route('admin.app_banners.index')->with('success', 'Banner added successfully!');
}

public function edit($id)
{
    $banner = AppBanner::findOrFail($id);
    return view('admin.Quizmaster.app_banners.edit', compact('banner'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string',
        'type' => 'required|in:s,c',
        'landing_url' => 'nullable|string',
        'banner_url' => 'required|url',
        'language' => 'required|string|max:5',
        'duration' => 'nullable|integer',
        'start_from' => 'nullable|date',
        'end_to' => 'nullable|date',
        'order' => 'required|integer',
        'status' => 'required|in:0,1',
    ]);

    $banner = AppBanner::findOrFail($id);
    $banner->update($request->all());

    return redirect()->route('admin.app_banners.index')->with('success', 'Banner updated successfully!');
}

public function destroy($id)
{
    AppBanner::destroy($id);
    return redirect()->route('admin.app_banners.index')->with('success', 'Banner deleted successfully!');
}

}
