<?php
/* namespace App\Http\Controllers;

use Illuminate\Http\Request; */

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;


class LocalizationController extends Controller
{
    public function lang($locale)
    { 
       // echo $locale; die;
        App::setLocale($locale);
        session()->put('locale', $locale);
        return redirect()->back();
    }
}
