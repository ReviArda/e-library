<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<title>{{ $title ?? config('app.name') }}</title>

<link rel="icon" href="/favicon.ico" sizes="any">
<link rel="icon" href="/favicon.svg" type="image/svg+xml">
<link rel="apple-touch-icon" href="/apple-touch-icon.png">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

@vite(['resources/css/app.css', 'resources/js/app.js'])
@fluxAppearance

<!-- Chart.js CDN for modern charts -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
  html, body {
    font-family: 'Inter', 'Poppins', 'Instrument Sans', ui-sans-serif, system-ui, sans-serif !important;
    letter-spacing: 0.01em;
    background: linear-gradient(135deg, #181c2a 0%, #232946 100%) !important;
    color-scheme: dark;
  }
  .neon-text {
    color: #fff;
    text-shadow: 0 0 8px #6366f1, 0 0 16px #ec4899, 0 0 2px #a21caf;
  }
  .neon-border {
    box-shadow: 0 0 0 2px #6366f1, 0 0 12px #ec4899, 0 0 24px #a21caf;
  }
  .fade-in {
    opacity: 0;
    animation: fadeIn 0.7s ease-out forwards;
  }
  @keyframes fadeIn {
    to { opacity: 1; }
  }
  .slide-up {
    opacity: 0;
    transform: translateY(32px);
    animation: slideUp 0.7s cubic-bezier(.4,2,.6,1) forwards;
  }
  @keyframes slideUp {
    to { opacity: 1; transform: none; }
  }
</style>
