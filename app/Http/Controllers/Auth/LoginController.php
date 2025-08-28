<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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
        $this->middleware('auth')->only('logout');
    }

    protected function authenticated($request, $user)
    {
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        if ($user->role === 'mpdo') {
            return redirect()->route('mpdo.dashboard');
        }

        if ($user->role === 'bfp') {
            return redirect()->route('bfp.dashboard');
        }

        if ($user->role === 'user') {
            return redirect()->route('applicant.dashboard');
        }

        if($user->role === 'obo'){
            return redirect()->route('obo.dashboard');
        }

        if($user->role === 'treasurer'){
            return redirect()->route('treasurer.dashboard');
        }

        return redirect()->route('home');
    }

    public function logout(Request $request)
    {
        $user = Auth::user();

        if ($user && $user->role !== 'admin') {
            // Only update non-admin users
            $eloquentUser = \App\Models\User::find($user->id);
            if ($eloquentUser) {
                $eloquentUser->status = 'inactive';
                $eloquentUser->save();
            }
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
