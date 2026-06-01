<div class="bg-[#0a0a0f] text-white">

    {{-- ===== HERO ===== --}}
    <section class="min-h-screen flex items-center px-6 max-w-7xl mx-auto relative">

        {{-- Decorative dots --}}
        <div class="absolute left-0 top-1/3 opacity-20 pointer-events-none">
            @for($i = 0; $i < 4; $i++)
                <div class="flex gap-2 mb-2">
                    @for($j = 0; $j < 3; $j++)
                        <div class="w-1 h-1 bg-indigo-400 rounded-full"></div>
                    @endfor
                </div>
            @endfor
        </div>
        <div class="absolute right-0 bottom-1/3 opacity-20 pointer-events-none">
            @for($i = 0; $i < 4; $i++)
                <div class="flex gap-2 mb-2">
                    @for($j = 0; $j < 3; $j++)
                        <div class="w-1 h-1 bg-purple-400 rounded-full"></div>
                    @endfor
                </div>
            @endfor
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center w-full py-24">

            {{-- LEFT --}}
            <div class="space-y-8">
                <div class="inline-flex items-center gap-2 bg-yellow-500/10 border border-yellow-500/20 text-yellow-300 text-sm px-4 py-2 rounded-full">
                    <span>👋</span> Hello, I'm
                </div>

                <div>
                    <h1 class="text-5xl lg:text-6xl font-bold leading-tight">
                        {{ collect(explode(' ', $profile?->name ?? 'Your Name'))->first() }}
                        <span class="text-indigo-400">
                            {{ collect(explode(' ', $profile?->name ?? 'Your Name'))->skip(1)->implode(' ') }}
                        </span>
                    </h1>
                    <p class="text-xl text-gray-400 mt-3 font-light">{{ $profile?->tagline ?? 'Full Stack Developer' }}</p>
                </div>

                <p class="text-gray-400 leading-relaxed max-w-lg border-l-2 border-indigo-500/50 pl-4">
                    {{ $profile?->bio ?? 'Bio singkat lo di sini.' }}
                </p>

                <div class="flex gap-3 flex-wrap" x-data="{ hovered: null }">
                    <a href="#projects"
                       @mouseenter="hovered = 'projects'"
                       @mouseleave="hovered = null"
                       :class="hovered === 'projects' ? 'scale-105 shadow-lg shadow-indigo-500/30' : ''"
                       class="inline-flex items-center gap-2 px-6 py-3 bg-indigo-600 hover:bg-indigo-500 rounded-xl font-semibold text-sm transition-all duration-200">
                        Lihat Project Saya →
                    </a>
                    <a href="#contact"
                       @mouseenter="hovered = 'contact'"
                       @mouseleave="hovered = null"
                       :class="hovered === 'contact' ? 'scale-105 border-indigo-500' : ''"
                       class="inline-flex items-center gap-2 px-6 py-3 border border-gray-600 hover:border-indigo-500 rounded-xl font-semibold text-sm transition-all duration-200">
                        Hubungi Saya
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </a>
                </div>

                <div class="flex items-center gap-3">
                    <span class="text-gray-600 text-xs uppercase tracking-widest">Find me on</span>
                    <div class="h-px bg-white/10 w-8"></div>
                    @if($profile?->github)
                    <a href="{{ $profile->github }}" target="_blank"
                       x-data="{ h: false }" @mouseenter="h=true" @mouseleave="h=false"
                       :class="h ? 'border-indigo-500 text-indigo-400 bg-indigo-500/10' : 'border-white/10 text-gray-400'"
                       class="w-10 h-10 flex items-center justify-center border rounded-xl transition-all duration-200">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0 0 24 12c0-6.63-5.37-12-12-12z"/>
                        </svg>
                    </a>
                    @endif
                    @if($profile?->linkedin)
                    <a href="{{ $profile->linkedin }}" target="_blank"
                       x-data="{ h: false }" @mouseenter="h=true" @mouseleave="h=false"
                       :class="h ? 'border-blue-500 text-blue-400 bg-blue-500/10' : 'border-white/10 text-gray-400'"
                       class="w-10 h-10 flex items-center justify-center border rounded-xl transition-all duration-200">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 0 1-2.063-2.065 2.064 2.064 0 1 1 2.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                        </svg>
                    </a>
                    @endif
                    <a href="#contact"
                       x-data="{ h: false }" @mouseenter="h=true" @mouseleave="h=false"
                       :class="h ? 'border-indigo-500 text-indigo-400 bg-indigo-500/10' : 'border-white/10 text-gray-400'"
                       class="w-10 h-10 flex items-center justify-center border rounded-xl transition-all duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </a>
                </div>
            </div>

            {{-- RIGHT --}}
            <div class="flex justify-center lg:justify-end">
                <div class="relative">
                    <div class="absolute inset-0 bg-indigo-600/20 rounded-3xl blur-3xl scale-110"></div>
                    <div class="relative w-72 bg-gray-900 border border-white/10 rounded-3xl overflow-hidden shadow-2xl">
                        <div class="absolute top-4 right-4 flex items-center gap-2 bg-gray-800/90 backdrop-blur px-3 py-1 rounded-full text-xs z-10">
                            <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span>
                            {{ $profile?->availability ?? 'Available for work' }}
                        </div>
                        @if($profile?->photo)
                            <img src="{{ Storage::url($profile->photo) }}" class="w-full h-80 object-cover object-top" alt="{{ $profile->name }}">
                        @else
                            <div class="w-full h-80 bg-gradient-to-br from-indigo-600 via-purple-600 to-indigo-800 flex items-center justify-center text-8xl font-bold">
                                {{ strtoupper(substr($profile?->name ?? 'P', 0, 1)) }}
                            </div>
                        @endif
                        <div class="p-4 grid grid-cols-3 divide-x divide-white/5">
                            <div class="text-center px-2">
                                <p class="text-lg font-bold text-indigo-400">{{ $profile?->years_experience ?? '1' }}+</p>
                                <p class="text-xs text-gray-500 mt-0.5">Years</p>
                            </div>
                            <div class="text-center px-2">
                                <p class="text-lg font-bold text-purple-400">{{ $profile?->total_projects ?? '0' }}+</p>
                                <p class="text-xs text-gray-500 mt-0.5">Projects</p>
                            </div>
                            <div class="text-center px-2">
                                <p class="text-lg font-bold text-green-400">100%</p>
                                <p class="text-xs text-gray-500 mt-0.5">Committed</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ===== ABOUT ===== --}}
    <section id="about" class="py-32 px-6 bg-gray-900/20 border-t border-white/5">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-start">

                {{-- LEFT --}}
                <div class="reveal-left">
                    <p class="text-indigo-400 text-xs font-semibold uppercase tracking-widest mb-3">Tentang Saya</p>
                    <h2 class="text-4xl font-bold mb-6 leading-tight">
                        Bersemangat Membangun<br>
                        <span class="text-indigo-400">Solusi Digital</span>
                    </h2>
                    <p class="text-gray-400 leading-relaxed mb-8 text-base">
                        {{ $profile?->about_detail ?? $profile?->bio ?? 'Deskripsi tentang diri lo.' }}
                    </p>
                    @if($profile?->cv_url)
                    <a href="{{ $profile->cv_url }}" target="_blank"
                       class="inline-flex items-center gap-2 px-6 py-3 border border-indigo-500 text-indigo-400 hover:bg-indigo-600 hover:text-white rounded-xl text-sm font-semibold transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                        </svg>
                        Download CV
                    </a>
                    @endif
                </div>

                {{-- RIGHT: Skills --}}
                <div class="reveal-right">
                    <h3 class="text-xl font-bold mb-6">Keahlian Saya</h3>
                    @if($profile?->skills && count($profile->skills) > 0)
                        @php
                            $iconMap = [
                                'php'         => 'devicon-php-plain colored',
                                'laravel'     => 'devicon-laravel-plain colored',
                                'livewire'    => 'devicon-livewire-original colored',
                                'filament'    => 'devicon-php-plain colored',
                                'html'        => 'devicon-html5-plain colored',
                                'css'         => 'devicon-css3-plain colored',
                                'javascript'  => 'devicon-javascript-plain colored',
                                'js'          => 'devicon-javascript-plain colored',
                                'typescript'  => 'devicon-typescript-plain colored',
                                'vue'         => 'devicon-vuejs-plain colored',
                                'react'       => 'devicon-react-original colored',
                                'mysql'       => 'devicon-mysql-plain colored',
                                'mariadb'     => 'devicon-mariadb-plain colored',
                                'docker'      => 'devicon-docker-plain colored',
                                'git'         => 'devicon-git-plain colored',
                                'github'      => 'devicon-github-original',
                                'tailwind'    => 'devicon-tailwindcss-plain colored',
                                'tailwindcss' => 'devicon-tailwindcss-plain colored',
                                'bootstrap'   => 'devicon-bootstrap-plain colored',
                                'python'      => 'devicon-python-plain colored',
                                'nodejs'      => 'devicon-nodejs-plain colored',
                                'node'        => 'devicon-nodejs-plain colored',
                                'nginx'       => 'devicon-nginx-original colored',
                                'alpine'      => 'devicon-alpinejs-plain colored',
                                'alpinejs'    => 'devicon-alpinejs-plain colored',
                                'redis'       => 'devicon-redis-plain colored',
                                'linux'       => 'devicon-linux-plain',
                            ];
                        @endphp
                        <div class="grid grid-cols-4 gap-3">
                            @foreach($profile->skills as $skill)
                                @php
                                    $key = strtolower(str_replace([' ', '.', '#'], '', $skill));
                                    $iconClass = $iconMap[$key] ?? null;
                                @endphp
                                <div class="reveal flex flex-col items-center gap-2 bg-gray-800/50 border border-gray-700/50 hover:border-indigo-500/50 hover:bg-indigo-500/5 rounded-2xl p-3 transition-all duration-200 cursor-default group">
                                    @if($iconClass)
                                        <i class="{{ $iconClass }} text-3xl group-hover:scale-110 transition-transform duration-200"></i>
                                    @else
                                        <div class="w-8 h-8 bg-indigo-600/20 rounded-lg flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
                                            </svg>
                                        </div>
                                    @endif
                                    <span class="text-xs text-gray-400 text-center uppercase tracking-wide font-medium leading-tight">{{ $skill }}</span>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 text-sm">Belum ada skill. Isi di admin → Profile → Skills.</p>
                    @endif
                </div>
            </div>
        </div>
    </section>

    {{-- ===== PROJECTS ===== --}}
    <section id="projects" class="py-32 px-6 border-t border-white/5">
        <div class="max-w-7xl mx-auto">
            <div class="reveal flex items-end justify-between mb-12">
                <div>
                    <p class="text-indigo-400 text-xs font-semibold uppercase tracking-widest mb-2">Projects</p>
                    <h2 class="text-4xl font-bold">Project Terbaru</h2>
                </div>
                <a href="{{ route('projects') }}"
                   class="inline-flex items-center gap-2 text-sm text-indigo-400 hover:text-white border border-indigo-500/50 hover:bg-indigo-600 px-4 py-2 rounded-xl transition">
                    Lihat Semua →
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($projects as $i => $project)
                    <div class="reveal group bg-gray-900 border border-gray-800 hover:border-indigo-500/50 rounded-2xl overflow-hidden transition-all duration-300 hover:shadow-xl hover:shadow-indigo-500/10"
                         style="transition-delay: {{ $i * 100 }}ms">
                        <div class="h-44 bg-gradient-to-br from-indigo-900/30 to-purple-900/30 overflow-hidden relative">
                            @if($project->thumbnail)
                                <img src="{{ Storage::url($project->thumbnail) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="{{ $project->title }}">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-indigo-800/50" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                            @endif
                            <div class="absolute top-3 left-3">
                                <span class="inline-flex items-center gap-1 text-xs font-semibold px-2.5 py-1 rounded-full backdrop-blur-sm
                                    {{ $project->status === 'completed' ? 'bg-green-500/90 text-white' : ($project->status === 'planning' ? 'bg-yellow-500/90 text-white' : 'bg-blue-500/90 text-white') }}">
                                    <span class="w-1.5 h-1.5 rounded-full bg-white {{ $project->status === 'in_progress' ? 'animate-pulse' : '' }}"></span>
                                    {{ ucfirst(str_replace('_', ' ', $project->status)) }}
                                </span>
                            </div>
                        </div>
                        <div class="p-5">
                            <h3 class="font-bold text-white mb-1 group-hover:text-indigo-300 transition line-clamp-1">{{ $project->title }}</h3>
                            <p class="text-gray-400 text-sm mb-3 line-clamp-2">{{ \Illuminate\Support\Str::limit($project->description, 80) }}</p>
                            <div class="flex flex-wrap gap-1.5 mb-4">
                                @foreach(array_slice((array)$project->tech_stack, 0, 3) as $tech)
                                    <span class="text-xs bg-gray-800 border border-gray-700 text-gray-300 px-2 py-0.5 rounded-full">{{ $tech }}</span>
                                @endforeach
                            </div>
                            <div class="flex gap-2">
                                <a href="{{ route('projects.detail', $project) }}"
                                   class="flex-1 text-center text-xs font-semibold text-white bg-indigo-600 hover:bg-indigo-500 px-3 py-2 rounded-lg transition">
                                    View Detail
                                </a>
                                @if($project->github_url)
                                <a href="{{ $project->github_url }}" target="_blank"
                                   class="inline-flex items-center gap-1 text-xs font-semibold text-gray-300 hover:text-white bg-gray-800 hover:bg-gray-700 border border-gray-700 px-3 py-2 rounded-lg transition">
                                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0 0 24 12c0-6.63-5.37-12-12-12z"/>
                                    </svg>
                                    GitHub
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12 text-gray-500">
                        Belum ada project.
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- ===== EXPERIENCE ===== --}}
    @if($experiences->count() > 0)
    <section id="experience" class="py-32 px-6 bg-gray-900/20 border-t border-white/5">
        <div class="max-w-7xl mx-auto">
            <div class="reveal">
                <p class="text-indigo-400 text-xs font-semibold uppercase tracking-widest mb-2">Pengalaman</p>
                <h2 class="text-4xl font-bold mb-12">Perjalanan Saya</h2>
            </div>
            <div class="relative">
                <div class="absolute left-4 top-0 bottom-0 w-px bg-gradient-to-b from-indigo-500 via-purple-500/50 to-transparent"></div>
                <div class="space-y-6">
                    @foreach($experiences as $i => $experience)
                        <div class="reveal relative flex gap-8 items-start pl-14" style="transition-delay: {{ $i * 100 }}ms">
                            <div class="absolute left-0 w-8 h-8 bg-indigo-600 border-4 border-[#0a0a0f] rounded-full flex items-center justify-center flex-shrink-0 top-4">
                                <div class="w-2 h-2 bg-white rounded-full"></div>
                            </div>
                            <div class="flex-1 bg-gray-900 border border-gray-800 hover:border-indigo-500/50 rounded-2xl p-6 transition">
                                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 mb-2">
                                    <h3 class="font-bold text-white text-lg">{{ $experience->title }}</h3>
                                    <span class="text-xs text-indigo-400 bg-indigo-600/10 border border-indigo-500/30 px-3 py-1 rounded-full whitespace-nowrap">
                                        {{ $experience->period }}
                                    </span>
                                </div>
                                @if($experience->company)
                                    <p class="text-indigo-300 text-sm font-medium mb-2">{{ $experience->company }}</p>
                                @endif
                                @if($experience->description)
                                    <p class="text-gray-400 text-sm leading-relaxed">{{ $experience->description }}</p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    @endif

    {{-- ===== CONTACT CTA ===== --}}
    <section id="contact" class="py-32 px-6 border-t border-white/5">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="reveal-left">
                    <p class="text-indigo-400 text-xs font-semibold uppercase tracking-widest mb-3">Contact</p>
                    <h2 class="text-4xl font-bold mb-4">
                        Tertarik Bekerja<br>
                        <span class="text-indigo-400">Sama?</span>
                    </h2>
                    <p class="text-gray-400 leading-relaxed mb-8">
                        Saya selalu terbuka untuk peluang baru dan kolaborasi menarik.<br>
                        Jangan ragu untuk menghubungi saya!
                    </p>
                    <a href="{{ route('contact') }}"
                       class="inline-flex items-center gap-2 px-6 py-3 bg-indigo-600 hover:bg-indigo-500 rounded-xl font-semibold text-sm transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        Hubungi Saya Sekarang
                    </a>
                </div>

                <div class="reveal-right space-y-4">
                    @if($profile?->email)
                    <div class="flex items-center gap-4 bg-gray-900 border border-gray-800 hover:border-indigo-500/50 rounded-2xl p-4 transition">
                        <div class="w-10 h-10 bg-indigo-600/20 rounded-xl flex items-center justify-center flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase tracking-wider">Email</p>
                            <p class="text-white text-sm font-medium">{{ $profile->email }}</p>
                        </div>
                    </div>
                    @endif

                    @if($profile?->location)
                    <div class="flex items-center gap-4 bg-gray-900 border border-gray-800 hover:border-indigo-500/50 rounded-2xl p-4 transition">
                        <div class="w-10 h-10 bg-purple-600/20 rounded-xl flex items-center justify-center flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase tracking-wider">Lokasi</p>
                            <p class="text-white text-sm font-medium">{{ $profile->location }}</p>
                        </div>
                    </div>
                    @endif

                    <div class="flex items-center gap-4 bg-gray-900 border border-gray-800 hover:border-indigo-500/50 rounded-2xl p-4 transition">
                        <div class="w-10 h-10 bg-green-600/20 rounded-xl flex items-center justify-center flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase tracking-wider">Freelance</p>
                            <p class="text-white text-sm font-medium">{{ $profile?->availability ?? 'Available for work' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
