<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-slate-50">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Verifikasi Email - {{ config('app.name', 'Laravel') }}</title>

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
                Verifikasi Email
            </h2>
            <p class="mt-2 text-center text-sm text-slate-600">
                Satu langkah lagi untuk mengaktifkan akun Anda.
            </p>
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-[480px]">
            <div class="bg-white/80 backdrop-blur-xl py-10 px-6 shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-slate-200/50 sm:rounded-2xl sm:px-12 text-center">
                
                <div class="mb-6 inline-flex items-center justify-center w-16 h-16 rounded-full bg-indigo-50 text-indigo-600">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                </div>

                @if (session('resent'))
                    <div class="mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-100 flex items-center gap-3 text-left">
                        <svg class="h-5 w-5 text-emerald-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <p class="text-sm font-medium text-emerald-800">
                            Link verifikasi baru telah dikirim ke email Anda.
                        </p>
                    </div>
                @endif

                <div class="space-y-4 text-slate-600">
                    <p class="text-base leading-relaxed">
                        Sebelum melanjutkan, silakan periksa email Anda untuk melihat tautan verifikasi.
                    </p>
                    <p class="text-sm">
                        Tidak menerima email? Tidak masalah.
                    </p>
                </div>

                <form class="mt-8" method="POST" action="{{ route('verification.resend') }}">
                    @csrf
                    <button type="submit" 
                        class="w-full flex justify-center py-3.5 px-4 border border-transparent text-sm font-bold rounded-xl text-white bg-slate-900 hover:bg-black focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-900 transition-all duration-200 shadow-md active:scale-[0.98]">
                        Kirim Ulang Email Verifikasi
                    </button>
                </form>

                <div class="mt-6">
                    <a href="{{ route('logout') }}" 
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                       class="text-sm font-semibold text-indigo-600 hover:text-indigo-500 transition-colors">
                        Keluar Akun
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                        @csrf
                    </form>
                </div>
            </div>
            
            <p class="mt-10 text-center text-xs text-slate-400 uppercase tracking-widest font-medium">
                &copy; {{ date('Y') }} {{ config('app.name') }}
            </p>
        </div>
    </div>
</body>
</html>