<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('smart-inven-removebg-preview.png') }}" type="image/x-icon">
    <title>404</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @keyframes float {
            0% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(5deg); }
            100% { transform: translateY(0px) rotate(0deg); }
        }
        .floating { animation: float 6s ease-in-out infinite; }
        
        .bg-pastel {
            background: radial-gradient(circle at top left, #eef2ff 0%, #f5f3ff 50%, #fdf2f8 100%);
        }
    </style>
</head>
<body class="h-full antialiased bg-pastel font-sans">
    <main class="relative min-h-full flex items-center justify-center px-6 overflow-hidden">
        
        <div class="absolute top-20 left-10 w-32 h-32 bg-indigo-200/50 rounded-full blur-2xl"></div>
        <div class="absolute bottom-20 right-10 w-64 h-64 bg-pink-200/50 rounded-full blur-3xl"></div>

        <div class="max-w-2xl w-full text-center relative">
            <div class="relative inline-block mb-8">
                <img src="https://cdni.iconscout.com/illustration/premium/thumb/404-error-page-illustration-download-in-svg-png-gif-file-formats--no-results-found-empty-state-pack-network-communication-illustrations-6167035.png?f=webp" 
                     alt="404 Illustration" 
                     class="w-64 sm:w-80 mx-auto floating drop-shadow-2xl">
                
                <div class="absolute -bottom-4 -right-4 bg-white px-6 py-2 rounded-2xl shadow-xl border-4 border-indigo-50 transform rotate-12">
                    <span class="text-4xl font-black text-indigo-600">404</span>
                </div>
            </div>

            <h1 class="text-4xl sm:text-5xl font-black text-slate-800 tracking-tight mb-4">
                Yah, Nyasar Sampai Sini! 🫣
            </h1>
            <p class="text-lg text-slate-500 font-medium leading-relaxed max-w-md mx-auto mb-10">
                Halaman yang kamu cari nggak ada di database kita. Mungkin dia lagi main petak umpet? Yuk, aku anter balik ke rumah!
            </p>

            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="/" class="w-full sm:w-auto px-10 py-4 bg-indigo-600 text-white font-black rounded-2xl shadow-[0_10px_0_0_#4338ca] hover:shadow-[0_5px_0_0_#4338ca] hover:translate-y-[5px] transition-all duration-150 active:translate-y-[8px] active:shadow-none uppercase tracking-wider text-sm">
                    Gass Balik Beranda
                </a>
                
                <a href="javascript:history.back()" class="w-full sm:w-auto px-10 py-4 bg-white text-slate-600 font-black rounded-2xl border-2 border-slate-100 hover:bg-slate-50 transition-all duration-300 uppercase tracking-wider text-sm">
                    Kembali
                </a>
            </div>
        </div>

        <div class="absolute bottom-10 left-1/2 -translate-x-1/2 flex items-center gap-2 opacity-50">
            <div class="w-2 h-2 bg-indigo-500 rounded-full animate-pulse"></div>
            <span class="text-xs font-black text-slate-400 uppercase tracking-[0.3em]">RynDev Smart System</span>
        </div>
    </main>
</body>
</html>