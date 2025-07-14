<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class WebsiteQuickChangeController extends Controller
{
    public function edit()
    {
        // dd("1231313131321");
         $banner = DB::table('website_banners')->where('id', 14)->first();
        return view('admin.generalevent.index',compact('banner'));
    }

    public function update(Request $request)
    {
        dd($request->all());
        $request->validate([
            'banner_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        dd($request->all());
        // generate unique file name
        $file = $request->file('banner_image');
        $filename = 'soc' . date('dmY') . '.' . $file->getClientOriginalExtension();
        // Define destination path inside public folder
        $destinationPath = public_path('banner');
        // Move the file to public/banner/
        $file->move($destinationPath, $filename);
        // Create public URL
        $publicUrl = url('public/banner/' . $filename);
        // update database (ID = 15)
        DB::table('website_banners')->where('id', 14)->update([
            'banner_url' => $publicUrl
        ]);

        return back()->with('success', 'Banner updated successfully!');
    }
}
