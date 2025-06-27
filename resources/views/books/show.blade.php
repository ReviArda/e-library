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
    .glass-detail {
        background: rgba(30,34,54,0.68);
        border-radius: 32px;
        box-shadow: 0 8px 40px 0 rgba(30,34,54,0.22);
        backdrop-filter: blur(16px) saturate(140%);
        border: 1.5px solid rgba(120,130,200,0.13);
        transition: box-shadow 0.18s, transform 0.18s;
    }
    .glass-detail:hover {
        box-shadow: 0 16px 48px 0 rgba(99,102,241,0.18);
        transform: translateY(-2px) scale(1.01);
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
    .book-badge {
        font-weight: 500;
        font-size: 0.85rem;
        padding: 3px 12px;
        border-radius: 999px;
        border: 1.2px solid;
        background: none;
        color: #232946;
        letter-spacing: 0.01em;
        z-index: 2;
    }
    .book-badge.genre { background: none; color: #be185d; border-color: #f9a8d4; }
    .book-badge.year { background: none; color: #1e40af; border-color: #93c5fd; }
    .book-badge.baru { background: none; color: #166534; border-color: #6ee7b7; animation: pulse 1.5s infinite; }
    @keyframes pulse { 0%{opacity:1;} 50%{opacity:.5;} 100%{opacity:1;} }
    .book-badge.rating { background: none; color: #b45309; border-color: #fde68a; }
    .glass-btn {
        background: rgba(49,54,80,0.65);
        border-radius: 14px;
        border: 1.2px solid rgba(120,130,200,0.13);
        color: #fff;
        font-weight: 600;
        transition: background 0.18s, border 0.18s, box-shadow 0.18s;
        box-shadow: 0 2px 12px 0 rgba(99,102,241,0.08);
        padding: 10px 28px;
        font-size: 1rem;
    }
    .glass-btn:hover {
        background: #6366f1;
        color: #fff;
        box-shadow: 0 4px 24px 0 rgba(99,102,241,0.18);
    }
    .glass-btn.secondary {
        background: rgba(30,34,54,0.68);
        color: #a5b4fc;
    }
    .glass-btn.secondary:hover {
        background: rgba(99,102,241,0.13);
        color: #fff;
    }
    .desc-glass {
        background: rgba(49,54,80,0.65);
        border-radius: 18px;
        border: 1.2px solid rgba(120,130,200,0.13);
        box-shadow: 0 2px 12px 0 rgba(99,102,241,0.08);
        color: #fff;
        padding: 18px 22px;
        margin-top: 1rem;
        font-size: 1rem;
    }
    @media (max-width: 700px) {
        .glass-detail { border-radius: 18px; }
        .desc-glass { border-radius: 10px; padding: 10px 8px; }
        .glass-btn { font-size: 0.95rem; padding: 10px 10px; }
    }
</style>
<canvas class="meteor-bg"></canvas>
<div class="max-w-xl mx-auto py-10">
    <div class="relative glass-detail overflow-hidden flex flex-col items-center">
        {{-- Cover dan aksi --}}
        <div class="relative w-full flex flex-col items-center justify-center bg-zinc-800 pt-8 pb-4 overflow-hidden">
            @if($book->cover)
                {{-- Background transparan cover buku --}}
                <img src="{{ $book->cover }}" alt="bg" class="absolute inset-0 w-full h-full object-cover opacity-30 blur z-0" style="pointer-events:none;" />
                {{-- Cover utama --}}
                <img src="{{ $book->cover }}" alt="{{ $book->title }}" class="object-cover w-48 h-64 rounded-xl shadow-lg z-10 mx-auto relative">
            @else
                <div class="w-48 h-64 flex items-center justify-center text-zinc-500 bg-zinc-700 rounded-xl mx-auto">No Cover</div>
            @endif
            {{-- Ikon aksi --}}
            <div class="absolute top-3 right-3 flex gap-2 z-20">
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
        {{-- Info buku --}}
        <div class="w-full px-6 pt-4 pb-8 flex flex-col items-center">
            <h1 class="font-bold text-2xl text-white mb-1 text-center">{{ $book->title }}</h1>
            <div class="text-zinc-400 text-base italic mb-2 text-center">oleh {{ $book->author }}</div>
            <div class="flex items-center gap-2 mb-3 flex-wrap justify-center">
                @if($book->genre)
                    <span class="book-badge genre">{{ $book->genre }}</span>
                @endif
                @if($book->year)
                    <span class="book-badge year">{{ $book->year }}</span>
                @endif
                <span class="book-badge rating flex items-center gap-1">
                    <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.967a1 1 0 00.95.69h4.178c.969 0 1.371 1.24.588 1.81l-3.385 2.46a1 1 0 00-.364 1.118l1.287 3.966c.3.922-.755 1.688-1.54 1.118l-3.385-2.46a1 1 0 00-1.175 0l-3.385 2.46c-.784.57-1.838-.196-1.539-1.118l1.287-3.966a1 1 0 00-.364-1.118l-3.385-2.46c-.783-.57-.38-1.81.588-1.81h4.178a1 1 0 00.95-.69l1.286-3.967z"/></svg>
                    {{ number_format(rand(40, 50)/10, 1) }}
                </span>
            </div>
            @if($book->description)
            <div class="desc-glass w-full mt-4">
                <div class="font-bold text-lg mb-1">Deskripsi</div>
                <div class="text-white text-sm">{{ $book->description }}</div>
            </div>
            @endif
            <div class="w-full flex flex-col items-center mt-8 gap-3">
                <div class="flex items-center gap-4 w-full justify-center">
                    <a href="{{ route('books.index') }}" class="glass-btn secondary">Kembali</a>
                    @if($book->stock > 0)
                    <a href="{{ route('borrows.create') }}?book_id={{ $book->id }}" class="flex-1 glass-btn">Pinjam Buku</a>
                    @else
                    <span class="flex-1 glass-btn" style="background:rgba(239,68,68,0.13);color:#f87171;cursor:not-allowed;">Stok Habis</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
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