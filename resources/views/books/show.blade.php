<x-layouts.app>
<div class="max-w-xl mx-auto py-10">
    <div class="relative bg-white dark:bg-zinc-900 rounded-3xl shadow-xl border border-gray-100 dark:border-zinc-800 overflow-hidden flex flex-col items-center">
        {{-- Cover dan aksi --}}
        <div class="relative w-full flex flex-col items-center justify-center bg-gray-100 dark:bg-zinc-800 pt-8 pb-4 overflow-hidden">
            @if($book->cover)
                {{-- Background transparan cover buku --}}
                <img src="{{ $book->cover }}" alt="bg" class="absolute inset-0 w-full h-full object-cover opacity-30 blur z-0" style="pointer-events:none;" />
                {{-- Cover utama --}}
                <img src="{{ $book->cover }}" alt="{{ $book->title }}" class="object-cover w-48 h-64 rounded-xl shadow-lg z-10 mx-auto relative">
            @else
                <div class="w-48 h-64 flex items-center justify-center text-gray-400 bg-gray-200 rounded-xl mx-auto">No Cover</div>
            @endif
            {{-- Ikon aksi --}}
            <div class="absolute top-3 right-3 flex gap-2 z-20">
                <a href="{{ route('books.edit', $book) }}" class="p-2 bg-white/80 dark:bg-zinc-900/80 rounded-full shadow hover:bg-blue-100 dark:hover:bg-zinc-800 transition" title="Edit">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-blue-600">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487a2.1 2.1 0 1 1 2.97 2.97L7.5 19.79l-4 1 1-4 12.362-12.303z" />
                    </svg>
                </a>
                <form action="{{ route('books.destroy', $book) }}" method="POST" onsubmit="return confirm('Yakin hapus buku?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="p-2 bg-white/80 dark:bg-zinc-900/80 rounded-full shadow hover:bg-red-100 dark:hover:bg-zinc-800 transition" title="Hapus">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-red-600">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </form>
            </div>
        </div>
        {{-- Info buku --}}
        <div class="w-full px-6 pt-4 pb-8 flex flex-col items-center">
            <h1 class="font-bold text-2xl text-gray-900 dark:text-gray-100 mb-1 text-center">{{ $book->title }}</h1>
            <div class="text-gray-500 dark:text-gray-300 text-base italic mb-2 text-center">oleh {{ $book->author }}</div>
            <div class="flex items-center gap-2 mb-3 flex-wrap justify-center">
                @if($book->genre)
                    <span class="bg-pink-100 text-pink-700 text-xs font-semibold px-3 py-1 rounded-full shadow">{{ $book->genre }}</span>
                @endif
                @if($book->year)
                    <span class="bg-blue-100 text-blue-700 text-xs font-semibold px-3 py-1 rounded-full shadow">{{ $book->year }}</span>
                @endif
                <span class="flex items-center gap-1 bg-yellow-50 text-yellow-700 px-3 py-1 rounded-full text-xs font-semibold shadow">
                    <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.967a1 1 0 00.95.69h4.178c.969 0 1.371 1.24.588 1.81l-3.385 2.46a1 1 0 00-.364 1.118l1.287 3.966c.3.922-.755 1.688-1.54 1.118l-3.385-2.46a1 1 0 00-1.175 0l-3.385 2.46c-.784.57-1.838-.196-1.539-1.118l1.287-3.966a1 1 0 00-.364-1.118l-3.385-2.46c-.783-.57-.38-1.81.588-1.81h4.178a1 1 0 00.95-.69l1.286-3.967z"/></svg>
                    {{ number_format(rand(40, 50)/10, 1) }}
                </span>
            </div>
            @if($book->description)
            <div class="w-full mt-4">
                <div class="font-bold text-lg mb-1">Deskripsi</div>
                <div class="text-gray-700 dark:text-gray-300 text-sm">{{ $book->description }}</div>
            </div>
            @endif
            <div class="w-full flex flex-col items-center mt-8 gap-3">
                <div class="flex items-center gap-4 w-full justify-center">
                    <a href="{{ route('books.index') }}" class="px-4 py-2 bg-gray-200 dark:bg-zinc-800 text-gray-700 dark:text-gray-200 rounded hover:bg-gray-300 dark:hover:bg-zinc-700 transition">Kembali</a>
                    @if($book->stock > 0)
                    <a href="{{ route('borrows.create') }}?book_id={{ $book->id }}" class="flex-1 px-4 py-3 bg-orange-500 text-white rounded-lg text-center font-semibold text-lg shadow hover:bg-orange-600 transition">Pinjam Buku</a>
                    @else
                    <span class="flex-1 px-4 py-3 bg-red-100 text-red-600 rounded-lg text-center font-semibold text-lg">Stok Habis</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
</x-layouts.app> 