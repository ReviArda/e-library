<x-layouts.app>
<div class="max-w-6xl mx-auto py-8">
    <div class="flex gap-2 mb-8">
        <a href="{{ route('books.index') }}" class="px-4 py-2 rounded-full font-semibold transition border border-blue-600 {{ request()->routeIs('books.index') ? 'bg-blue-600 text-white' : 'bg-white dark:bg-zinc-900 text-blue-600 hover:bg-blue-50 dark:hover:bg-zinc-800' }}">Semua Buku</a>
        <a href="{{ route('favorites.index') }}" class="px-4 py-2 rounded-full font-semibold transition border border-pink-600 {{ request()->routeIs('favorites.index') ? 'bg-pink-600 text-white' : 'bg-white dark:bg-zinc-900 text-pink-600 hover:bg-pink-50 dark:hover:bg-zinc-800' }}">Favorit Saya</a>
    </div>
    <form method="GET" action="" class="mb-8 flex flex-col md:flex-row gap-4 items-start md:items-center">
        <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari judul, penulis, atau penerbit..." class="w-full md:w-1/2 px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400 bg-white dark:bg-zinc-900 text-gray-900 dark:text-gray-100" />
        @if(isset($genres) && $genres->count())
        <select name="genre" onchange="this.form.submit()" class="px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-pink-400 bg-white dark:bg-zinc-900 text-gray-900 dark:text-gray-100">
            <option value="">Semua Genre</option>
            @foreach($genres as $genre)
                <option value="{{ $genre }}" @selected(request('genre') == $genre)>{{ $genre }}</option>
            @endforeach
        </select>
        @endif
    </form>
    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded shadow">{{ session('success') }}</div>
    @endif
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
        @forelse($books as $book)
        <div class="bg-white dark:bg-zinc-900 rounded-3xl shadow-lg border border-gray-100 dark:border-zinc-800 flex flex-col overflow-hidden hover:shadow-xl hover:scale-105 transition-all duration-200 ease-in-out group relative">
            <div class="relative w-full h-72 bg-gray-100 dark:bg-zinc-800 flex items-center justify-center overflow-hidden ring-1 ring-gray-200 dark:ring-zinc-800">
                @if($book->genre)
                    <span class="absolute top-3 left-3 bg-pink-600 text-white text-xs font-semibold px-3 py-1 rounded-full shadow">{{ $book->genre }}</span>
                @endif
                @if($book->year)
                    <span class="absolute top-3 right-3 bg-blue-600 text-white text-xs font-semibold px-3 py-1 rounded-full shadow">{{ $book->year }}</span>
                @endif
                {{-- Badge Baru --}}
                @if($book->created_at && $book->created_at->gt(now()->subDays(7)))
                    <span class="absolute bottom-3 left-3 bg-green-600 text-white text-xs font-semibold px-3 py-1 rounded-full shadow animate-pulse">Baru</span>
                @endif
                @if(auth()->check())
                    @php $isFav = auth()->user()->favorites->where('book_id', $book->id)->count() > 0; @endphp
                    <form method="POST" action="{{ $isFav ? route('favorites.destroy', $book) : route('favorites.store', $book) }}" class="absolute bottom-3 right-3 z-10">
                        @csrf
                        @if($isFav)
                            @method('DELETE')
                        @endif
                        <button type="submit" class="focus:outline-none group/fav">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="{{ $isFav ? '#ef4444' : 'none' }}" stroke="#ef4444" stroke-width="2" class="w-8 h-8 drop-shadow transition-all duration-200 group-hover/fav:scale-125">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 3.75a5.25 5.25 0 0 1 4.25 8.5L12 21l-8.75-8.75A5.25 5.25 0 0 1 7.5 3.75c1.5 0 2.75.75 3.5 2 .75-1.25 2-2 3.5-2z" />
                            </svg>
                        </button>
                    </form>
                @endif
                @if($book->cover)
                    <img src="{{ $book->cover }}" alt="{{ $book->title }}" class="object-cover w-full h-full transition-all duration-200 group-hover:scale-105">
                @else
                    <div class="w-full h-full flex items-center justify-center text-gray-400 text-lg">No Cover</div>
                @endif
            </div>
            <div class="p-6 flex-1 flex flex-col">
                <a href="{{ route('books.show', $book) }}" class="font-bold text-xl text-gray-900 dark:text-gray-100 leading-tight mb-1 truncate hover:underline">{{ $book->title }}</a>
                <div class="text-gray-500 dark:text-gray-300 text-sm italic mb-1 truncate">{{ $book->author }}</div>
                {{-- Deskripsi dihapus dari index, hanya tampil di detail --}}
                <div class="flex items-center gap-1 mb-4">
                    <span class="text-yellow-400 text-base">★</span>
                    <span class="font-semibold text-gray-800 dark:text-gray-200 text-sm">{{ number_format(rand(40, 50)/10, 1) }}</span>
                </div>
                <div class="flex-1"></div>
                <div class="flex gap-2 justify-end mt-2">
                    <a href="{{ route('books.edit', $book) }}" class="p-2 bg-blue-50 dark:bg-zinc-800 rounded-full hover:bg-blue-100 dark:hover:bg-zinc-700 transition" title="Edit">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-blue-600">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487a2.1 2.1 0 1 1 2.97 2.97L7.5 19.79l-4 1 1-4 12.362-12.303z" />
                        </svg>
                    </a>
                    <form action="{{ route('books.destroy', $book) }}" method="POST" onsubmit="return confirm('Yakin hapus buku?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="p-2 bg-red-50 dark:bg-zinc-800 rounded-full hover:bg-red-100 dark:hover:bg-zinc-700 transition" title="Hapus">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-red-600">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full text-center text-gray-500 dark:text-gray-400 py-10">Belum ada buku.</div>
        @endforelse
    </div>
    <a href="{{ route('books.create') }}"
       class="fixed bottom-8 right-8 bg-blue-600 hover:bg-blue-700 text-white rounded-full w-16 h-16 flex items-center justify-center shadow-2xl text-3xl font-bold transition-all duration-200 z-50 focus:outline-none focus:ring-4 focus:ring-blue-300 group hover:scale-110"
       title="Tambah Buku">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-9 h-9">
            <circle cx="12" cy="12" r="11" stroke="currentColor" stroke-width="1.5" fill="none" />
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 7v10m5-5H7" />
        </svg>
        <span class="absolute opacity-0 group-hover:opacity-100 bg-blue-700 text-white text-xs rounded px-2 py-1 transition-all duration-200 -top-8">Tambah Buku</span>
    </a>
</div>
</x-layouts.app> 