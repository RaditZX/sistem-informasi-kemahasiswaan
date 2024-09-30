@extends('layouts.main')
@section('content')

<main class="flex items-center justify-center h-screen bg-gray-100">
    <section class="relative flex flex-col lg:flex-row w-full max-w-4xl h-auto lg:h-[30rem] rounded-3xl overflow-hidden shadow-lg">
        <!-- First Column (App Name + Background Image + Overlay) -->
        <div class="relative lg:w-1/2 w-full h-64 lg:h-full bg-cover bg-center flex items-start justify-center" style="background-image: url('{{ asset('assets/img/login/login-bg.png') }}');">
            <div class="absolute inset-0 bg-black opacity-30"></div>
            <div class="relative z-10 p-8">
                <h1 class="text-3xl font-bold text-white">
                    Sistem Informasi Kemahasiswaan Polban
                </h1>
            </div>
        </div>        

        <!-- Second Column (Login, Forgot Password, and Reset Password Forms) -->
        <div class="w-full lg:w-1/2 flex flex-col p-10 bg-white relative">
            <!-- Login Form (Default) -->
            <div id="loginForm" class="absolute inset-0 transition-transform duration-700 ease-in-out flex flex-col justify-between p-10 bg-white">
                <div class="title mb-6">
                    <h1 class="text-2xl font-bold">Login</h1>
                </div>
                
                <!-- Login Form -->
                <form method="POST" action="{{ route('login.submit') }}">
                    @csrf <!-- CSRF Token for security -->

                    <div class="space-y-5">
                        <div>
                            <label for="email" class="block pb-3 text-sm font-medium text-gray-700">Email</label>
                            <input type="email" name="email" id="email" class="focus:shadow-soft-primary-outline text-sm block w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-700 focus:border-fuchsia-300 focus:outline-none transition-shadow" placeholder="example@polban.ac.id" aria-label="Email" value="{{ old('email') }}">
                            @error('email')
                                <span class="text-red-500">{{ $message }}</span> <!-- Error message for email -->
                            @enderror
                        </div>
                        <div>
                            <label for="password" class="block pb-3 text-sm font-medium text-gray-700">Password</label>
                            <input type="password" name="password" id="password" class="focus:shadow-soft-primary-outline text-sm block w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-700 focus:border-fuchsia-300 focus:outline-none transition-shadow" placeholder="********" aria-label="Password">
                            @error('password')
                                <span class="text-red-500">{{ $message }}</span> <!-- Error message for password -->
                            @enderror
                            <span class="pt-2 block">Forgot your password? <a href="#" id="forgotPasswordLink" class="text-blue-500"><strong>Click here</strong></a></span>
                        </div>
                    </div>

                    <div class="mt-6">
                        <button type="submit" aria-label="Login to your account" class="inline-block w-full px-6 py-3 font-bold text-white uppercase transition-all bg-orange-500 hover:bg-orange-700 rounded-lg shadow-md hover:scale-105 hover:shadow-lg focus:ring-2 focus:ring-orange-400 focus:outline-none">
                            Login
                        </button>
                    </div>
                </form>
            </div>

            <!-- Forgot Password Form (Hidden initially) -->
            <div id="forgotPasswordForm" class="absolute inset-0 transform translate-x-full transition-transform duration-700 ease-in-out flex flex-col justify-between p-10 bg-white">
                <div class="title mb-6">
                    <h1 class="text-2xl font-bold">Forgot Password</h1>
                </div>
                <form method="POST" action="{{ route('password.forgot') }}">
                    @csrf
                    <div class="space-y-5"> 
                        <div>
                            <label for="reset-email" class="block pb-3 text-sm font-medium text-gray-700">Email</label>
                            <input type="email" name="email" id="reset-email" class="focus:shadow-soft-primary-outline text-sm block w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-700 focus:border-fuchsia-300 focus:outline-none transition-shadow" placeholder="example@polban.ac.id" aria-label="Email for password reset">
                            @error('email')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Authentication Code Section -->
                        <div>
                            <label for="auth_code" class="block pb-3 text-sm font-medium text-gray-700">Kode Autentikasi</label>
                            <input type="text" name="auth_code" id="auth_code" class="border border-gray-300 rounded-lg w-full px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="Kode Autentikasi" required>
                            @error('auth_code')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-6">
                        <button type="submit" id="verifyCodeButton" aria-label="Verify Code" class="inline-block w-full px-6 py-3 font-bold text-white uppercase transition-all bg-orange-500 hover:bg-orange-700 rounded-lg shadow-md hover:scale-105 hover:shadow-lg focus:ring-2 focus:ring-orange-400 focus:outline-none">
                            Verify Code
                        </button>
                    </div>
                </form>
                <div class="mt-4">
                    <a href="#" id="backToLogin" class="text-blue-500"><strong>Back to Login</strong></a>
                </div>
            </div>

            <!-- Reset Password Form (Initially Hidden) -->
            <div id="resetPasswordForm" class="absolute inset-0 transform translate-x-full transition-transform duration-700 ease-in-out flex flex-col justify-between p-10 bg-white hidden">
                <div class="title mb-6">
                    <h1 class="text-2xl font-bold">Reset Password</h1>
                </div>
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <div class="space-y-5">
                        <div>
                            <label for="password" class="block pb-3 text-sm font-medium text-gray-700">Password Baru</label>
                            <input type="password" name="password" id="password" class="focus:shadow-soft-primary-outline text-sm block w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-700 focus:border-fuchsia-300 focus:outline-none transition-shadow" placeholder="Masukkan Password Baru">
                            @error('password')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="password_confirmation" class="block pb-3 text-sm font-medium text-gray-700">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="focus:shadow-soft-primary-outline text-sm block w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-700 focus:border-fuchsia-300 focus:outline-none transition-shadow" placeholder="Konfirmasi Password">
                            @error('password_confirmation')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-6">
                        <button type="submit" aria-label="Reset Password" class="inline-block w-full px-6 py-3 font-bold text-white uppercase transition-all bg-orange-500 hover:bg-orange-700 rounded-lg shadow-md hover:scale-105 hover:shadow-lg focus:ring-2 focus:ring-orange-400 focus:outline-none">
                            Reset Password
                        </button>
                    </div>
                </form>
            </div>

            <!-- Success Message (Initially Hidden) -->
            <div id="resetSuccess" class="absolute inset-0 hidden flex flex-col justify-center items-center p-10 text-center">
                <h1 class="text-2xl font-bold mb-4">Lupa Password</h1>
                <p class="text-lg text-gray-700 mb-8">Password akun-mu berhasil diganti!</p>
                <a href="#" id="backToLoginAfterSuccess" class="text-blue-500"><strong>Kembali ke Login</strong></a>
            </div>
        </div>
    </section>
</main>

<script>
    const forgotPasswordLink = document.getElementById('forgotPasswordLink');
    const backToLogin = document.getElementById('backToLogin');
    const loginForm = document.getElementById('loginForm');
    const forgotPasswordForm = document.getElementById('forgotPasswordForm');
    const resetPasswordForm = document.getElementById('resetPasswordForm');
    const resetSuccess = document.getElementById('resetSuccess');
    const backToLoginAfterSuccess = document.getElementById('backToLoginAfterSuccess');

    // Slide in Forgot Password form
    forgotPasswordLink.addEventListener('click', function (event) {
        event.preventDefault();
        forgotPasswordForm.classList.remove('hidden');
        setTimeout(() => {
            loginForm.classList.add('translate-x-full');
            forgotPasswordForm.classList.remove('translate-x-full');
        }, 50);
    });

    // Slide back to Login form from Forgot Password
    backToLogin.addEventListener('click', function (event) {
        event.preventDefault();
        loginForm.classList.remove('translate-x-full');
        forgotPasswordForm.classList.add('translate-x-full');
    });

    // Slide to Reset Password Form after code verification
    document.getElementById('verifyCodeButton').addEventListener('click', function (event) {
        event.preventDefault(); // Prevent default form submission behavior
        
        console.log('Verify Code button clicked'); // Debugging: Check if this runs
        
        // Hide Forgot Password form and show Reset Password form
        forgotPasswordForm.classList.add('hidden');
        resetPasswordForm.classList.remove('hidden');
        resetPasswordForm.classList.remove('translate-x-full'); // Ensure it's not translated out of view
        console.log('Transitioned to Reset Password form'); // Debugging: Check if this runs
    });

    // After resetting password, show success message
    document.querySelector('#resetPasswordForm button[type="submit"]').addEventListener('click', function (event) {
        event.preventDefault();
        resetPasswordForm.classList.add('hidden');
        resetSuccess.classList.remove('hidden');
    });

    // Back to login from success message
    backToLoginAfterSuccess.addEventListener('click', function (event) {
        event.preventDefault();
        resetSuccess.classList.add('hidden');
        loginForm.classList.remove('translate-x-full');
    });
</script>

@endsection