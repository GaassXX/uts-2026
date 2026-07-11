<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Portofolio</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/devicon.min.css">
    <style>
        html { scroll-behavior: smooth; }
        .reveal { opacity: 0; transform: translateY(40px); transition: opacity 0.7s ease, transform 0.7s ease; }
        .reveal.visible { opacity: 1; transform: translateY(0); }
        .reveal-left { opacity: 0; transform: translateX(-40px); transition: opacity 0.7s ease, transform 0.7s ease; }
        .reveal-left.visible { opacity: 1; transform: translateX(0); }
        .reveal-right { opacity: 0; transform: translateX(40px); transition: opacity 0.7s ease, transform 0.7s ease; }
        .reveal-right.visible { opacity: 1; transform: translateX(0); }
    </style>
</head>
<body class="bg-[#0a0a0f] text-white">

    <nav class="fixed w-full z-50 bg-[#0a0a0f]/80 backdrop-blur border-b border-white/5">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <a href="{{ route('home') }}" class="text-xl font-bold text-indigo-400">Portofolio</a>
            <div class="flex gap-1 text-sm">
                <a href="{{ route('home') }}"
                   class="px-4 py-2 rounded-lg transition {{ request()->routeIs('home') ? 'bg-indigo-600/20 text-indigo-400' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                    Home
                </a>
                <a href="{{ route('projects') }}"
                   class="px-4 py-2 rounded-lg transition {{ request()->routeIs('projects*') ? 'bg-indigo-600/20 text-indigo-400' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                    Projects
                </a>
                <a href="{{ route('contact') }}"
                   class="px-4 py-2 rounded-lg transition {{ request()->routeIs('contact') ? 'bg-indigo-600/20 text-indigo-400' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                    Contact
                </a>
            </div>
        </div>
    </nav>

    <main>{{ $slot }}</main>

    <footer class="text-center py-6 text-gray-500 text-sm border-t border-white/5">
        &copy; {{ date('Y') }} Portofolio. Rizqi Bagas Wicaksono.
    </footer>

    @livewireScripts

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry, i) => {
                    if (entry.isIntersecting) {
                        setTimeout(() => entry.target.classList.add('visible'), i * 80);
                    } else {
                    // Reset saat keluar viewport → animasi jalan lagi saat scroll balik
                        entry.target.classList.remove('visible');
                    }
                });
            }, { threshold: 0.1 });

            document.querySelectorAll('.reveal, .reveal-left, .reveal-right').forEach(el => observer.observe(el));
        });
    </script>
</body>
</html>
