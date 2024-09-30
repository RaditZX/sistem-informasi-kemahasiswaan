<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    /**
     * Show the login form.
     */
    public function index()
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            // Redirect authenticated user to the beasiswa page
            return redirect()->route('beasiswa.index');
        }

        // Return login view for unauthenticated users
        return view('pages.Auth.login');
    }

    /**
     * Handle login request.
     */
    public function login(Request $request)
    {
        // Validate form data
        $request->validate([
            'email' => [
                'required',
                'email',
                'regex:/^[a-zA-Z0-9._%+-]+@polban\.ac\.id$/',
            ],
            'password' => 'required|min:6',
        ], [
            'email.regex' => 'Gunakan email polban!',
        ]);

        // Attempt login
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            // Regenerate session to prevent fixation attacks
            $request->session()->regenerate();

            return redirect()->intended('/beasiswa');
        }

        // Login failed, redirect back with error
        return back()->withErrors([
            'email' => 'Email or password is incorrect.',
        ])->onlyInput('email');
    }

    /**
     * Handle forgot password form submission
     */
    public function forgotPassword(Request $request)
    {
        // Validate the email
        $request->validate([
            'email' => 'required|email',
        ]);

        // Check if the email exists in the database
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Email tidak ditemukan!']);
        }

        // Store a hardcoded auth code in the session for now
        $dummyCode = '123456'; // Hard-coded code
        Session::put('auth_code', $dummyCode);
        Session::put('auth_email', $request->email);

        return redirect()->route('password.reset')->with('message', 'Kode autentikasi telah dikirim ke email Anda.');
    }

    /**
     * Show the reset password form after verifying code
     */
    public function showResetPasswordForm()
    {
        if (!Session::has('auth_code')) {
            return redirect()->route('login');
        }

        return view('pages.Auth.reset-password');
    }

    /**
     * Handle authentication code verification and reset password form
     */
    public function verifyCode(Request $request)
    {
        // Validate input
        $request->validate([
            'auth_code' => 'required',
        ]);

        // Check if the code matches
        if ($request->auth_code !== Session::get('auth_code')) {
            return back()->withErrors(['auth_code' => 'Kode autentikasi tidak valid!']);
        }

        return redirect()->route('password.reset');
    }

    /**
     * Handle password reset
     */
    public function resetPassword(Request $request)
    {
        // Validate the input
        $request->validate([
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required',
        ]);

        // Ensure the email session exists
        $email = Session::get('auth_email');
        if (!$email) {
            return redirect()->route('login')->withErrors('Unauthorized request');
        }

        // Find the user by email and update password
        $user = User::where('email', $email)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        // Clear the session after the password reset
        Session::forget(['auth_code', 'auth_email']);

        return view('pages.Auth.success-password-reset');
    }

    /**
     * Logout the user.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
