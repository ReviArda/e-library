<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
        <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
        <style>
            .sidebar-glass {
                background: rgba(24, 28, 42, 0.82);
                border-right: 1.5px solid rgba(120,130,200,0.13);
                box-shadow: 0 8px 40px 0 rgba(30,34,54,0.18);
                backdrop-filter: blur(16px) saturate(140%);
            }
            .sidebar-logo {
                display: flex;
                align-items: center;
                gap: 0.7rem;
                font-weight: 700;
                font-size: 1.18rem;
                color: #fff;
                letter-spacing: 0.5px;
                margin-bottom: 1.5rem;
                margin-top: 0.5rem;
                padding-left: 0.5rem;
                text-shadow: 0 2px 16px #6366f1cc;
            }
            .sidebar-logo svg {
                filter: drop-shadow(0 0 8px #6366f1cc);
            }
            .sidebar-menu {
                display: flex;
                flex-direction: column;
                gap: 0.5rem;
                margin-bottom: 2.5rem;
            }
            .sidebar-item {
                display: flex;
                align-items: center;
                gap: 0.7rem;
                padding: 0.7rem 1.1rem;
                border-radius: 12px;
                color: #c7d2fe;
                font-weight: 500;
                font-size: 1rem;
                transition: background 0.18s, color 0.18s, box-shadow 0.18s;
                cursor: pointer;
                background: transparent;
            }
            .sidebar-item.active, .sidebar-item:hover {
                background: rgba(99,102,241,0.13);
                color: #fff;
                box-shadow: 0 2px 12px 0 rgba(99,102,241,0.10);
            }
            .sidebar-item svg {
                width: 1.3em;
                height: 1.3em;
                color: #a5b4fc;
                transition: color 0.18s;
            }
            .sidebar-item.active svg, .sidebar-item:hover svg {
                color: #fff;
            }
            .sidebar-section-title {
                color: #a5b4fc;
                font-size: 0.93rem;
                font-weight: 600;
                letter-spacing: 0.5px;
                margin: 0.5rem 0 0.7rem 1.1rem;
            }
            .sidebar-profile {
                display: flex;
                align-items: center;
                gap: 0.7rem;
                background: rgba(49,54,80,0.22);
                border-radius: 12px;
                padding: 0.7rem 1.1rem;
                margin: 2.5rem 0 0.5rem 0;
                color: #fff;
                font-size: 1rem;
                box-shadow: 0 2px 12px 0 rgba(99,102,241,0.10);
            }
            .sidebar-avatar {
                width: 2.2em;
                height: 2.2em;
                border-radius: 50%;
                background: linear-gradient(135deg, #6366f1 40%, #232946 100%);
                display: flex;
                align-items: center;
                justify-content: center;
                font-weight: 700;
                font-size: 1.1em;
                color: #fff;
                box-shadow: 0 2px 12px 0 #6366f1cc;
            }
            @media (max-width: 900px) {
                .sidebar-glass { border-radius: 0 0 18px 0; }
            }
            .sidebar-drawer-bg {
                background: rgba(24,28,42,0.7);
                backdrop-filter: blur(2px);
            }
        </style>
    </head>
    <body class="min-h-screen bg-white dark:bg-zinc-800" x-data="{ sidebarOpen: false }">
        <canvas class="meteor-bg"></canvas>
        <div class="flex min-h-screen">
            <!-- Sidebar Desktop -->
            <aside class="sidebar-glass fixed top-0 left-0 h-screen w-64 flex-col p-5 z-30 hidden lg:flex">
                <a href="{{ route('dashboard') }}" class="sidebar-logo mb-8" wire:navigate>
                    <x-app-logo-icon class="h-8 w-8" />
                    e-Library
                </a>
                <div class="sidebar-section-title mb-2">Platform</div>
                <nav class="sidebar-menu flex-1">
                    <a href="{{ route('dashboard') }}" class="sidebar-item{{ request()->routeIs('dashboard') ? ' active' : '' }}" wire:navigate>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0h6" /></svg>
                        Dashboard
                    </a>
                    <a href="{{ route('books.index') }}" class="sidebar-item{{ request()->routeIs('books.*') ? ' active' : '' }}" wire:navigate>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6l4 2" /><rect x="4" y="4" width="16" height="16" rx="2" /></svg>
                        Buku
                    </a>
                    <a href="{{ route('borrows.index') }}" class="sidebar-item{{ request()->routeIs('borrows.*') ? ' active' : '' }}" wire:navigate>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8 17l4 4 4-4m0 0V3m0 14H4" /></svg>
                        Peminjaman
                    </a>
                </nav>
                <div class="mt-auto pt-8">
                    <div class="sidebar-profile">
                        <div class="sidebar-avatar">{{ auth()->user()->initials() }}</div>
                        <div>
                            <div class="font-semibold">{{ auth()->user()->name }}</div>
                            <div class="text-xs text-zinc-400">{{ auth()->user()->email }}</div>
                        </div>
                    </div>
                    <div class="flex flex-col gap-2 mt-3">
                        <a href="{{ route('settings.profile') }}" class="sidebar-item" style="background:rgba(99,102,241,0.09);">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
                            Pengaturan
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="sidebar-item w-full text-left" style="background:rgba(239,68,68,0.09);">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H7a2 2 0 01-2-2V7a2 2 0 012-2h4a2 2 0 012 2v1" /></svg>
                                Keluar
                            </button>
                        </form>
                    </div>
                </div>
            </aside>
            <!-- Sidebar Mobile Drawer -->
            <template x-if="sidebarOpen">
                <div class="fixed inset-0 z-40 flex lg:hidden"
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 -translate-x-8"
                    x-transition:enter-end="opacity-100 translate-x-0"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 translate-x-0"
                    x-transition:leave-end="opacity-0 -translate-x-8">
                    <div class="sidebar-drawer-bg absolute inset-0" @click="sidebarOpen = false"></div>
                    <aside class="sidebar-glass h-screen w-64 flex flex-col p-5 z-50 relative">
                        <button class="absolute top-4 right-4 text-zinc-400 hover:text-white text-2xl" @click="sidebarOpen = false">&times;</button>
                        <a href="{{ route('dashboard') }}" class="sidebar-logo mb-8" wire:navigate @click="sidebarOpen = false">
                            <x-app-logo-icon class="h-8 w-8" />
                            e-Library
                        </a>
                        <div class="sidebar-section-title mb-2">Platform</div>
                        <nav class="sidebar-menu flex-1">
                            <a href="{{ route('dashboard') }}" class="sidebar-item{{ request()->routeIs('dashboard') ? ' active' : '' }}" wire:navigate @click="sidebarOpen = false">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0h6" /></svg>
                                Dashboard
                            </a>
                            <a href="{{ route('books.index') }}" class="sidebar-item{{ request()->routeIs('books.*') ? ' active' : '' }}" wire:navigate @click="sidebarOpen = false">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6l4 2" /><rect x="4" y="4" width="16" height="16" rx="2" /></svg>
                                Buku
                            </a>
                            <a href="{{ route('borrows.index') }}" class="sidebar-item{{ request()->routeIs('borrows.*') ? ' active' : '' }}" wire:navigate @click="sidebarOpen = false">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8 17l4 4 4-4m0 0V3m0 14H4" /></svg>
                                Peminjaman
                            </a>
                        </nav>
                        <div class="mt-auto pt-8">
                            <div class="sidebar-profile">
                                <div class="sidebar-avatar">{{ auth()->user()->initials() }}</div>
                                <div>
                                    <div class="font-semibold">{{ auth()->user()->name }}</div>
                                    <div class="text-xs text-zinc-400">{{ auth()->user()->email }}</div>
                                </div>
                            </div>
                            <div class="flex flex-col gap-2 mt-3">
                                <a href="{{ route('settings.profile') }}" class="sidebar-item" style="background:rgba(99,102,241,0.09);">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
                                    Pengaturan
                                </a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="sidebar-item w-full text-left" style="background:rgba(239,68,68,0.09);">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H7a2 2 0 01-2-2V7a2 2 0 012-2h4a2 2 0 012 2v1" /></svg>
                                        Keluar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </aside>
                </div>
            </template>
            <!-- Hamburger Button Mobile -->
            <button class="fixed top-4 left-4 z-50 p-2 rounded-lg bg-zinc-900/70 text-white shadow-lg lg:hidden sm:top-6 sm:left-6" @click="sidebarOpen = true" x-show="!sidebarOpen">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-7 h-7">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
            <main class="flex-1 ml-0 lg:ml-64 min-h-screen">
                {{ $slot }}
            </main>
        </div>
        @fluxScripts
    </body>
</html>
