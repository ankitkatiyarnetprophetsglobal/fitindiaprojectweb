<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;
    
    
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:admin')->except('logout');
    }


    public function showLoginForm(){

       return view('admin.login');
    }

   
    
    public function logout(Request $request)
    {
        $this->guard('admin')->logout();

        $request->session()->invalidate();

        return redirect()->route('admin.login');
    }   

    public function login(Request $request)
    { 
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6',
            'captcha' => ['required','captcha'],
        ],[
            'email.required' => 'The Email field is required.',
            'email.email' => 'Please enter the valid Email ID',
            'password.required' => 'The Password field is required.',
            'captcha.required' => 'The captcha field is required.',
            'captcha.captcha' => 'Invalid Captcha',
         ]  
        );

        if(Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password, 'status' => 1], $request->get('remember'))) {

            return redirect()->intended('/admin/dashboard');
        }

        return back()->with(['status' => 'success' , 'msg' => 'Invalid Credentials']);
    }
    
     protected function guard()
    {
        return Auth::guard('admin');
    }
    
    
    
}
