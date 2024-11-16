<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Kreait\Firebase\Auth as FirebaseAuth;
use Kreait\Firebase\Exception\Auth\EmailExists as FirebaseEmailExists;
use Kreait\Firebase\Factory;
use App\Models\Mahasiswa;
use App\Models\Reviewer;

class AuthController extends Controller
{
    protected $firebaseAuth;
    /**
     * Show the login form.
     */
    public function index()
    {
        if (Auth::check()) {
            return redirect()->route('beasiswa.index');
        }
        return view('pages.Auth.login');
    }

    /**
     * Handle login request.
     */
    public function login(Request $request)
    {
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

        $email = $request->input('email');
        $password = $request->input('password');

        try {
            $signInResult = $this->firebaseAuth->signInWithEmailAndPassword($email, $password);
            $firebaseUser = $this->firebaseAuth->getUser($signInResult->firebaseUserId());

            if ($firebaseUser->emailVerified) {
                $user = User::where('email', $email)->firstOrFail();
                $mhs = Mahasiswa::where('user_id',$user->user_id)->firstOrFail();
                if ($mhs) {
                    Auth::login($user);
                } else {
                    $reviewer = Reviewer::where('user_id', $user->user_id)->first();
                    if ($reviewer) {
                        Auth::login($user);
                    } else {
                        return back()->withErrors(['email' => 'User not found or invalid role.'])->onlyInput('email');
                    }
                }
                $request->session()->regenerate();

                return redirect()->intended('/beasiswa');
            } else {
                return back()->withErrors(['email' => 'Please verify your email before logging in.'])->onlyInput('email');
            }
        } catch (\Kreait\Firebase\Exception\Auth\InvalidPassword $e) {
            return back()->withErrors(['email' => 'Invalid email or password.'])->onlyInput('email');
        } catch (\Kreait\Firebase\Exception\Auth\FailedToVerifyToken $e) {
            return back()->withErrors(['email' => 'Failed to verify user token.'])->onlyInput('email');
        } catch (\Kreait\Firebase\Exception\Auth\EmailNotFound $e) {
            return back()->withErrors(['email' => 'Email not found.'])->onlyInput('email');
        } catch (\Exception $e) {
            return back()->withErrors(['email' => 'An error occurred during login. ' . $e->getMessage()])->onlyInput('email');
        }
    }


    public function __construct()
    {
        $credentialsFile = env('FIREBASE_CREDENTIALS');
        $firebase = (new Factory)->withServiceAccount($credentialsFile);

        $this->firebaseAuth = $firebase->createAuth();
    }

    public function register(Request $request)
    {

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

        $method = $request->input('method');
        $email = $request->input('email');
        $password = $request->input('password');

        if (strcasecmp($password, $request->input('password_confirmation')) != 0) {
            return response()->json(['error' => 'Konfirmasi password salah'], 409);
        }

        try {
            $firebaseUser = $this->firebaseAuth->createUserWithEmailAndPassword($email, $password);
            $this->firebaseAuth->sendEmailVerificationLink($firebaseUser->email);

            $user = User::create([
                'email' => $firebaseUser->email,
                'email_verified_at' => false,
            ]);

            return redirect()->route('auth.register-information',['id'=>$user->user_id]);

        } catch (FirebaseEmailExists $e) {
            return response()->json(['error' => 'Email already exists in Firebase'], 409);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Registration failed', 'details' => $e->getMessage()], 500);
        }
    }



    public function insertMahasiswaData(Request $request, string $id)
    {

        $request->validate([
            'nim' => 'required|string|size:9|unique:mahasiswa,nim',
            'semester' => 'required|integer|min:1|max:8',
            'tgl_lahir' => 'required|date',
            'prodi_id' => 'required|exists:prodi,id',
            'no_hp' => 'required|string|unique:mahasiswa,no_hp',
            'angkatan' => 'required|integer|digits:4',
        ]);



        // Create a new Mahasiswa record
        Mahasiswa::create([
            'user_id' => $id,
            'nim' => $request->nim,
            'semester' => $request->semester,
            'tgl_lahir' => $request->tgl_lahir,
            'prodi_id' => $request->prodi_id,
            'no_hp' => $request->no_hp,
            'angkatan' => $request->angkatan,
        ]);

        return redirect()->intended('/beasiswa');
    }


    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'auth_code' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['message' => 'Email tidak ditemukan!'], 400);
        }

        if ($request->auth_code !== '123456') {
            return response()->json(['message' => 'Kode autentikasi salah!'], 400);
        }

        Session::put('auth_email', $request->email);
        return response()->json(['message' => 'Verified!'], 200);
    }

    /**
     * Handle reset password submission.
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6|confirmed',
        ]);

        $email = Session::get('auth_email');
        if (!$email) {
            return response()->json(['message' => 'Unauthorized request. Please restart the process.'], 400);
        }

        $user = User::where('email', $email)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        Session::forget('auth_email');
        return response()->json(['message' => 'Password updated successfully!'], 200);
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

    public function getRegisterInformation()
    {

        return view('pages.Auth.register-information');

    }

    public function showRegistrationForm()
    {
        return view('pages.Auth.register'); // Path to your registration view file
    }

}
