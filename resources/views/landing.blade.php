<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>e-Library</title>
    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://unpkg.com/tailwindcss@3.4.3/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="min-h-screen flex flex-col items-center justify-center bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] dark:text-[#EDEDEC] transition-colors">
    <main class="flex flex-col items-center justify-center w-full px-4 py-10">
        <div class="flex flex-col items-center mb-8">
            <div class="rounded-xl p-4 mb-4 shadow-lg bg-zinc-100 dark:bg-zinc-800 flex items-center justify-center" style="width: 72px; height: 72px;">
                <svg class="w-12 h-12 text-blue-600 dark:text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M12 7v14" />
                    <path d="M16 12h2" />
                    <path d="M16 8h2" />
                    <path d="M3 18a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h5a4 4 0 0 1 4 4 4 4 0 0 1 4-4h5a1 1 0 0 1 1 1v13a1 1 0 0 1-1 1h-6a3 3 0 0 0-3 3 3 3 0 0 0-3-3z" />
                    <path d="M6 12h2" />
                    <path d="M6 8h2" />
                </svg>
            </div>
            <h1 class="text-3xl font-bold mb-2 tracking-tight">e-Library</h1>
            <p class="text-lg text-zinc-600 dark:text-zinc-400 mb-2 text-center max-w-md">Temukan &amp; Pinjam Buku Favoritmu Secara Digital</p>
        </div>
        <div class="flex gap-4 mb-8">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="px-6 py-2 rounded-lg bg-blue-600 text-white font-semibold shadow hover:bg-blue-700 transition">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="px-6 py-2 rounded-lg bg-blue-600 text-white font-semibold shadow hover:bg-blue-700 transition">Masuk</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="px-6 py-2 rounded-lg border border-blue-600 text-blue-600 font-semibold shadow hover:bg-blue-600 hover:text-white transition">Daftar</a>
                    @endif
                @endauth
            @endif
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-2xl w-full mt-4">
            <div class="flex flex-col items-center p-6 bg-white/80 dark:bg-zinc-900 rounded-lg shadow">
                <svg class="w-8 h-8 mb-2 text-blue-600 dark:text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 17V6.5A2.5 2.5 0 0 1 9 4h11"/><path d="M20 4v13"/></svg>
                <span class="font-semibold mb-1">Akses Ribuan Buku</span>
                <span class="text-sm text-zinc-500 dark:text-zinc-400 text-center">Koleksi digital lengkap, update setiap saat.</span>
            </div>
            <div class="flex flex-col items-center p-6 bg-white/80 dark:bg-zinc-900 rounded-lg shadow">
                <svg class="w-8 h-8 mb-2 text-blue-600 dark:text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M8 17v-1a4 4 0 0 1 8 0v1"/><rect width="20" height="12" x="2" y="7" rx="2"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                <span class="font-semibold mb-1">Pinjam Mudah &amp; Cepat</span>
                <span class="text-sm text-zinc-500 dark:text-zinc-400 text-center">Proses peminjaman online, tanpa ribet.</span>
            </div>
            <div class="flex flex-col items-center p-6 bg-white/80 dark:bg-zinc-900 rounded-lg shadow">
                <svg class="w-8 h-8 mb-2 text-blue-600 dark:text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 21l-1-1c-5-4.55-8-7.28-8-10.5A5.5 5.5 0 0 1 12 4a5.5 5.5 0 0 1 9 5.5c0 3.22-3 5.95-8 10.5l-1 1z"/></svg>
                <span class="font-semibold mb-1">Favoritkan Koleksi</span>
                <span class="text-sm text-zinc-500 dark:text-zinc-400 text-center">Simpan buku favoritmu untuk dibaca nanti.</span>
            </div>
        </div>
        <div class="mt-10 text-center text-zinc-400 text-xs">&copy; {{ date('Y') }} e-Library &mdash; Membaca jadi lebih mudah dan menyenangkan.</div>
    </main>
</body>
</html> 