<x-layouts.app>
<style>
    body {
        background: linear-gradient(120deg, #181c2a 0%, #232946 100%) !important;
        min-height: 100vh;
        overflow-x: hidden;
    }
    .fav-masonry {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        gap: 2rem;
    }
    .fav-card {
        background: rgba(36,40,60,0.82);
        border-radius: 20px;
        box-shadow: 0 6px 32px 0 rgba(30,34,54,0.18);
        border: 1.5px solid rgba(120,130,200,0.10);
        backdrop-filter: blur(10px) saturate(120%);
        transition: box-shadow 0.18s, transform 0.18s;
        display: flex;
        flex-direction: column;
        overflow: hidden;
    }
    .fav-card:hover {
        box-shadow: 0 12px 40px 0 rgba(99,102,241,0.18);
        transform: translateY(-2px) scale(1.025);
    }
    .fav-badge {
        border: 1.2px solid #a5b4fc;
        color: #a5b4fc;
        background: rgba(49,54,80,0.18);
        font-weight: 600;
        font-size: 0.78rem;
        border-radius: 9999px;
        padding: 2px 12px;
        margin-right: 2px;
        margin-bottom: 2px;
    }
    .heart-glow {
        filter: drop-shadow(0 0 8px #ef4444cc);
    }
    .sticky-header {
        position: sticky;
        top: 0;
        z-index: 10;
        background: linear-gradient(120deg, #181c2a 80%, #232946 100%);
        padding-top: 1.5rem;
        padding-bottom: 1rem;
        margin-bottom: 1.5rem;
    }
    @media (max-width: 700px) {
        .fav-card { border-radius: 12px; }
        .sticky-header { padding-top: 1rem; padding-bottom: 0.5rem; }
        .fav-fix-mobile {
            padding-left: 0 !important;
            padding-right: 0 !important;
            margin-left: 0 !important;
            margin-right: 0 !important;
            max-width: 100vw !important;
            width: 100vw !important;
            position: relative;
            left: 50%;
            right: 50%;
            margin-left: -50vw !important;
            margin-right: -50vw !important;
        }
    }
    .meteor-bg {
        position: fixed;
        top: 0; left: 0;
        width: 100vw; height: 100vh;
        z-index: 0;
        pointer-events: none;
    }
    .glass-header {
        background: rgba(30,34,54,0.82);
        border-radius: 24px;
        box-shadow: 0 6px 32px 0 rgba(99,102,241,0.10);
        backdrop-filter: blur(14px) saturate(140%);
        border: 1.5px solid rgba(120,130,200,0.13);
        padding: 2rem 2.5rem 1.5rem 2.5rem;
        margin-bottom: 2.5rem;
        display: flex;
        align-items: center;
        gap: 18px;
    }
    .fav-header-icon {
        background: linear-gradient(135deg, #6366f1 60%, #ec4899 100%);
        border-radius: 50%;
        width: 54px;
        height: 54px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 0 16px 0 #6366f1cc;
    }
    .fav-header-title {
        font-size: 2rem;
        font-weight: 900;
        color: #fff;
        letter-spacing: 0.01em;
        text-shadow: 0 0 8px #6366f1, 0 0 16px #ec4899, 0 0 2px #a21caf;
        margin-bottom: 0.1rem;
        line-height: 1.1;
    }
    .fav-header-desc {
        color: #a5b4fc;
        font-size: 1.08rem;
        margin-bottom: 0;
        font-weight: 500;
    }
    @media (max-width: 700px) {
        .glass-header { padding: 1.2rem 0.7rem; border-radius: 14px; flex-direction: column; align-items: flex-start; gap: 10px; }
        .fav-header-icon { width: 40px; height: 40px; }
        .fav-header-title { font-size: 1.3rem; }
    }
    .book-badge {
        font-weight: 500;
        font-size: 0.85rem;
        padding: 4px 14px;
        border-radius: 999px;
        border: 1.5px solid rgba(255,255,255,0.7);
        background: transparent;
        color: #fff;
        box-shadow: none;
        letter-spacing: 0.01em;
        backdrop-filter: none;
        z-index: 2;
    }
    .book-badge.genre { color: #be185d; border-color: #f9a8d4cc; }
    .book-badge.year { color: #1e40af; border-color: #93c5fdcc; }
    .book-badge.baru { color: #166534; border-color: #6ee7b7cc; animation: pulse 1.5s infinite; }
    .glass-book {
        background: rgba(30,34,54,0.68);
        border-radius: 24px;
        box-shadow: 0 8px 32px 0 rgba(30,34,54,0.18);
        backdrop-filter: blur(12px) saturate(140%);
        border: 1.2px solid rgba(120,130,200,0.13);
        transition: box-shadow 0.18s;
    }
    .glass-book:hover {
        box-shadow: 0 12px 32px 0 rgba(99,102,241,0.13);
        /* Hilangkan transform dan efek hover berlebihan */
    }
    .book-title-link {
        position: relative;
        display: inline-block;
        color: #fff;
        text-decoration: none;
        transition: color 0.18s;
    }
    .book-title-link::after {
        content: '';
        display: block;
        position: absolute;
        left: 0; bottom: -2px;
        width: 0%;
        height: 2px;
        background: linear-gradient(90deg, #6366f1 60%, #a5b4fc 100%);
        border-radius: 2px;
        transition: width 0.25s cubic-bezier(.4,2,.6,1);
    }
    .book-title-link:hover {
        color: #a5b4fc;
    }
    .book-title-link:hover::after {
        width: 100%;
    }
    .glass-header, .fav-header-icon, .fav-header-title, .fav-header-desc {
        all: unset;
    }
    .simple-fav-header {
        margin-top: 2.5rem;
        margin-bottom: 2.5rem;
        padding-left: 0.5rem;
        padding-right: 0.5rem;
    }
    .simple-fav-title {
        font-size: 2rem;
        font-weight: 800;
        color: #fff;
        margin-bottom: 0.2rem;
        line-height: 1.1;
    }
    .simple-fav-desc {
        color: #a5b4fc;
        font-size: 1.08rem;
        margin-bottom: 0;
        font-weight: 400;
    }
    @media (max-width: 700px) {
        .simple-fav-header { margin-top: 1.2rem; margin-bottom: 1.2rem; }
        .simple-fav-title { font-size: 1.2rem; }
    }
</style>
<canvas class="meteor-bg"></canvas>
<div class="w-full max-w-md sm:max-w-xl md:max-w-2xl lg:max-w-4xl xl:max-w-6xl mx-auto px-2 sm:px-4 relative z-10">
    <div class="simple-fav-header">
        <div class="simple-fav-title">Favorit Saya</div>
        <div class="simple-fav-desc">Koleksi buku yang paling kamu sukai.</div>
    </div>
    <div class="fav-masonry w-full">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            @forelse($books as $book)
            <div class="glass-book flex flex-col overflow-hidden group relative">
                <div class="relative w-full h-72 bg-zinc-800 flex items-center justify-center overflow-hidden ring-1 ring-zinc-800">
                    <div class="absolute top-3 left-3 flex flex-col gap-2 z-10">
                        {{-- Badge genre dihapus --}}
                        @if($book->created_at && $book->created_at->gt(now()->subDays(7)))
                            <span class="book-badge baru">Baru</span>
                        @endif
                    </div>
                    {{-- Badge tahun dihapus --}}
                    <span class="absolute bottom-3 right-3 z-10">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#ef4444" stroke="#ef4444" stroke-width="2" class="w-8 h-8 heart-glow">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 3.75a5.25 5.25 0 0 1 4.25 8.5L12 21l-8.75-8.75A5.25 5.25 0 0 1 7.5 3.75c1.5 0 2.75.75 3.5 2 .75-1.25 2-2 3.5-2z" />
                        </svg>
                    </span>
                    @if($book->cover)
                        <img src="{{ $book->cover }}" alt="{{ $book->title }}" class="object-cover w-full h-full transition-all duration-200 group-hover:scale-105">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-zinc-500 text-lg">No Cover</div>
                    @endif
                </div>
                <div class="p-6 flex-1 flex flex-col">
                    <a href="{{ route('books.show', $book) }}" class="book-title-link font-bold text-xl text-white leading-tight mb-1 truncate">{{ $book->title }}</a>
                    <div class="text-zinc-400 text-sm italic mb-1 truncate">{{ $book->author }}</div>
                    <div class="flex items-center gap-1 mb-4">
                        <span class="book-rating">★</span>
                        <span class="font-semibold text-zinc-200 text-sm">{{ number_format(rand(40, 50)/10, 1) }}</span>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full flex flex-col items-center justify-center py-24" style="max-width:320px;margin:0 auto;">
                <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" class="w-14 h-14 mb-4 opacity-70" style="max-width:56px;max-height:56px;">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 3.75a5.25 5.25 0 0 1 4.25 8.5L12 21l-8.75-8.75A5.25 5.25 0 0 1 7.5 3.75c1.5 0 2.75.75 3.5 2 .75-1.25 2-2 3.5-2z"/>
                </svg>
                <div class="text-base font-semibold text-zinc-300 text-center mb-2">Belum ada buku favorit.</div>
                <a href="{{ route('books.index') }}" class="px-4 py-2 rounded bg-indigo-600 text-white hover:bg-indigo-700 transition">Cari Buku</a>
            </div>
            @endforelse
        </div>
    </div>
</div>
</x-layouts.app> 