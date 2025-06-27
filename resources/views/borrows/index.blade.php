<x-layouts.app>
<div class="max-w-3xl mx-auto py-8">
    <h1 class="text-2xl font-bold mb-2 text-left">Daftar Peminjaman</h1>
    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded shadow">{{ session('success') }}</div>
    @endif
    <div class="bg-white dark:bg-zinc-900 rounded-xl shadow border border-gray-200 overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-zinc-700">
            <thead class="bg-gray-50 dark:bg-zinc-800">
                <tr>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">Buku</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">Peminjam</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">Tanggal Pinjam</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">Tanggal Kembali</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">Status</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-zinc-900 divide-y divide-gray-100 dark:divide-zinc-800">
                @forelse($borrows as $borrow)
                <tr class="hover:bg-gray-50 dark:hover:bg-zinc-800 transition">
                    <td class="px-4 py-2 align-middle text-gray-900 dark:text-gray-100 flex items-center gap-3">
                        @if($borrow->book && $borrow->book->cover)
                            <img src="{{ $borrow->book->cover }}" alt="{{ $borrow->book->title }}" class="w-10 h-14 object-cover rounded shadow border border-gray-200 dark:border-zinc-800">
                        @else
                            <div class="w-10 h-14 flex items-center justify-center bg-gray-200 dark:bg-zinc-800 text-gray-400 text-xs rounded">No Cover</div>
                        @endif
                        <span>{{ $borrow->book->title ?? '-' }}</span>
                    </td>
                    <td class="px-4 py-2 align-middle text-gray-900 dark:text-gray-100">{{ $borrow->user->name ?? '-' }}</td>
                    <td class="px-4 py-2 align-middle text-gray-900 dark:text-gray-100">{{ \Carbon\Carbon::parse($borrow->borrowed_at)->translatedFormat('d F Y') }}</td>
                    <td class="px-4 py-2 align-middle text-gray-900 dark:text-gray-100">{{ $borrow->returned_at ? \Carbon\Carbon::parse($borrow->returned_at)->translatedFormat('d F Y') : '-' }}</td>
                    <td class="px-4 py-2 align-middle">
                        @if(!$borrow->returned_at)
                            <span class="inline-block px-3 py-1 bg-yellow-100 text-yellow-800 text-xs rounded-full font-semibold">Dipinjam</span>
                        @else
                            <span class="inline-block px-3 py-1 bg-green-100 text-green-800 text-xs rounded-full font-semibold">Selesai</span>
                        @endif
                    </td>
                    <td class="px-4 py-2 align-middle">
                        @if(!$borrow->returned_at)
                        <form action="{{ route('borrows.update', $borrow) }}" method="POST" onsubmit="return confirm('Kembalikan buku ini?')" class="inline">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="p-2 bg-green-50 dark:bg-zinc-800 rounded-full hover:bg-green-100 dark:hover:bg-zinc-700 transition" title="Kembalikan">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-green-600">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5l15-15m0 0v6.75m0-6.75H12" />
                                </svg>
                            </button>
                        </form>
                        @else
                        <span class="text-gray-500 dark:text-gray-400">-</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-10 text-gray-500 dark:text-gray-400">
                        <div class="flex flex-col items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 48 48" stroke-width="1.5" stroke="currentColor" class="w-16 h-16 text-gray-300 dark:text-zinc-700">
                                <rect x="8" y="8" width="32" height="32" rx="6" fill="currentColor" fill-opacity="0.1" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 20h16M16 28h8" />
                            </svg>
                            <span>Belum ada peminjaman.</span>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<a href="{{ route('borrows.create') }}"
   class="fixed bottom-8 right-8 bg-blue-600 hover:bg-blue-700 text-white rounded-full w-16 h-16 flex items-center justify-center shadow-2xl text-3xl font-bold transition-all duration-200 z-50 focus:outline-none focus:ring-4 focus:ring-blue-300 group hover:scale-110"
   title="Pinjam Buku">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-9 h-9">
        <circle cx="12" cy="12" r="11" stroke="currentColor" stroke-width="1.5" fill="none" />
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 7v10m5-5H7" />
    </svg>
    <span class="absolute opacity-0 group-hover:opacity-100 bg-blue-700 text-white text-xs rounded px-2 py-1 transition-all duration-200 -top-8">Pinjam Buku</span>
</a>
</x-layouts.app> 