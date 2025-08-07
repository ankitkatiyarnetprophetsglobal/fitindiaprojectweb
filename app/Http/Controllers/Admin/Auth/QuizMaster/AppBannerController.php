<?php

namespace App\Http\Controllers\Admin\Auth\QuizMaster;
use App\Models\QuizmasterModel\AppBanner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;
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
    
    try {
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

    return redirect()
        ->route('admin.app_banners.index')
        ->with('success', 'Banner added successfully!');
} catch (\Illuminate\Validation\ValidationException $e) {
    dd($e->validator);
    return redirect()
        ->back()
        ->withErrors($e->validator)
        ->withInput();
} catch (QueryException $e) {
    dd($e->getMessage());
    Log::error('Database Error while creating AppBanner: '.$e->getMessage());
    return redirect()
        ->back()
        ->with('error', 'Database error occurred. Please try again later.')
        ->withInput();
} catch (\Exception $e) {
    dd($e->getMessage());
    Log::error('Unexpected Error while creating AppBanner: '.$e->getMessage());
    return redirect()
        ->back()
        ->with('error', 'Something went wrong. Please try again later.')
        ->withInput();
}
}

public function edit($id)
{
    $banner = AppBanner::findOrFail($id);
    return view('admin.Quizmaster.app_banners.edit', compact('banner'));
}

public function update(Request $request, $id)
{
    try {
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
    // dd($banner);
    $banner->update($request->all());



    return redirect()->route('admin.app_banners.index')->with('success', 'Banner updated successfully!');
    } catch (\Illuminate\Validation\ValidationException $e) {
    dd($e->validator);
    return redirect()
        ->back()
        ->withErrors($e->validator)
        ->withInput();
} catch (QueryException $e) {
    dd($e->getMessage());
    Log::error('Database Error while creating AppBanner: '.$e->getMessage());
    return redirect()
        ->back()
        ->with('error', 'Database error occurred. Please try again later.')
        ->withInput();
} catch (\Exception $e) {
    dd($e->getMessage());
    Log::error('Unexpected Error while creating AppBanner: '.$e->getMessage());
    return redirect()
        ->back()
        ->with('error', 'Something went wrong. Please try again later.')
        ->withInput();
}
}

public function destroy($id)
{
    AppBanner::destroy($id);
    return redirect()->route('admin.app_banners.index')->with('success', 'Banner deleted successfully!');
}

}
