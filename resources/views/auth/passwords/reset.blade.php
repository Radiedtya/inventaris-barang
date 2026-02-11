<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-slate-50">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Atur Ulang Kata Sandi - {{ config('app.name', 'Laravel') }}</title>

    <link rel="shortcut icon" href="{{ asset('smart-inven-removebg-preview.png') }}" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
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
                Atur Ulang Sandi
            </h2>
            <p class="mt-2 text-center text-sm text-slate-600">
                Silakan masukkan kata sandi baru Anda di bawah ini.
            </p>
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-[440px]">
            <div class="bg-white/80 backdrop-blur-xl py-10 px-6 shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-slate-200/50 sm:rounded-2xl sm:px-12">
                <form method="POST" action="{{ route('password.update') }}" class="space-y-5">
                    @csrf

                    <input type="hidden" name="token" value="{{ $token }}">

                    <div>
                        <label for="email" class="block text-sm font-semibold text-slate-700">Alamat Email</label>
                        <div class="mt-1.5">
                            <input id="email" type="email" name="email" value="{{ $email ?? old('email') }}" required readonly
                                class="block w-full px-4 py-3 rounded-xl border-slate-200 bg-slate-100/50 text-slate-500 cursor-not-allowed focus:ring-0 transition-all duration-200">
                        </div>
                        @error('email')
                            <p class="mt-1.5 text-sm text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-semibold text-slate-700">Kata Sandi Baru</label>
                        <div class="mt-1.5">
                            <input id="password" type="password" name="password" required autofocus autocomplete="new-password"
                                placeholder="••••••••"
                                class="block w-full px-4 py-3 rounded-xl border-slate-200 bg-slate-50/50 text-slate-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:bg-white transition-all duration-200 @error('password') border-red-500 @enderror">
                        </div>
                        @error('password')
                            <p class="mt-1.5 text-sm text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password-confirm" class="block text-sm font-semibold text-slate-700">Konfirmasi Sandi Baru</label>
                        <div class="mt-1.5">
                            <input id="password-confirm" type="password" name="password_confirmation" required autocomplete="new-password"
                                placeholder="••••••••"
                                class="block w-full px-4 py-3 rounded-xl border-slate-200 bg-slate-50/50 text-slate-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:bg-white transition-all duration-200">
                        </div>
                    </div>

                    <button type="submit" 
                        class="w-full flex justify-center py-3.5 px-4 border border-transparent text-sm font-bold rounded-xl text-white bg-slate-900 hover:bg-black focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-900 transition-all duration-200 shadow-md active:scale-[0.98]">
                        Simpan Sandi Baru
                    </button>
                </form>
            </div>
            
            <p class="mt-10 text-center text-xs text-slate-400 uppercase tracking-widest font-medium">
                &copy; {{ date('Y') }} {{ config('app.name') }}
            </p>
        </div>
    </div>
</body>
</html>