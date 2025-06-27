<x-layouts.app>
<style>
    body {
        background: linear-gradient(120deg, #181c2a 0%, #232946 100%) !important;
        min-height: 100vh;
        overflow-x: hidden;
    }
    .glass-container {
        background: rgba(30,34,54,0.68);
        border-radius: 22px;
        box-shadow: 0 8px 40px 0 rgba(30,34,54,0.18);
        backdrop-filter: blur(14px) saturate(140%);
        border: 1.5px solid rgba(120,130,200,0.13);
        overflow-x: auto;
    }
    .glass-table th, .glass-table td {
        background: transparent !important;
    }
    .glass-table tr {
        transition: background 0.18s;
    }
    .glass-table tr:hover {
        background: rgba(99,102,241,0.08) !important;
    }
    .glass-badge {
        background: rgba(99,102,241,0.13);
        color: #a5b4fc;
        border-radius: 9999px;
        font-weight: 600;
        font-size: 0.82rem;
        padding: 3px 14px;
        border: 1.2px solid #a5b4fc22;
        box-shadow: none;
    }
    .glass-badge.done {
        background: rgba(34,197,94,0.13);
        color: #4ade80;
        border: 1.2px solid #4ade8022;
    }
    .glass-badge.borrowed {
        background: rgba(253,224,71,0.13);
        color: #fde047;
        border: 1.2px solid #fde04722;
    }
    .glass-fab {
        background: rgba(49,54,80,0.65);
        border-radius: 50%;
        border: 1.2px solid rgba(120,130,200,0.13);
        color: #fff;
        box-shadow: 0 4px 24px 0 rgba(99,102,241,0.18);
        transition: background 0.18s, border 0.18s, box-shadow 0.18s, transform 0.18s;
    }
    .glass-fab:hover {
        background: #6366f1;
        color: #fff;
        transform: scale(1.08);
        box-shadow: 0 8px 32px 0 rgba(99,102,241,0.28);
    }
    .empty-borrow {
        color: #a5b4fc;
        font-size: 1.1rem;
        font-weight: 600;
        padding: 18px 0 10px 0;
        letter-spacing: 0.5px;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 10px;
    }
    .empty-borrow svg {
        width: 44px; height: 44px;
        opacity: 0.7;
        margin-bottom: 8px;
    }
    @media (max-width: 700px) {
        .glass-container { border-radius: 12px; }
        .glass-table th, .glass-table td { padding: 0.6rem 0.5rem; font-size: 0.93rem; }
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
<div class="w-full max-w-md sm:max-w-xl md:max-w-2xl lg:max-w-4xl xl:max-w-6xl mx-auto py-8 px-2 sm:px-4 relative z-10">
    <h1 class="text-2xl font-bold mb-4 text-white">Daftar Peminjaman</h1>
    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded shadow">{{ session('success') }}</div>
    @endif
    <div class="glass-container p-2 sm:p-4">
        <table class="min-w-full glass-table divide-y divide-gray-200 dark:divide-zinc-700">
            <thead>
                <tr>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-zinc-200">Buku</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-zinc-200">Peminjam</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-zinc-200">Tanggal Pinjam</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-zinc-200">Tanggal Kembali</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-zinc-200">Status</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-zinc-200">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($borrows as $borrow)
                <tr>
                    <td class="px-4 py-2 align-middle text-zinc-100 flex items-center gap-3">
                        @if($borrow->book && $borrow->book->cover)
                            <img src="{{ $borrow->book->cover }}" alt="{{ $borrow->book->title }}" class="w-10 h-14 object-cover rounded shadow border border-gray-200 dark:border-zinc-800">
                        @else
                            <div class="w-10 h-14 flex items-center justify-center bg-zinc-800 text-zinc-500 text-xs rounded">No Cover</div>
                        @endif
                        <span>{{ $borrow->book->title ?? '-' }}</span>
                    </td>
                    <td class="px-4 py-2 align-middle text-zinc-100">{{ $borrow->user->name ?? '-' }}</td>
                    <td class="px-4 py-2 align-middle text-zinc-100">{{ \Carbon\Carbon::parse($borrow->borrowed_at)->translatedFormat('d F Y') }}</td>
                    <td class="px-4 py-2 align-middle text-zinc-100">{{ $borrow->returned_at ? \Carbon\Carbon::parse($borrow->returned_at)->translatedFormat('d F Y') : '-' }}</td>
                    <td class="px-4 py-2 align-middle">
                        @if(!$borrow->returned_at)
                            <span class="glass-badge borrowed">Dipinjam</span>
                        @else
                            <span class="glass-badge done">Selesai</span>
                        @endif
                    </td>
                    <td class="px-4 py-2 align-middle">
                        @if(!$borrow->returned_at)
                        <form action="{{ route('borrows.update', $borrow) }}" method="POST" onsubmit="return confirm('Kembalikan buku ini?')" class="inline">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="p-2 glass-fab w-10 h-10 flex items-center justify-center" title="Kembalikan">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-green-400">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5l15-15m0 0v6.75m0-6.75H12" />
                                </svg>
                            </button>
                        </form>
                        @else
                        <span class="text-zinc-500">-</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-10">
                        <div class="empty-borrow">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 48 48" stroke-width="1.5" stroke="currentColor">
                                <rect x="8" y="8" width="32" height="32" rx="6" fill="currentColor" fill-opacity="0.1" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 20h16M16 28h8" />
                            </svg>
                            Belum ada peminjaman.
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<a href="{{ route('borrows.create') }}"
   class="fixed bottom-8 right-8 glass-fab w-16 h-16 flex items-center justify-center shadow-2xl text-3xl font-bold transition-all duration-200 z-50 group hover:scale-110"
   title="Pinjam Buku">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-9 h-9">
        <circle cx="12" cy="12" r="11" stroke="currentColor" stroke-width="1.5" fill="none" />
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 7v10m5-5H7" />
    </svg>
    <span class="absolute opacity-0 group-hover:opacity-100 bg-blue-700 text-white text-xs rounded px-2 py-1 transition-all duration-200 -top-8">Pinjam Buku</span>
</a>
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