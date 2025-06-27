<x-layouts.app>
<style>
    body {
        background: linear-gradient(135deg, #181c2a 0%, #232946 100%) !important;
        min-height: 100vh;
        position: relative;
        overflow-x: hidden;
    }
    .meteor-bg {
        position: fixed;
        top: 0; left: 0; width: 100vw; height: 100vh;
        pointer-events: none;
        z-index: 0;
    }
    .glass-book {
        background: rgba(30,34,54,0.68);
        border-radius: 24px;
        box-shadow: 0 8px 32px 0 rgba(30,34,54,0.18);
        backdrop-filter: blur(12px) saturate(140%);
        border: 1.2px solid rgba(120,130,200,0.13);
        transition: box-shadow 0.18s, transform 0.18s;
    }
    .glass-book:hover {
        box-shadow: 0 16px 48px 0 rgba(99,102,241,0.18);
        transform: translateY(-2px) scale(1.03);
    }
    .glass-action {
        background: rgba(49,54,80,0.65);
        border-radius: 50%;
        box-shadow: 0 2px 8px 0 rgba(99,102,241,0.08);
        border: 1px solid rgba(120,130,200,0.08);
        transition: background 0.18s, transform 0.18s, box-shadow 0.18s;
    }
    .glass-action:hover {
        background: rgba(99,102,241,0.13);
        transform: scale(1.08);
        box-shadow: 0 8px 32px 0 rgba(99,102,241,0.13);
    }
    .glass-fab {
        background: rgba(49,54,80,0.92);
        border-radius: 50%;
        box-shadow: 0 8px 32px 0 rgba(99,102,241,0.18);
        border: 1.5px solid rgba(120,130,200,0.13);
        transition: background 0.18s, transform 0.18s, box-shadow 0.18s;
    }
    .glass-fab:hover {
        background: #6366f1;
        transform: scale(1.12);
        box-shadow: 0 16px 48px 0 rgba(99,102,241,0.22);
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
    @keyframes pulse { 0%{opacity:1;} 50%{opacity:.5;} 100%{opacity:1;} }
    .book-rating {
        color: #facc15;
        font-size: 1.1rem;
        margin-right: 2px;
    }
    .empty-books {
        color: #a0aec0;
        padding: 32px 0;
        text-align: center;
    }
    .toggle-switch {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 2.5rem;
    }
    .toggle-btn {
        display: flex;
        align-items: center;
        background: rgba(49,54,80,0.65);
        border-radius: 999px;
        border: 1.5px solid rgba(120,130,200,0.13);
        box-shadow: 0 2px 8px 0 rgba(99,102,241,0.08);
        overflow: hidden;
        transition: background 0.18s, border 0.18s;
    }
    .toggle-btn a {
        display: flex;
        align-items: center;
        gap: 0.4rem;
        padding: 7px 22px 7px 16px;
        font-weight: 600;
        font-size: 1rem;
        color: #a5b4fc;
        background: none;
        border: none;
        transition: background 0.18s, color 0.18s;
        text-decoration: none;
    }
    .toggle-btn a.active {
        background: #6366f1;
        color: #fff;
        box-shadow: 0 2px 12px 0 rgba(99,102,241,0.18);
    }
    .toggle-btn svg {
        width: 1.2em; height: 1.2em;
    }
    .search-glass {
        background: rgba(30,34,54,0.68);
        border-radius: 18px;
        border: 1.2px solid rgba(120,130,200,0.13);
        box-shadow: 0 2px 12px 0 rgba(99,102,241,0.08);
        color: #fff;
        padding-left: 2.5rem !important;
        transition: box-shadow 0.18s, border 0.18s, background 0.18s;
        position: relative;
    }
    .search-glass:focus {
        box-shadow: 0 4px 24px 0 rgba(99,102,241,0.18);
        border-color: #6366f1;
        background: rgba(49,54,80,0.82);
    }
    .search-icon {
        position: absolute;
        left: 0.9rem;
        top: 50%;
        transform: translateY(-50%);
        color: #a5b4fc;
        width: 1.2em;
        height: 1.2em;
        pointer-events: none;
        opacity: 0.85;
    }
    .filter-glass {
        background: rgba(30,34,54,0.68);
        border-radius: 14px;
        border: 1.2px solid rgba(120,130,200,0.13);
        box-shadow: 0 2px 12px 0 rgba(99,102,241,0.08);
        color: #fff;
        transition: box-shadow 0.18s, border 0.18s, background 0.18s;
    }
    .filter-glass:focus {
        box-shadow: 0 4px 24px 0 rgba(99,102,241,0.18);
        border-color: #f472b6;
        background: rgba(49,54,80,0.82);
    }
    @media (max-width: 700px) {
        .glass-book { border-radius: 16px; }
        .glass-fab { width: 56px !important; height: 56px !important; }
        .toggle-btn a { font-size: 0.95rem; padding: 7px 12px 7px 10px; }
        .search-glass { border-radius: 12px; }
        .filter-glass { border-radius: 8px; }
    }
</style>
<canvas class="meteor-bg"></canvas>
<div class="max-w-6xl mx-auto py-8">
    <div class="toggle-switch">
        <div class="toggle-btn">
            <a href="{{ route('books.index') }}" class="{{ request()->routeIs('books.index') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="4" y="5" width="16" height="14" rx="3"/><rect x="8" y="9" width="8" height="2" rx="1" fill="#fff"/></svg>
                Semua Buku
            </a>
            <a href="{{ route('favorites.index') }}" class="{{ request()->routeIs('favorites.index') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41 0.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                Favorit Saya
            </a>
        </div>
    </div>
    <form method="GET" action="" class="mb-8 flex flex-col md:flex-row gap-4 items-start md:items-center relative">
        <div class="relative w-full md:w-1/2">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-indigo-400 pointer-events-none">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" class="w-5 h-5"><circle cx="11" cy="11" r="7"/><path d="M21 21l-4.35-4.35"/></svg>
            </span>
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari judul, penulis, atau penerbit..." class="search-glass w-full px-4 py-2 pl-10 border focus:outline-none focus:ring-2 focus:ring-blue-400 placeholder:text-zinc-400 shadow" />
        </div>
        @if(isset($genres) && $genres->count())
        <select name="genre" onchange="this.form.submit()" class="filter-glass px-4 py-2 border focus:outline-none focus:ring-2 focus:ring-pink-400 shadow">
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
        <div class="glass-book flex flex-col overflow-hidden hover:shadow-xl group relative">
            <div class="relative w-full h-72 bg-zinc-800 flex items-center justify-center overflow-hidden ring-1 ring-zinc-800">
                <div class="absolute top-3 left-3 flex flex-col gap-2 z-10">
                    @if($book->genre)
                        <span class="book-badge genre">{{ $book->genre }}</span>
                    @endif
                    @if($book->created_at && $book->created_at->gt(now()->subDays(7)))
                        <span class="book-badge baru">Baru</span>
                    @endif
                </div>
                @if($book->year)
                    <span class="absolute top-3 right-3 book-badge year z-10">{{ $book->year }}</span>
                @endif
                @if(auth()->check())
                    @php $isFav = auth()->user()->favorites->where('book_id', $book->id)->count() > 0; @endphp
                    <form method="POST" action="{{ $isFav ? route('favorites.destroy', $book) : route('favorites.store', $book) }}" class="absolute bottom-3 right-3 z-10">
                        @csrf
                        @if($isFav)
                            @method('DELETE')
                        @endif
                        <button type="submit" class="focus:outline-none glass-action">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="{{ $isFav ? '#ef4444' : 'none' }}" stroke="#ef4444" stroke-width="2" class="w-8 h-8 drop-shadow transition-all duration-200">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 3.75a5.25 5.25 0 0 1 4.25 8.5L12 21l-8.75-8.75A5.25 5.25 0 0 1 7.5 3.75c1.5 0 2.75.75 3.5 2 .75-1.25 2-2 3.5-2z" />
                            </svg>
                        </button>
                    </form>
                @endif
                @if($book->cover)
                    <img src="{{ $book->cover }}" alt="{{ $book->title }}" class="object-cover w-full h-full transition-all duration-200 group-hover:scale-105">
                @else
                    <div class="w-full h-full flex items-center justify-center text-zinc-500 text-lg">No Cover</div>
                @endif
            </div>
            <div class="p-6 flex-1 flex flex-col">
                <a href="{{ route('books.show', $book) }}" class="font-bold text-xl text-white leading-tight mb-1 truncate hover:underline">{{ $book->title }}</a>
                <div class="text-zinc-400 text-sm italic mb-1 truncate">{{ $book->author }}</div>
                <div class="flex items-center gap-1 mb-4">
                    <span class="book-rating">★</span>
                    <span class="font-semibold text-zinc-200 text-sm">{{ number_format(rand(40, 50)/10, 1) }}</span>
                </div>
                <div class="flex-1"></div>
                <div class="flex gap-2 justify-end mt-2">
                    <a href="{{ route('books.edit', $book) }}" class="p-2 glass-action" title="Edit">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5" style="color:#60a5fa;">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487a2.1 2.1 0 1 1 2.97 2.97L7.5 19.79l-4 1 1-4 12.362-12.303z" />
                        </svg>
                    </a>
                    <form action="{{ route('books.destroy', $book) }}" method="POST" onsubmit="return confirm('Yakin hapus buku?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="p-2 glass-action" title="Hapus">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5" style="color:#fca5a5;">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full empty-books">Belum ada buku.</div>
        @endforelse
    </div>
    <a href="{{ route('books.create') }}"
       class="fixed bottom-8 right-8 glass-fab text-white w-16 h-16 flex items-center justify-center shadow-2xl text-3xl font-bold transition-all duration-200 z-50 focus:outline-none focus:ring-4 focus:ring-blue-300 group"
       title="Tambah Buku">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-9 h-9">
            <circle cx="12" cy="12" r="11" stroke="currentColor" stroke-width="1.5" fill="none" />
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 7v10m5-5H7" />
        </svg>
        <span class="absolute opacity-0 group-hover:opacity-100 bg-blue-700 text-white text-xs rounded px-2 py-1 transition-all duration-200 -top-8">Tambah Buku</span>
    </a>
</div>
<script>
// Meteor (shooting star) animation
const canvas = document.querySelector('.meteor-bg');
if (canvas) {
    const ctx = canvas.getContext('2d');
    function resizeCanvas() {
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;
    }
    window.addEventListener('resize', resizeCanvas);
    resizeCanvas();
    let meteors = [];
    function randomMeteor() {
        return {
            x: Math.random() * canvas.width,
            y: Math.random() * canvas.height * 0.5,
            len: 80 + Math.random() * 60,
            speed: 6 + Math.random() * 4,
            angle: Math.PI / 4 + (Math.random() - 0.5) * 0.2,
            alpha: 0.7 + Math.random() * 0.3
        };
    }
    function drawMeteor(m) {
        ctx.save();
        ctx.globalAlpha = m.alpha;
        ctx.strokeStyle = '#a5b4fc';
        ctx.lineWidth = 2.2;
        ctx.shadowColor = '#6366f1';
        ctx.shadowBlur = 12;
        ctx.beginPath();
        ctx.moveTo(m.x, m.y);
        ctx.lineTo(m.x - m.len * Math.cos(m.angle), m.y - m.len * Math.sin(m.angle));
        ctx.stroke();
        ctx.restore();
    }
    function animate() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        for (let m of meteors) {
            drawMeteor(m);
            m.x += m.speed * Math.cos(m.angle);
            m.y += m.speed * Math.sin(m.angle);
            m.alpha -= 0.012;
        }
        meteors = meteors.filter(m => m.alpha > 0);
        if (Math.random() < 0.07) meteors.push(randomMeteor());
        requestAnimationFrame(animate);
    }
    animate();
}
</script>
</x-layouts.app> 