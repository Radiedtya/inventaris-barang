<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('smart-inven-removebg-preview.png') }}" type="image/x-icon">
    <title>403 - Akses Dilarang</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }
        @keyframes float {
            0% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(-5deg); }
            100% { transform: translateY(0px) rotate(0deg); }
        }
        .floating { animation: float 5s ease-in-out infinite; }
        .bg-pastel-danger {
            background: radial-gradient(circle at top left, #fff1f2 0%, #f5f3ff 50%, #eff6ff 100%);
        }
    </style>
</head>
<body class="h-full antialiased bg-pastel-danger font-sans">
    <main class="relative min-h-full flex items-center justify-center px-6 overflow-hidden">
        
        <div class="absolute top-20 left-10 w-32 h-32 bg-rose-200/40 rounded-full blur-2xl"></div>
        <div class="absolute bottom-20 right-10 w-64 h-64 bg-indigo-200/40 rounded-full blur-3xl"></div>

        <div class="max-w-2xl w-full text-center relative">
            <div class="relative inline-block mb-8">
                <img src="https://cdni.iconscout.com/illustration/premium/thumb/access-denied-illustration-download-in-svg-png-gif-file-formats--forbidden-entry-no-admittance-security-pack-cyber-illustrations-6430773.png" 
                     alt="403 Illustration" 
                     class="w-64 sm:w-80 mx-auto floating drop-shadow-2xl">
                
                <div class="absolute -bottom-4 -right-4 bg-white px-6 py-2 rounded-2xl shadow-xl border-4 border-rose-50 transform -rotate-12">
                    <span class="text-4xl font-black text-rose-600">403</span>
                </div>
            </div>

            <h1 class="text-4xl sm:text-5xl font-black text-slate-800 tracking-tight mb-4">
                Eits, Mau ke Mana? ✋🚧
            </h1>
            <p class="text-lg text-slate-500 font-medium leading-relaxed max-w-md mx-auto mb-10">
                Maaf ya, halaman ini cuma boleh dimasukin sama **Administrator**. Kamu nggak punya kunci aksesnya nih!
            </p>

            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="/dashboard" class="w-full sm:w-auto px-10 py-4 bg-rose-600 text-white font-black rounded-2xl shadow-[0_10px_0_0_#e11d48] hover:shadow-[0_5px_0_0_#e11d48] hover:translate-y-[5px] transition-all duration-150 active:translate-y-[8px] active:shadow-none uppercase tracking-wider text-sm">
                    Balik ke Dashboard
                </a>
                
                <a href="javascript:history.back()" class="w-full sm:w-auto px-10 py-4 bg-white text-slate-600 font-black rounded-2xl border-2 border-slate-100 hover:bg-slate-50 transition-all duration-300 uppercase tracking-wider text-sm">
                    Kembali
                </a>
            </div>
        </div>

    </main>
</body>
</html>