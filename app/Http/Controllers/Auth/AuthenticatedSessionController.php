<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(Request $request): View
    {
        $role = $request->query('role', 'student');
        return view('auth.login', compact('role'));
    }

    /**
     * Display the dedicated admin login view.
     */
    public function createAdmin(): View
    {
        $role = 'admin';
        return view('auth.login', compact('role'));
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $loginType = $request->input('login_type', 'student');

        // Jika log masuk di tab Admin tetapi akaun bukan admin
        if ($loginType === 'admin' && !$request->user()->isAdmin()) {
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('admin.login')->withErrors([
                'email' => 'Akaun ini adalah akaun pelajar dan tidak mempunyai kebenaran akses Pentadbir. Sila gunakan tab "Log Masuk Pelajar".',
            ])->withInput($request->only('email'));
        }

        $request->session()->regenerate();

        if ($request->user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->intended(route('dashboard'));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
