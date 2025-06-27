<x-layouts.app :title="__('Dashboard')">
<div class="max-w-6xl mx-auto py-10 px-4">
    <!-- Greeting Personal -->
    @php
        $hour = (int) now()->format('H');
        if ($hour >= 5 && $hour < 12) {
            $greet = 'Selamat pagi';
        } elseif ($hour >= 12 && $hour < 15) {
            $greet = 'Selamat siang';
        } elseif ($hour >= 15 && $hour < 18) {
            $greet = 'Selamat sore';
        } else {
            $greet = 'Selamat malam';
        }
    @endphp
    <div class="flex items-center gap-4 mb-6">
        @if(isset($user) && $user && $user->profile_photo_path)
            <img src="{{ asset('storage/' . $user->profile_photo_path) }}" alt="Avatar" class="w-14 h-14 rounded-full object-cover shadow">
        @else
            <div class="w-14 h-14 rounded-full bg-gradient-to-tr from-blue-500/30 to-pink-500/30 flex items-center justify-center text-2xl font-bold text-white shadow">
                {{ strtoupper(substr($greetingName ?? 'U',0,1)) }}
            </div>
        @endif
        <div>
            <div class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ $greet }}, {{ $greetingName ?? 'User' }}!</div>
            <div class="text-gray-400 text-sm">Statistik dan aktivitas e-Library Anda.</div>
        </div>
    </div>
    <!-- Pengumuman/Info Penting (opsional, bisa diisi admin) -->
    <div class="mb-8">
        {{-- Contoh pengumuman, bisa diganti/dikosongkan --}}
        <div class="bg-yellow-50 dark:bg-yellow-900/30 text-yellow-800 dark:text-yellow-200 px-4 py-3 rounded-lg text-sm flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M12 20a8 8 0 100-16 8 8 0 000 16z"/></svg>
            <span>Selamat datang di e-Library! Jangan lupa kembalikan buku tepat waktu 😊</span>
        </div>
    </div>
    <!-- Quick Action -->
    <div class="flex flex-wrap gap-4 mb-8">
        <a href="{{ route('books.create') }}" class="flex flex-col items-center justify-center w-20 h-20 bg-gray-800 hover:bg-gray-900 text-white rounded-2xl transition-all duration-200 group" title="Tambah Buku">
            <svg class="w-7 h-7 mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <circle cx="12" cy="12" r="11" stroke="currentColor" stroke-width="1.5" fill="none" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 7v10m5-5H7" />
            </svg>
            <span class="text-xs font-semibold">Tambah</span>
        </a>
        <a href="{{ route('borrows.create') }}" class="flex flex-col items-center justify-center w-20 h-20 bg-gray-800 hover:bg-gray-900 text-white rounded-2xl transition-all duration-200 group" title="Pinjam Buku">
            <svg class="w-7 h-7 mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <rect x="6" y="7" width="12" height="10" rx="2" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 3h6v4H9z" />
            </svg>
            <span class="text-xs font-semibold">Pinjam</span>
        </a>
        <a href="{{ route('books.index') }}" class="flex flex-col items-center justify-center w-20 h-20 bg-gray-800 hover:bg-gray-900 text-white rounded-2xl transition-all duration-200 group" title="Daftar Buku">
            <svg class="w-7 h-7 mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <rect x="6" y="6" width="12" height="12" rx="2" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 10h6M9 14h6" />
            </svg>
            <span class="text-xs font-semibold">Buku</span>
        </a>
        <a href="{{ route('favorites.index') }}" class="flex flex-col items-center justify-center w-20 h-20 bg-gray-800 hover:bg-gray-900 text-white rounded-2xl transition-all duration-200 group" title="Favorit Saya">
            <svg class="w-7 h-7 mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41 0.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
            </svg>
            <span class="text-xs font-semibold">Favorit</span>
        </a>
    </div>
    <!-- Statistik Utama -->
    <div class="flex flex-col md:flex-row gap-6 md:gap-10 items-center justify-between mb-10">
        <div class="flex flex-col items-center md:items-start gap-1">
            <div class="flex items-center gap-2">
                <svg class="w-6 h-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6l4 2"/></svg>
                <span class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ $totalBooks }}</span>
            </div>
            <div class="text-xs text-gray-500">Total Buku</div>
        </div>
        <div class="flex flex-col items-center md:items-start gap-1">
            <div class="flex items-center gap-2">
                <svg class="w-6 h-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41 0.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                <span class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ $favoriteBooks }}</span>
            </div>
            <div class="text-xs text-gray-500">Favorit Saya</div>
        </div>
        <div class="flex flex-col items-center md:items-start gap-1">
            <div class="flex items-center gap-2">
                <svg class="w-6 h-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21H5a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2h4V3h6v2h4a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2z"/></svg>
                <span class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ $activeBorrows }}</span>
            </div>
            <div class="text-xs text-gray-500">Peminjaman Aktif</div>
        </div>
        <div class="flex flex-col items-center md:items-start gap-1">
            <div class="flex items-center gap-2">
                <svg class="w-6 h-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><rect x="3" y="7" width="18" height="13" rx="2"/><rect x="3" y="4" width="18" height="3" rx="1.5"/></svg>
                <span class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ $totalBorrows }}</span>
            </div>
            <div class="text-xs text-gray-500">Total Peminjaman</div>
        </div>
    </div>
    <!-- Aktivitas Terakhir -->
    <div class="w-full mb-10">
        <h2 class="text-base font-semibold mb-2 text-gray-900 dark:text-gray-100">Aktivitas Terakhir</h2>
        <div class="flex flex-col gap-4">
            @forelse($recentActivities as $activity)
            <div class="flex items-center gap-3 p-3 rounded-lg bg-gray-100 dark:bg-zinc-800">
                @if($activity['type'] === 'borrowed')
                    <svg class="w-6 h-6 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6l4 2"/></svg>
                @else
                    <svg class="w-6 h-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                @endif
                <div class="flex-1">
                    <div class="font-semibold text-gray-900 dark:text-gray-100">
                        {{ $activity['type'] === 'borrowed' ? 'Meminjam' : 'Mengembalikan' }} buku
                        <span class="text-blue-600 dark:text-blue-400">{{ $activity['book']->title ?? '-' }}</span>
                    </div>
                    <div class="text-xs text-gray-500 dark:text-gray-300">
                        {{ \Carbon\Carbon::parse($activity['date'])->translatedFormat('d F Y') }}
                    </div>
                </div>
                <span class="text-xs px-2 py-1 rounded-full {{ $activity['type'] === 'borrowed' ? 'bg-blue-100 text-blue-700' : 'bg-green-100 text-green-700' }}">
                    {{ $activity['type'] === 'borrowed' ? 'Dipinjam' : 'Dikembalikan' }}
                </span>
            </div>
            @empty
            <div class="text-center text-gray-400 py-8">Belum ada aktivitas peminjaman atau pengembalian buku.</div>
            @endforelse
        </div>
    </div>
</div>
</x-layouts.app>

