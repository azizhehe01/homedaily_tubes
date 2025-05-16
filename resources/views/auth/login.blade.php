<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Daily</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('assets/images/iconlogo.svg') }}" type="image/x-icon">
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .error-message {
            color: #ef4444;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
    </style>
</head>

<body>
    <div class="flex flex-col min-h-screen md:flex-row">
        <!-- Left Section - Orange Background -->
        <div class="flex flex-col justify-between flex-1 p-8 bg-gradient-to-br from-orange-200 via-orange-400 to-orange-600 md:p-16">
            <!-- ... (bagian ini tetap sama) ... -->
            <div>
                <div class="flex items-center gap-2">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" class="w-auto h-8">
                </div>
            </div>
            <div class="my-auto">
                <h2 class="text-4xl italic font-light text-white md:text-5xl lg:text-6xl">
                    Welcome.
                    <br />
                    Start your journey
                    <br />
                    now with our
                    <br />
                    Services!
                </h2>
            </div>
            <div></div>
        </div>

        <!-- Right Section - Login Form -->
        <div class="flex flex-col justify-center flex-1 p-8 bg-white md:p-16">
            <div class="w-full max-w-md mx-auto">
                <h2 class="mb-8 text-3xl font-bold text-gray-800">Login</h2>

                @if(session('error'))
                <div class="p-4 mb-6 text-red-700 bg-red-100 rounded-md">
                    {{ session('error') }}
                </div>
                @endif

                <form method="POST" action="{{ route('auth.login') }}" class="space-y-6">
                    @csrf

                    <div class="space-y-2">
                        <label for="email" class="block text-gray-700">Email</label>
                        <input id="email" name="email" type="email" placeholder="balamia@gmail.com"
                            class="w-full px-4 py-3 border border-orange-200 rounded-md focus:border-orange-400 focus:outline-none"
                            value="{{ old('email') }}" />
                        @error('email')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="password" class="block text-gray-700">Password</label>
                        <div class="relative">
                            <input id="password" name="password" type="password" placeholder="Enter your password"
                                class="w-full px-4 py-3 border border-orange-200 rounded-md focus:border-orange-400 focus:outline-none" />
                            <button type="button" onclick="togglePassword()" class="absolute text-gray-500 -translate-y-1/2 right-3 top-1/2"
                                aria-label="Toggle password visibility">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                            </button>
                        </div>
                        @error('password')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit"
                        class="w-full py-3 font-medium text-white bg-orange-400 rounded-md hover:bg-orange-500 focus:outline-none">
                        Login
                    </button>
                </form>
                <!-- ... (bagian Google dan Register tetap sama) ... -->
                <a href="{{ route('google.login') }}" class="flex items-center justify-center w-full gap-2 py-3 mt-4 font-medium text-gray-600 border border-orange-200 rounded-md bg-orange-50 hover:bg-orange-100">
                    <!-- SVG Google Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 48 48">
                        <path fill="#FFC107"
                            d="M43.611 20.083H42V20H24v8h11.303c-1.649 4.657-6.08 8-11.303 8c-6.627 0-12-5.373-12-12s5.373-12 12-12c3.059 0 5.842 1.154 7.961 3.039l5.657-5.657C34.046 6.053 29.268 4 24 4C12.955 4 4 12.955 4 24s8.955 20 20 20s20-8.955 20-20c0-1.341-.138-2.65-.389-3.917z" />
                        <path fill="#FF3D00"
                            d="m6.306 14.691l6.571 4.819C14.655 15.108 18.961 12 24 12c3.059 0 5.842 1.154 7.961 3.039l5.657-5.657C34.046 6.053 29.268 4 24 4C16.318 4 9.656 8.337 6.306 14.691z" />
                        <path fill="#4CAF50"
                            d="M24 44c5.166 0 9.86-1.977 13.409-5.192l-6.19-5.238A11.91 11.91 0 0 1 24 36c-5.202 0-9.619-3.317-11.283-7.946l-6.522 5.025C9.505 39.556 16.227 44 24 44z" />
                        <path fill="#1976D2"
                            d="M43.611 20.083H42V20H24v8h11.303a12.04 12.04 0 0 1-4.087 5.571l.003-.002l6.19 5.238C36.971 39.205 44 34 44 24c0-1.341-.138-2.65-.389-3.917z" />
                    </svg>
                    Continue with Google
                </a>

                <div class="mt-6 text-center text-gray-500">
                    Belum Punya Akun?
                    <a href="{{ route('register') }}" class="font-medium text-orange-500 hover:underline">
                        Daftar Sekarang
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
        }
    </script>
</body>
</html>