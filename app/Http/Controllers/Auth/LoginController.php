<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
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
    // protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function showLoginForm() {
        return view('admin/auth/login');
    }

    public function login(Request $request) {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
            ]);

        $credentials = ['email' => $request->email, 'password' => $request->password];
        //attemp to login 
        if (Auth::guard('web')->attempt($credentials,$request->remember)) {
            //if successful redirect to dashboard
            return redirect()->intended(route('dashboard.index'));
        }
        //if unsuccessful redirect to login form
            return redirect()->back()->withInput($request->only('email', 'remember'));
    }

    public function logout(Request $request) {
        $this->guard()->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect('/');
    }

    protected function guard() {
        return Auth::guard();
    }
}
