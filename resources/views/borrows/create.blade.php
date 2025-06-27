<x-layouts.app>
<style>
    body {
        background: linear-gradient(120deg, #181c2a 0%, #232946 100%) !important;
        min-height: 100vh;
        overflow-x: hidden;
    }
    .glass-form {
        background: rgba(30,34,54,0.68);
        border-radius: 22px;
        box-shadow: 0 8px 40px 0 rgba(30,34,54,0.18);
        backdrop-filter: blur(14px) saturate(140%);
        border: 1.5px solid rgba(120,130,200,0.13);
        padding: 2.5rem 2rem;
    }
    .glass-btn {
        background: rgba(49,54,80,0.65);
        border-radius: 12px;
        border: 1.2px solid rgba(120,130,200,0.13);
        color: #fff;
        box-shadow: 0 4px 24px 0 rgba(99,102,241,0.18);
        transition: background 0.18s, border 0.18s, box-shadow 0.18s, transform 0.18s;
    }
    .glass-btn:hover {
        background: #6366f1;
        color: #fff;
        transform: scale(1.04);
        box-shadow: 0 8px 32px 0 rgba(99,102,241,0.28);
    }
    @media (max-width: 700px) {
        .glass-form { border-radius: 12px; padding: 1.2rem 0.7rem; }
    }
    .meteor-bg {
        position: fixed;
        top: 0; left: 0;
        width: 100vw; height: 100vh;
        z-index: 0;
        pointer-events: none;
    }
</style>
<canvas class="meteor-bg"></canvas>
<div class="w-full max-w-md sm:max-w-xl md:max-w-2xl lg:max-w-3xl xl:max-w-4xl mx-auto py-10 px-2 sm:px-4 relative z-10">
    <h1 class="text-2xl font-bold mb-6 text-white text-left">Pinjam Buku</h1>
    <div class="glass-form">
        <form action="{{ route('borrows.store') }}" method="POST" class="space-y-5">
            @csrf
            <div>
                <label class="block font-medium mb-1 text-zinc-200">Pilih Buku</label>
                <select name="book_id" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400 text-zinc-100 bg-zinc-800" required>
                    <option value="">-- Pilih Buku --</option>
                    @foreach($books as $book)
                        <option value="{{ $book->id }}" @if(old('book_id') == $book->id) selected @endif>
                            {{ $book->title }} (Stok: {{ $book->stock }})
                        </option>
                    @endforeach
                </select>
                @error('book_id')<div class="text-red-400 text-sm mt-1">{{ $message }}</div>@enderror
            </div>
            <div class="flex gap-2 justify-end">
                <a href="{{ route('borrows.index') }}" class="px-4 py-2 bg-zinc-700 text-zinc-200 rounded hover:bg-zinc-600 transition">Batal</a>
                <button type="submit" class="px-5 py-2 glass-btn">Pinjam</button>
            </div>
        </form>
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