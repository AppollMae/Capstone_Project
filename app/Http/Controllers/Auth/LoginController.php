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
        switch (strtolower($user->role)) {
            case 'admin':
                return redirect()->route('admin.dashboard');

            case 'mpdo':
                return redirect()->route('mpdo.dashboard');

            case 'bfp':
                return redirect()->route('bfp.dashboard');

            case 'user':
                return redirect()->route('applicant.dashboard');

            case 'obo':
                return redirect()->route('obo.dashboard');

            case 'treasurer':
                return redirect()->route('treasurer.dashboard');
            
            case 'bfp_inspector':
                return redirect()->route('bfp.dashboard');

            default:
                return redirect()->route('login'); // 👈 changed from 'home'
        }
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
