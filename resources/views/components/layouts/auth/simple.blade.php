<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
        <style>
            body {
                min-height: 100vh;
                margin: 0;
                font-family: 'Inter', sans-serif;
                background: linear-gradient(135deg, #181c2a 0%, #232946 100%);
                color: #f3f4f6;
            }
            .auth-bg {
                min-height: 100vh;
                min-height: 100svh;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                gap: 2.5rem;
                padding: 2rem 0;
                background: none;
            }
            .auth-card {
                background: rgba(30,34,54,0.68);
                border-radius: 28px;
                box-shadow: 0 8px 40px 0 rgba(30,34,54,0.22);
                padding: 38px 28px 32px 28px;
                max-width: 370px;
                width: 100%;
                position: relative;
                z-index: 1;
                backdrop-filter: blur(14px) saturate(140%);
                border: 1.5px solid rgba(120,130,200,0.13);
                display: flex;
                flex-direction: column;
                gap: 1.5rem;
            }
            .auth-logo {
                display: flex;
                flex-direction: column;
                align-items: center;
                margin-bottom: 10px;
            }
            .auth-logo .logo-glow {
                position: absolute;
                width: 60px;
                height: 60px;
                border-radius: 50%;
                background: radial-gradient(circle, #6366f1 0%, #232946 80%);
                filter: blur(14px) brightness(1.2);
                opacity: 0.38;
                z-index: 0;
                left: 50%;
                top: 0;
                transform: translate(-50%, 10px);
                pointer-events: none;
            }
            .auth-logo svg {
                width: 44px;
                height: 44px;
                z-index: 1;
                position: relative;
            }
            @media (max-width: 500px) {
                .auth-card { padding: 18px 2px 14px 2px; max-width: 98vw; }
            }
        </style>
    </head>
    <body>
        <div class="auth-bg">
            <div class="auth-card">
                <div class="auth-logo" style="position:relative;">
                    <div class="logo-glow"></div>
                    <x-app-logo-icon class="size-11 fill-current text-white" />
                </div>
                {{ $slot }}
            </div>
        </div>
        @fluxScripts
    </body>
</html>
