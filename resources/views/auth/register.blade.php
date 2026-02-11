<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-slate-50">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="shortcut icon" href="{{ asset('smart-inven-removebg-preview.png') }}" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="antialiased text-slate-900">
    <div class="min-h-screen flex flex-col justify-center py-12 sm:px-6 lg:px-8 bg-[radial-gradient(#e5e7eb_1px,transparent_1px)] [background-size:16px_16px]">
        
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <div class="flex justify-center">
                <div class="bg-white p-3 rounded-2xl shadow-sm border border-slate-200/60">
                    <a href="/" class="hover:opacity-80 transition-opacity">
                        <img src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=600" alt="Logo" class="h-12 w-auto" />
                    </a>
                </div>
            </div>
            <h2 class="mt-6 text-center text-3xl font-extrabold tracking-tight text-slate-900">
                Buat Akun Baru
            </h2>
            <p class="mt-2 text-center text-sm text-slate-600">
                Bergabunglah dengan komunitas kami hari ini
            </p>
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-[480px]">
            <div class="bg-white/80 backdrop-blur-xl py-10 px-6 shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-slate-200/50 sm:rounded-2xl sm:px-12">
                <form method="POST" action="{{ route('register') }}" class="space-y-5">
                    @csrf

                    <div>
                        <label for="name" class="block text-sm font-semibold text-slate-700">Nama Lengkap</label>
                        <div class="mt-1.5">
                            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                                placeholder="Leon S Kennedy"
                                class="block w-full px-4 py-3 rounded-xl border-slate-200 bg-slate-50/50 text-slate-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:bg-white transition-all duration-200 placeholder:text-slate-400 @error('name') border-red-500 @enderror">
                        </div>
                        @error('name')
                            <p class="mt-1.5 text-sm text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-semibold text-slate-700">Alamat Email</label>
                        <div class="mt-1.5">
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required
                                placeholder="nama@contoh.com"
                                class="block w-full px-4 py-3 rounded-xl border-slate-200 bg-slate-50/50 text-slate-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:bg-white transition-all duration-200 placeholder:text-slate-400 @error('email') border-red-500 @enderror">
                        </div>
                        @error('email')
                            <p class="mt-1.5 text-sm text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="password" class="block text-sm font-semibold text-slate-700">Password</label>
                            <div class="mt-1.5">
                                <input id="password" type="password" name="password" required
                                    placeholder="••••••••"
                                    class="block w-full px-4 py-3 rounded-xl border-slate-200 bg-slate-50/50 text-slate-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:bg-white transition-all duration-200 placeholder:text-slate-400 @error('password') border-red-500 @enderror">
                            </div>
                        </div>
                        <div>
                            <label for="password-confirm" class="block text-sm font-semibold text-slate-700">Konfirmasi</label>
                            <div class="mt-1.5">
                                <input id="password-confirm" type="password" name="password_confirmation" required
                                    placeholder="••••••••"
                                    class="block w-full px-4 py-3 rounded-xl border-slate-200 bg-slate-50/50 text-slate-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:bg-white transition-all duration-200 placeholder:text-slate-400">
                            </div>
                        </div>
                    </div>
                    @error('password')
                        <p class="text-sm text-red-600 font-medium">{{ $message }}</p>
                    @enderror

                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input id="terms" name="terms" type="checkbox" required class="h-4 w-4 text-indigo-600 border-slate-300 rounded focus:ring-indigo-500 cursor-pointer">
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="terms" class="text-slate-600">Saya setuju dengan <a href="#" class="text-indigo-600 font-medium hover:underline">Syarat & Ketentuan</a></label>
                        </div>
                    </div>

                    <button type="submit" 
                        class="w-full flex justify-center py-3.5 px-4 border border-transparent text-sm font-bold rounded-xl text-white bg-slate-900 hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-900 transition-all duration-200 shadow-md active:scale-[0.98]">
                        Daftar Sekarang
                    </button>
                </form>

                <div class="mt-8">
                    <div class="relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-slate-200"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-3 bg-white text-slate-500 font-medium">Atau</span>
                        </div>
                    </div>

                    {{-- Login dengan Google --}}
                    <div class="mt-6">
                        <a href="{{ route('google.login') }}" 
                            class="w-full inline-flex items-center justify-center py-3.5 px-4 border border-slate-300 rounded-xl bg-white hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200 shadow-sm active:scale-[0.98]">
                            <svg class="me-2" width="20" height="20" viewBox="0 0 24 24">
                                <path
                                    fill="#4285F4"
                                    d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"
                                />
                                <path
                                    fill="#34A853"
                                    d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"
                                />
                                <path
                                    fill="#FBBC05"
                                    d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"
                                />
                                <path
                                    fill="#EA4335"
                                    d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"
                                />
                            </svg>
                            <span class="text-sm font-medium text-slate-700">Daftar dengan Google</span>
                        </a>
                    </div>

                    <div class="mt-6 text-center">
                        <span class="text-gray-500">Sudah punya akun?</span>
                        <a href="{{ route('login') }}" class="inline-flex items-center font-bold text-indigo-600 hover:text-indigo-500 transition-colors hover:underline">
                            Masuk
                        </a>
                    </div>
                </div>
            </div>
            
            <p class="mt-10 text-center text-xs text-slate-400 uppercase tracking-widest font-medium">
                &copy; {{ date('Y') }} {{ config('app.name') }}
            </p>
        </div>
    </div>
</body>
</html>