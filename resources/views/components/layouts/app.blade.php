<!DOCTYPE html>
<html lang="id">
<head>
    @include('partials.head')
</head>
<body class="bg-zinc-900 text-white min-h-screen font-sans">
    @include('components.layouts.app.sidebar')
    <main class="ml-0 lg:ml-64 pt-6 px-4 md:px-8 fade-in">
        {{ $slot }}
    </main>
</body>
</html>
