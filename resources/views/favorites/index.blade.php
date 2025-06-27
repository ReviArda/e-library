<x-layouts.app>
<div class="max-w-6xl mx-auto py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Buku Favorit Saya</h1>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
        @forelse($books as $book)
        <div class="bg-white dark:bg-zinc-900 rounded-2xl shadow-lg border border-transparent flex flex-col overflow-hidden hover:-translate-y-1 hover:scale-[1.025] hover:shadow-2xl transition-all duration-300 ease-in-out">
            <div class="relative w-full h-64 bg-gray-100 dark:bg-zinc-800 flex items-center justify-center overflow-hidden ring-1 ring-gray-200 dark:ring-zinc-800">
                @if($book->genre)
                    <span class="absolute top-2 left-2 bg-pink-600 text-white text-xs font-semibold px-2 py-0.5 rounded-full shadow">{{ $book->genre }}</span>
                @endif
                @if($book->year)
                    <span class="absolute top-2 right-2 bg-blue-600 text-white text-xs font-semibold px-2 py-0.5 rounded-full shadow">{{ $book->year }}</span>
                @endif
                <span class="absolute bottom-2 right-2 z-10">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#ef4444" stroke="#ef4444" stroke-width="2" class="w-7 h-7 drop-shadow">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 3.75a5.25 5.25 0 0 1 4.25 8.5L12 21l-8.75-8.75A5.25 5.25 0 0 1 7.5 3.75c1.5 0 2.75.75 3.5 2 .75-1.25 2-2 3.5-2z" />
                    </svg>
                </span>
                @if($book->cover)
                    <img src="{{ $book->cover }}" alt="{{ $book->title }}" class="object-cover w-full h-full transition-all duration-300">
                @else
                    <div class="w-full h-full flex items-center justify-center text-gray-400">No Cover</div>
                @endif
            </div>
            <div class="p-5 flex-1 flex flex-col">
                <a href="{{ route('books.show', $book) }}" class="font-bold text-xl text-gray-900 dark:text-gray-100 leading-tight mb-1 truncate hover:underline">{{ $book->title }}</a>
                <div class="text-gray-500 dark:text-gray-300 text-sm italic mb-1 truncate">{{ $book->author }}</div>
                <div class="flex items-center gap-1 mb-4">
                    <span class="text-yellow-400 text-base">★</span>
                    <span class="font-semibold text-gray-800 dark:text-gray-200 text-sm">{{ number_format(rand(40, 50)/10, 1) }}</span>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full text-center text-gray-500 dark:text-gray-400 py-10">Belum ada buku favorit.</div>
        @endforelse
    </div>
</div>
<a href="{{ route('books.index') }}"
   class="fixed bottom-8 right-8 bg-gray-700 hover:bg-gray-800 text-white rounded-full w-14 h-14 flex items-center justify-center shadow-2xl transition-all duration-200 z-50 group hover:scale-110"
   title="Kembali ke Daftar Buku">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-8 h-8">
        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
    </svg>
    <span class="absolute opacity-0 group-hover:opacity-100 bg-gray-800 text-white text-xs rounded px-2 py-1 transition-all duration-200 -top-8 left-1/2 -translate-x-1/2">Kembali ke Daftar Buku</span>
</a>
</x-layouts.app> 