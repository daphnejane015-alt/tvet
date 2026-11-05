<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(Request $request, $id, $hash): RedirectResponse
    {
        // Find the user by ID
        $user = User::findOrFail($id);

        // Check if user was created more than 60 minutes ago (link expiration)
        if ($user->created_at->diffInMinutes(Carbon::now()) > 60) {
            return redirect()->route('login')
                ->with('error', 'Pautan pengesahan telah tamat tempoh. Sila daftar semula atau minta pautan baharu.');
        }

        // Verify the hash matches the user's email
        if (!hash_equals(sha1($user->getEmailForVerification()), $hash)) {
            return redirect()->route('login')
                ->with('error', 'Pautan pengesahan tidak sah.');
        }

        // Check if already verified
        if ($user->hasVerifiedEmail()) {
            // Auto-login if already verified
            Auth::login($user);
            return redirect()->intended(RouteServiceProvider::HOME)
                ->with('status', 'Emel anda sudah disahkan. Anda kini log masuk.');
        }

        // Mark email as verified
        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        // Auto-login the user after successful verification
        Auth::login($user);

        // Redirect to dashboard with success message
        return redirect()->intended(RouteServiceProvider::HOME)
            ->with('status', 'Emel anda berjaya disahkan! Selamat datang ke AceTVET.');
    }
}
