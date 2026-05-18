<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portofolio</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/devicon.min.css">
</head>
<body class="bg-gray-950 text-white">

    <nav class="fixed w-full z-50 bg-gray-900/80 backdrop-blur border-b border-gray-800">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <a href="{{ route('home') }}" class="text-xl font-bold text-indigo-400">Portofolio</a>
            <div class="flex gap-6 text-sm">
                <a href="{{ route('home') }}"
                   class="hover:text-indigo-400 transition {{ request()->routeIs('home') ? 'text-indigo-400' : 'text-gray-300' }}">
                    Home
                </a>
                <a href="{{ route('projects') }}"
                   class="hover:text-indigo-400 transition {{ request()->routeIs('projects*') ? 'text-indigo-400' : 'text-gray-300' }}">
                    Projects
                </a>
                <a href="{{ route('contact') }}"
                   class="hover:text-indigo-400 transition {{ request()->routeIs('contact') ? 'text-indigo-400' : 'text-gray-300' }}">
                    Contact
                </a>
            </div>
        </div>
    </nav>

    <main class="pt-20">
        {{ $slot }}
    </main>

    <footer class="text-center py-6 text-gray-500 text-sm border-t border-gray-800 mt-10">
        &copy; {{ date('Y') }} Portfolio. All rights reserved.
    </footer>

    @livewireScripts
</body>
</html>
