<div class="min-h-screen bg-gray-950 text-white">

    {{-- HERO SECTION --}}
    <section class="min-h-screen flex items-center px-6 max-w-7xl mx-auto">

        {{-- LEFT COLUMN --}}
        <div class="flex-1 space-y-6">
            <div class="inline-flex items-center gap-2 bg-gray-800 px-4 py-2 rounded-full text-sm text-gray-300">
                <span>👋</span> Hello, I'm
            </div>

            <div>
                <h1 class="text-6xl font-bold leading-tight">
                    {{ collect(explode(' ', $profile?->name ?? 'Your Name'))->first() }}
                    <span class="text-indigo-400">
                        {{ collect(explode(' ', $profile?->name ?? 'Your Name'))->skip(1)->implode(' ') }}
                    </span>
                </h1>
                <p class="text-2xl text-gray-400 mt-2">{{ $profile?->tagline ?? 'Full Stack Developer' }}</p>
            </div>

            <p class="text-gray-400 leading-relaxed max-w-lg text-lg">
                {{ $profile?->bio ?? 'Bio singkat' }}
            </p>

            {{-- CTA BUTTONS --}}
            <div class="flex gap-4 flex-wrap">
                <a href="{{ route('projects') }}"
                   class="flex items-center gap-2 px-6 py-3 bg-indigo-600 hover:bg-indigo-700 rounded-lg font-semibold transition">
                    Lihat Project Saya →
                </a>
                <a href="{{ route('contact') }}"
                   class="flex items-center gap-2 px-6 py-3 border border-gray-600 hover:border-indigo-500 rounded-lg font-semibold transition">
                    Hubungi Saya
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </a>
            </div>

            {{-- SOCIAL LINKS --}}
            <div class="flex gap-3">
                @if($profile?->github)
                <a href="{{ $profile->github }}" target="_blank"
                   class="w-11 h-11 flex items-center justify-center border border-gray-700 rounded-lg hover:border-indigo-500 hover:text-indigo-400 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0 0 24 12c0-6.63-5.37-12-12-12z"/>
                    </svg>
                </a>
                @endif

                @if($profile?->linkedin)
                <a href="{{ $profile->linkedin }}" target="_blank"
                   class="w-11 h-11 flex items-center justify-center border border-gray-700 rounded-lg hover:border-blue-500 hover:text-blue-400 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 0 1-2.063-2.065 2.064 2.064 0 1 1 2.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                    </svg>
                </a>
                @endif

                <a href="{{ route('contact') }}"
                   class="w-11 h-11 flex items-center justify-center border border-gray-700 rounded-lg hover:border-indigo-500 hover:text-indigo-400 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </a>
            </div>
        </div>

        {{-- RIGHT COLUMN --}}
        <div class="flex-1 flex justify-center">
            <div class="relative">
                <div class="w-80 bg-gray-900 border border-gray-800 rounded-2xl overflow-hidden shadow-2xl shadow-indigo-500/10">

                    {{-- Available Badge --}}
                    <div class="absolute top-4 right-4 flex items-center gap-2 bg-gray-800/90 backdrop-blur px-3 py-1 rounded-full text-xs z-10">
                        <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span>
                        {{ $profile?->availability ?? 'Available for work' }}
                    </div>

                    {{-- Photo --}}
                    @if($profile?->photo)
                        <img src="{{ Storage::url($profile->photo) }}"
                             class="w-full h-72 object-cover object-top"
                             alt="{{ $profile->name }}">
                    @else
                        <div class="w-full h-72 bg-gradient-to-br from-indigo-600 to-purple-700 flex items-center justify-center text-7xl font-bold">
                            {{ strtoupper(substr($profile?->name ?? 'P', 0, 1)) }}
                        </div>
                    @endif

                    {{-- Stats --}}
                    <div class="grid grid-cols-3 divide-x divide-gray-800 border-t border-gray-800">
                        <div class="py-4 text-center">
                            <p class="text-xl font-bold text-indigo-400">{{ $profile?->years_experience ?? '1' }}+</p>
                            <p class="text-xs text-gray-500 mt-1">Years Exp</p>
                        </div>
                        <div class="py-4 text-center">
                            <p class="text-xl font-bold text-green-400">{{ $profile?->total_projects ?? '0' }}+</p>
                            <p class="text-xs text-gray-500 mt-1">Projects</p>
                        </div>
                        <div class="py-4 text-center">
                            <p class="text-xl font-bold text-yellow-400">100%</p>
                            <p class="text-xs text-gray-500 mt-1">Committed</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- TECH STACK SECTION --}}
    @if($profile?->skills)
    <section class="py-16 px-6 max-w-7xl mx-auto">
        <div class="flex items-center justify-center gap-3 mb-8 text-gray-400">
            <div class="h-px bg-gradient-to-r from-transparent via-gray-800 to-transparent flex-1"></div>
            <span class="text-sm font-semibold whitespace-nowrap">⚡ Tech Stack</span>
            <div class="h-px bg-gradient-to-r from-transparent via-gray-800 to-transparent flex-1"></div>
        </div>
        <div class="flex flex-wrap justify-center gap-4">
            @foreach($profile->skills as $skill)
                @php
                    $key = strtolower(str_replace([' ', '.', '#'], '', $skill));
                    $iconMap = [
                        'php'        => 'devicon-php-plain colored',
                        'laravel'    => 'devicon-laravel-plain colored',
                        'livewire'   => 'devicon-livewire-original colored',
                        'html'       => 'devicon-html5-plain colored',
                        'css'        => 'devicon-css3-plain colored',
                        'javascript' => 'devicon-javascript-plain colored',
                        'js'         => 'devicon-javascript-plain colored',
                        'typescript' => 'devicon-typescript-plain colored',
                        'ts'         => 'devicon-typescript-plain colored',
                        'vue'        => 'devicon-vuejs-plain colored',
                        'vuejs'      => 'devicon-vuejs-plain colored',
                        'react'      => 'devicon-react-original colored',
                        'reactjs'    => 'devicon-react-original colored',
                        'mysql'      => 'devicon-mysql-plain colored',
                        'mariadb'    => 'devicon-mariadb-plain colored',
                        'postgresql' => 'devicon-postgresql-plain colored',
                        'postgres'   => 'devicon-postgresql-plain colored',
                        'docker'     => 'devicon-docker-plain colored',
                        'git'        => 'devicon-git-plain colored',
                        'github'     => 'devicon-github-original',
                        'tailwind'   => 'devicon-tailwindcss-plain colored',
                        'tailwindcss'=> 'devicon-tailwindcss-plain colored',
                        'bootstrap'  => 'devicon-bootstrap-plain colored',
                        'python'     => 'devicon-python-plain colored',
                        'nodejs'     => 'devicon-nodejs-plain colored',
                        'node'       => 'devicon-nodejs-plain colored',
                        'linux'      => 'devicon-linux-plain',
                        'ubuntu'     => 'devicon-ubuntu-plain colored',
                        'nginx'      => 'devicon-nginx-original colored',
                        'redis'      => 'devicon-redis-plain colored',
                        'filament'   => 'devicon-php-plain colored',
                    ];
                    $iconClass = $iconMap[$key] ?? null;
                @endphp
                <div class="flex flex-col items-center gap-2 bg-gray-900 border border-gray-800 hover:border-indigo-500 rounded-xl px-6 py-4 transition cursor-default w-24">
                    @if($iconClass)
                        <i class="{{ $iconClass }} text-4xl"></i>
                    @else
                        <span class="text-3xl">💻</span>
                    @endif
                    <span class="text-xs text-gray-400 text-center uppercase tracking-wide">{{ $skill }}</span>
                </div>
            @endforeach
        </div>
    </section>
    @endif

</div>
