<x-layouts.app :title="'Dashboard'">
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
    .glass-card {
        background: rgba(30,34,54,0.68);
        border-radius: 28px;
        box-shadow: 0 8px 40px 0 rgba(30,34,54,0.22);
        backdrop-filter: blur(14px) saturate(140%);
        border: 1.5px solid rgba(120,130,200,0.13);
        transition: box-shadow 0.18s, transform 0.18s;
    }
    .glass-card:hover {
        box-shadow: 0 12px 32px 0 rgba(99,102,241,0.10);
    }
    .glass-action {
        background: rgba(49,54,80,0.82);
        border-radius: 20px;
        box-shadow: 0 4px 18px 0 rgba(99,102,241,0.10);
        border: 1.2px solid rgba(120,130,200,0.10);
        transition: background 0.18s, transform 0.18s, box-shadow 0.18s;
        position: relative;
    }
    .glass-action:hover {
        background: rgba(99,102,241,0.13);
        box-shadow: 0 0 0 3px #6366f1, 0 8px 32px 0 rgba(99,102,241,0.18);
        transform: scale(1.07);
    }
    .glass-chart {
        background: rgba(40,44,70,0.45);
        box-shadow: 0 2px 12px 0 rgba(99,102,241,0.08);
        border: 1.2px solid rgba(120,130,200,0.10);
        backdrop-filter: blur(8px) saturate(120%);
        border-radius: 18px;
        padding: 32px 40px 28px 40px;
        margin-bottom: 8px;
        width: 100%;
        max-width: 48rem;
    }
    .divider {
        width: 100%;
        height: 1.5px;
        background: linear-gradient(90deg, transparent, #6366f1 40%, transparent);
        opacity: 0.18;
        margin: 18px 0 10px 0;
    }
    .stat-card {
        background: rgba(49,54,80,0.82);
        border-radius: 18px;
        box-shadow: 0 2px 12px 0 rgba(99,102,241,0.08);
        border: 1.2px solid rgba(120,130,200,0.10);
        padding: 22px 32px;
        min-width: 180px;
        flex: 1 1 0%;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 10px;
        transition: box-shadow 0.18s, transform 0.18s;
    }
    .stat-card:hover {
        box-shadow: 0 8px 32px 0 rgba(99,102,241,0.13);
        transform: translateY(-2px) scale(1.01);
        border-color: rgba(99,102,241,0.13);
    }
    .activity-card {
        background: rgba(49,54,80,0.82);
        border-radius: 16px;
        box-shadow: 0 2px 12px 0 rgba(99,102,241,0.08);
        border: 1.2px solid rgba(120,130,200,0.10);
        padding: 16px 22px;
        display: flex;
        align-items: center;
        gap: 18px;
        transition: box-shadow 0.18s, transform 0.18s;
    }
    .activity-card:hover {
        box-shadow: 0 8px 32px 0 rgba(99,102,241,0.18);
        transform: translateY(-2px) scale(1.01);
    }
    .activity-card .icon {
        min-width: 40px;
        min-height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: rgba(99,102,241,0.13);
    }
    .empty-activity {
        color: #a0aec0;
        padding: 32px 0;
        text-align: center;
    }
    .dashboard-main {
        margin-top: 0;
        padding: 32px 24px 24px 24px;
        border-radius: 28px;
        display: flex;
        flex-direction: column;
        gap: 28px;
    }
    @media (max-width: 900px) {
        .stat-card, .glass-action {
            min-width: 100%;
            width: 100%;
            padding: 10px 10px;
            border-radius: 18px;
            margin: 0 auto;
            box-shadow: 0 1px 6px 0 rgba(99,102,241,0.06);
            font-size: 0.97rem;
        }
        .stat-card svg {
            width: 2.1rem;
            height: 2.1rem;
        }
        .stat-card + .stat-card {
            margin-top: 10px;
        }
        .activity-card { flex-direction: column; align-items: flex-start; gap: 8px; }
        .dashboard-main { padding: 12px 4px 10px 4px; gap: 16px; }
        .glass-chart { padding: 16px 4px 12px 4px; max-width: 100%; }
        .stat-list-mobile {
            max-width: 24rem;
            margin-left: auto;
            margin-right: auto;
        }
    }
</style>
<canvas class="meteor-bg"></canvas>
<div class="max-w-6xl mx-auto py-10 px-2 md:px-4">
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
    <div class="flex items-center gap-4 mb-8 glass-card p-6">
        @if(isset($user) && $user && $user->profile_photo_path)
            <img src="{{ asset('storage/' . $user->profile_photo_path) }}" alt="Avatar" class="w-20 h-20 rounded-full object-cover shadow border-4 border-indigo-400">
        @else
            <div class="w-20 h-20 rounded-full bg-gradient-to-tr from-indigo-500/40 to-pink-500/40 flex items-center justify-center text-4xl font-bold text-white shadow border-4 border-indigo-400">
                {{ strtoupper(substr($greetingName ?? 'U',0,1)) }}
            </div>
        @endif
        <div>
            <div class="text-2xl font-bold text-white">{{ $greet }}, {{ $greetingName ?? 'User' }}!</div>
            <div class="text-indigo-200 text-base">Statistik dan aktivitas e-Library Anda.</div>
        </div>
    </div>
    <!-- Main Container -->
    <div class="glass-card dashboard-main">
        <!-- Pengumuman/Info Penting -->
        <div class="text-indigo-100 px-6 py-4 rounded-lg text-base flex items-center gap-3">
            <svg class="w-6 h-6 text-yellow-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M12 20a8 8 0 100-16 8 8 0 000 16z"/></svg>
            <span>Selamat datang di <b>e-Library</b>! Jangan lupa kembalikan buku tepat waktu 😊</span>
        </div>
        <!-- Quick Action -->
        <div class="flex flex-wrap gap-6">
            <a href="{{ route('books.create') }}" class="flex flex-col items-center justify-center w-28 h-28 glass-action text-white transition-all duration-200 group" title="Tambah Buku">
                <svg class="w-10 h-10 mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <circle cx="12" cy="12" r="11" stroke="currentColor" stroke-width="1.5" fill="none" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 7v10m5-5H7" />
                </svg>
                <span class="text-sm font-bold">Tambah</span>
            </a>
            <a href="{{ route('borrows.create') }}" class="flex flex-col items-center justify-center w-28 h-28 glass-action text-white transition-all duration-200 group" title="Pinjam Buku">
                <svg class="w-10 h-10 mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <rect x="6" y="7" width="12" height="10" rx="2" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 3h6v4H9z" />
                </svg>
                <span class="text-sm font-bold">Pinjam</span>
            </a>
            <a href="{{ route('books.index') }}" class="flex flex-col items-center justify-center w-28 h-28 glass-action text-white transition-all duration-200 group" title="Daftar Buku">
                <svg class="w-10 h-10 mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <rect x="6" y="6" width="12" height="12" rx="2" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 10h6M9 14h6" />
                </svg>
                <span class="text-sm font-bold">Buku</span>
            </a>
            <a href="{{ route('favorites.index') }}" class="flex flex-col items-center justify-center w-28 h-28 glass-action text-white transition-all duration-200 group" title="Favorit Saya">
                <svg class="w-10 h-10 mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41 0.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                </svg>
                <span class="text-sm font-bold">Favorit</span>
            </a>
        </div>
        <!-- Statistik Utama -->
        <div class="flex flex-col gap-2 w-full md:flex-row md:gap-6 md:items-center md:justify-between md:w-full md:max-w-none md:mx-0">
            <div class="stat-card">
                <div class="flex items-center gap-3">
                    <svg class="w-9 h-9 text-indigo-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6l4 2"/></svg>
                    <span class="text-3xl font-extrabold text-white">{{ $totalBooks }}</span>
                </div>
                <div class="text-sm text-indigo-200 font-semibold">Total Buku</div>
            </div>
            <div class="stat-card">
                <div class="flex items-center gap-3">
                    <svg class="w-9 h-9 text-pink-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41 0.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                    <span class="text-3xl font-extrabold text-white">{{ $favoriteBooks }}</span>
                </div>
                <div class="text-sm text-pink-200 font-semibold">Favorit Saya</div>
            </div>
            <div class="stat-card">
                <div class="flex items-center gap-3">
                    <svg class="w-9 h-9 text-blue-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21H5a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2h4V3h6v2h4a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2z"/></svg>
                    <span class="text-3xl font-extrabold text-white">{{ $activeBorrows }}</span>
                </div>
                <div class="text-sm text-blue-200 font-semibold">Peminjaman Aktif</div>
            </div>
            <div class="stat-card">
                <div class="flex items-center gap-3">
                    <svg class="w-9 h-9 text-green-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><rect x="3" y="7" width="18" height="13" rx="2"/><rect x="3" y="4" width="18" height="3" rx="1.5"/></svg>
                    <span class="text-3xl font-extrabold text-white">{{ $totalBorrows }}</span>
                </div>
                <div class="text-sm text-green-200 font-semibold">Total Peminjaman</div>
            </div>
        </div>
        <!-- Mini Chart Statistik & Divider -->
        <div class="divider"></div>
        <div class="w-full flex flex-col items-center justify-center">
            <h2 class="flex items-center gap-2 text-base font-bold mb-2 text-indigo-300">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-6a2 2 0 012-2h2a2 2 0 012 2v6"/></svg>
                Statistik Peminjaman per Bulan
            </h2>
            <div class="w-full max-w-md glass-chart">
                <canvas id="chart-statistik" style="width:100%;height:120px;min-height:100px;"></canvas>
            </div>
        </div>
        <div class="divider"></div>
        <!-- Aktivitas Terakhir -->
        <div class="w-full">
            <h2 class="flex items-center gap-2 text-base font-bold mb-2 text-indigo-300">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v4a1 1 0 001 1h3m10-5v4a1 1 0 01-1 1h-3m-4 4h6"/></svg>
                Aktivitas Terakhir
            </h2>
            <div class="flex flex-col gap-5">
                @forelse($recentActivities as $activity)
                <div class="activity-card">
                    <span class="icon">
                    @if($activity['type'] === 'borrowed')
                        <svg class="w-7 h-7 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6l4 2"/></svg>
                    @else
                        <svg class="w-7 h-7 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    @endif
                    </span>
                    <div class="flex-1">
                        <div class="font-bold text-white text-base">
                            {{ $activity['type'] === 'borrowed' ? 'Meminjam' : 'Mengembalikan' }} buku
                            <span class="text-blue-300">{{ $activity['book']->title ?? '-' }}</span>
                        </div>
                        <div class="text-xs text-indigo-200">
                            {{ \Carbon\Carbon::parse($activity['date'])->translatedFormat('d F Y') }}
                        </div>
                    </div>
                    <span class="text-xs px-3 py-1 rounded-full {{ $activity['type'] === 'borrowed' ? 'bg-blue-200/20 text-blue-200' : 'bg-green-200/20 text-green-200' }} font-semibold">
                        {{ $activity['type'] === 'borrowed' ? 'Dipinjam' : 'Dikembalikan' }}
                    </span>
                </div>
                @empty
                <div class="empty-activity">Belum ada aktivitas peminjaman atau pengembalian buku.</div>
                @endforelse
            </div>
        </div>
    </div>
</div>  
<!-- FAB Quick Action -->
<button id="fab-quick" class="fixed bottom-8 right-8 glass-fab w-16 h-16 flex items-center justify-center shadow-2xl text-3xl font-bold transition-all duration-200 z-50 group hover:scale-110" onclick="document.getElementById('fab-menu').classList.toggle('hidden')" title="Aksi Cepat">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-9 h-9">
        <circle cx="12" cy="12" r="11" stroke="currentColor" stroke-width="1.5" fill="none" />
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 7v10m5-5H7" />
    </svg>
</button>
<div id="fab-menu" class="fixed bottom-28 right-8 bg-zinc-900/90 rounded-xl shadow-lg p-4 flex flex-col gap-3 z-50 hidden">
    <a href="{{ route('books.create') }}" class="flex items-center gap-2 px-4 py-2 rounded-lg hover:bg-indigo-700 text-white transition"><svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>Tambah Buku</a>
    <a href="{{ route('borrows.create') }}" class="flex items-center gap-2 px-4 py-2 rounded-lg hover:bg-indigo-700 text-white transition"><svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><rect x="6" y="7" width="12" height="10" rx="2" /><path stroke-linecap="round" stroke-linejoin="round" d="M9 3h6v4H9z" /></svg>Pinjam Buku</a>
    <a href="{{ route('favorites.index') }}" class="flex items-center gap-2 px-4 py-2 rounded-lg hover:bg-indigo-700 text-white transition"><svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41 0.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" /></svg>Favorit Saya</a>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
// Mini Chart Statistik Dummy
const ctx = document.getElementById('chart-statistik').getContext('2d');
new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
        datasets: [{
            label: 'Peminjaman',
            data: [2, 4, 3, 5, 6, 4, 7, 3, 2, 5, 4, 6],
            backgroundColor: 'rgba(99,102,241,0.6)',
            borderRadius: 6,
            maxBarThickness: 20,
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: { 
            legend: { display: false },
            tooltip: { enabled: true, backgroundColor: '#232946', titleColor: '#a5b4fc', bodyColor: '#fff', borderColor: '#6366f1', borderWidth: 1 }
        },
        scales: {
            x: { 
                grid: { display: false }, 
                ticks: { 
                    color: '#a5b4fc', 
                    font: { size: 10, weight: 'bold' } 
                } 
            },
            y: { 
                grid: { color: 'rgba(99,102,241,0.06)' }, 
                ticks: { 
                    color: '#a5b4fc',
                    font: { size: 10 },
                    maxTicksLimit: 5
                }, 
                beginAtZero: true 
            }
        }
    }
});
// FAB menu close on click outside
window.addEventListener('click', function(e) {
    const fab = document.getElementById('fab-quick');
    const menu = document.getElementById('fab-menu');
    if (!fab.contains(e.target) && !menu.contains(e.target)) menu.classList.add('hidden');
});
// Tooltip Quick Action
[...document.querySelectorAll('.glass-action')].forEach(el => {
    el.addEventListener('mouseenter', function() {
        if (!el.title) return;
        const tip = document.createElement('div');
        tip.className = 'fixed z-50 px-3 py-1 rounded-lg text-xs font-semibold bg-indigo-700 text-white shadow-lg';
        tip.innerText = el.title;
        document.body.appendChild(tip);
        const rect = el.getBoundingClientRect();
        tip.style.left = (rect.left + rect.width/2 - tip.offsetWidth/2) + 'px';
        tip.style.top = (rect.top - tip.offsetHeight - 8) + 'px';
        el._tip = tip;
    });
    el.addEventListener('mouseleave', function() {
        if (el._tip) el._tip.remove();
    });
});
</script>
</x-layouts.app>

