<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Session;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|string',
            'password' => 'required|string|min:6',
        ]);

        $loginType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $login = [
            $loginType => $request->username,
            'password' => $request->password
        ];

        if (auth()->attempt($login)) {
            //return redirect()->route('home')->with('success','Login successfully!');
            Session::put('username',$request->username);
            Session::put('login',TRUE);
            return redirect()->route('home')->with('success','Login successfully!');
            //alert($user[0]->name.'Selamat Datang Di Pouch Work','Success')->persistent("Close this");
        }
        return redirect()->route('login')->with(['error' => 'Email/Password salah!']);
    }

    public function logout(Request $request)
    {
        Session::flush();
        //Auth::guard($this->getGuard())->logout();
        return redirect()->route('login')->with('success','Logout successfully!');
    }
}
