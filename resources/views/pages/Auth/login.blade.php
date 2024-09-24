@extends('layouts.main')
@section('content')

<main class="flex items-center justify-center h-screen bg-gray-100">
    <section class="relative flex flex-col lg:flex-row w-full max-w-4xl h-auto lg:h-[30rem] rounded-3xl overflow-hidden shadow-lg">
        <!-- First Column (App Name + Background Image + Overlay) -->
        <div class="relative lg:w-1/2 w-full h-64 lg:h-full bg-cover bg-center" style="background-image: url('{{ asset('assets/img/login/login-bg.png') }}');">
            <!-- Black overlay with 50% opacity -->
            <div class="absolute inset-0 bg-black opacity-30"></div>
            <!-- App Name at the Top -->
            <div class="relative z-10 p-8">
                <h1 class="text-3xl font-bold text-white">
                    Sistem Informasi Kemahasiswaan Polban
                </h1>
            </div>
        </div>

        <!-- Second Column (Login and Forgot Password Forms) -->
        <div class="w-full lg:w-1/2 flex flex-col p-10 bg-white relative">
            <!-- Login Form (Default) -->
            <div id="loginForm" class="flex-grow flex flex-col justify-between transition-transform duration-500">
                <div class="title mb-6">
                    <h1 class="text-2xl font-bold">Login</h1>
                </div>
                <div class="space-y-5 mb-[4rem]"> 
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" id="email" class="focus:shadow-soft-primary-outline text-sm block w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-700 focus:border-fuchsia-300 focus:outline-none transition-shadow" placeholder="example@polban.ac.id" aria-label="Email">
                    </div>
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <input type="password" id="password" class="focus:shadow-soft-primary-outline text-sm block w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-700 focus:border-fuchsia-300 focus:outline-none transition-shadow" placeholder="********" aria-label="Password">
                        <span class="pt-2 block">Lupa password? <a href="#" id="forgotPasswordLink" class="text-blue-500"><strong>Klik disini</strong></a></span>
                    </div>
                </div>
                <div class="mt-2">
                    <button type="submit" aria-label="Login to your account" class="inline-block w-full px-6 py-3 font-bold text-white uppercase transition-all bg-[#FF9A36] rounded-lg shadow-md hover:scale-105 hover:shadow-lg focus:ring-2 focus:ring-blue-400 focus:outline-none">
                        Login
                    </button>
                </div>
            </div>

            <!-- Forgot Password Form (Hidden initially) -->
            <div id="forgotPasswordForm" class="absolute inset-0 transform translate-x-full transition-transform duration-500 flex flex-col justify-between bg-white p-10">
                <div class="title mb-6">
                    <h1 class="text-2xl font-bold">Forgot Password</h1>
                </div>
                <div class="space-y-5"> 
                    <div>
                        <label for="reset-email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" id="reset-email" class="focus:shadow-soft-primary-outline text-sm block w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-700 focus:border-fuchsia-300 focus:outline-none transition-shadow" placeholder="example@polban.ac.id" aria-label="Email for password reset">
                    </div>
                </div>
                <div class="mt-2">
                    <button type="submit" aria-label="Send password reset link" class="inline-block w-full px-6 py-3 font-bold text-white uppercase transition-all bg-gradient-to-tl from-blue-600 to-cyan-400 rounded-lg shadow-md hover:scale-105 hover:shadow-lg focus:ring-2 focus:ring-blue-400 focus:outline-none">
                        Send Reset Link
                    </button>
                </div>
                <div class="mt-4">
                    <a href="#" id="backToLogin" class="text-blue-500"><strong>Back to Login</strong></a>
                </div>
            </div>
        </div>
    </section>
</main>

<script>
    const forgotPasswordLink = document.getElementById('forgotPasswordLink');
    const backToLogin = document.getElementById('backToLogin');
    const loginForm = document.getElementById('loginForm');
    const forgotPasswordForm = document.getElementById('forgotPasswordForm');

    // Slide in Forgot Password form
    forgotPasswordLink.addEventListener('click', function (event) {
        event.preventDefault();
        loginForm.classList.add('translate-x-full');
        forgotPasswordForm.classList.remove('translate-x-full');
    });

    // Slide back to Login form
    backToLogin.addEventListener('click', function (event) {
        event.preventDefault();
        loginForm.classList.remove('translate-x-full');
        forgotPasswordForm.classList.add('translate-x-full');
    });
</script>

@endsection
