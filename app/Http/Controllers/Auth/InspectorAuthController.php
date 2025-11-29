<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InspectorAuthController extends Controller
{
    
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('inspector')->attempt($credentials, $request->filled('remember'))) {
            return redirect()->route('bfp.dashboard'); // both BFP & inspector share this dashboard
        }

        return back()->withErrors([
            'email' => 'Invalid inspector credentials.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('inspector')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('inspector.login');
    }
}
