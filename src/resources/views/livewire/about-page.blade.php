<div class="min-h-screen bg-[#0a0a0f] text-white">
    <div class="max-w-6xl mx-auto px-6 pt-32 pb-16">

        {{-- HEADER --}}
        <div class="text-center mb-16">
            <div class="inline-flex items-center gap-2 bg-indigo-600/10 border border-indigo-500/20 text-indigo-300 text-sm px-4 py-1.5 rounded-full mb-4">
                <span class="w-2 h-2 bg-indigo-400 rounded-full animate-pulse"></span>
                Tentang Saya
            </div>
            <h1 class="text-5xl font-bold mb-3">Tentang <span class="text-indigo-400">Saya</span></h1>
            <p class="text-gray-400 text-lg max-w-xl mx-auto">{{ $profile?->tagline ?? 'Web Developer' }}</p>
        </div>

        {{-- HERO CARD: Photo + Stats + Social + About Text --}}
        <div class="bg-gray-900/50 border border-gray-800 rounded-3xl p-8 mb-12">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10 items-start">

                {{-- LEFT: Photo + Stats + Social --}}
                <div class="text-center lg:text-left">
                    <div class="relative inline-block mb-6">
                        <div class="absolute inset-0 bg-indigo-600/20 rounded-2xl blur-xl"></div>
                        <div class="relative w-48 h-48 mx-auto lg:mx-0 rounded-2xl overflow-hidden border border-gray-700 shadow-xl">
                            @if($profile?->photo)
                                <img src="{{ Storage::url($profile->photo) }}" class="w-full h-full object-cover" alt="{{ $profile->name }}">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-indigo-600 via-purple-600 to-indigo-800 flex items-center justify-center text-6xl font-bold">
                                    {{ strtoupper(substr($profile?->name ?? '?', 0, 1)) }}
                                </div>
                            @endif
                        </div>
                    </div>

                    <h2 class="text-xl font-bold text-white mb-1">{{ $profile?->name }}</h2>
                    <p class="text-sm text-indigo-400 mb-4">{{ $profile?->tagline }}</p>

                    {{-- Stats --}}
                    <div class="flex justify-center lg:justify-start gap-6 mb-5">
                        <div class="text-center">
                            <p class="text-2xl font-bold text-indigo-400">{{ $profile?->years_experience ?? '1' }}+</p>
                            <p class="text-xs text-gray-500">Years</p>
                        </div>
                        <div class="text-center">
                            <p class="text-2xl font-bold text-purple-400">{{ $profile?->total_projects ?? '0' }}+</p>
                            <p class="text-xs text-gray-500">Projects</p>
                        </div>
                        <div class="text-center">
                            <p class="text-2xl font-bold text-green-400">
                                <span class="text-sm">{{ $profile?->availability == 'Available for work' ? '✓' : '○' }}</span>
                            </p>
                            <p class="text-xs text-gray-500">Status</p>
                        </div>
                    </div>

                    {{-- Social Links --}}
                    <div class="flex justify-center lg:justify-start gap-2">
                        @if($profile?->github)
                        <a href="{{ $profile->github }}" target="_blank" class="w-9 h-9 flex items-center justify-center bg-gray-800 border border-gray-700 hover:border-indigo-500 hover:text-indigo-400 rounded-lg text-gray-400 transition">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0 0 24 12c0-6.63-5.37-12-12-12z"/></svg>
                        </a>
                        @endif
                        @if($profile?->linkedin)
                        <a href="{{ $profile->linkedin }}" target="_blank" class="w-9 h-9 flex items-center justify-center bg-gray-800 border border-gray-700 hover:border-blue-500 hover:text-blue-400 rounded-lg text-gray-400 transition">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 0 1-2.063-2.065 2.064 2.064 0 1 1 2.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                        </a>
                        @endif
                        @if($profile?->instagram)
                        <a href="https://instagram.com/{{ str_replace('@', '', $profile->instagram) }}" target="_blank" class="w-9 h-9 flex items-center justify-center bg-gray-800 border border-gray-700 hover:border-pink-500 hover:text-pink-400 rounded-lg text-gray-400 transition">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                        </a>
                        @endif
                        @if($profile?->whatsapp)
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $profile->whatsapp) }}" target="_blank" class="w-9 h-9 flex items-center justify-center bg-gray-800 border border-gray-700 hover:border-green-500 hover:text-green-400 rounded-lg text-gray-400 transition">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                        </a>
                        @endif
                    </div>
                </div>

                {{-- RIGHT: About Text --}}
                <div class="lg:col-span-2">
                    <div class="inline-flex items-center gap-2 text-indigo-400 text-xs font-semibold uppercase tracking-widest mb-4">
                        <span class="w-8 h-px bg-indigo-500"></span>
                        Bersemangat Membangun Solusi Digital
                    </div>
                    <h2 class="text-3xl font-bold mb-6">
                        Hallo, Saya <span class="text-indigo-400">{{ collect(explode(' ', $profile?->name ?? 'User'))->first() }}</span>
                    </h2>
                    <div class="text-gray-400 leading-relaxed mb-8 text-base space-y-4">
                        {!! nl2br(e($profile?->about_detail ?? $profile?->bio ?? 'Belum ada deskripsi.')) !!}
                    </div>
                    @if($profile?->cv_url)
                    <a href="{{ $profile->cv_url }}" target="_blank"
                       class="inline-flex items-center gap-2 px-6 py-3 bg-indigo-600 hover:bg-indigo-500 text-white rounded-xl text-sm font-semibold transition shadow-lg shadow-indigo-600/20">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                        </svg>
                        Download CV
                    </a>
                    @endif
                </div>

            </div>
        </div>

        {{-- SKILLS + PERCENTAGES --}}
        <div class="bg-gray-900/50 border border-gray-800 rounded-3xl p-8 mb-12">
            <div class="text-center mb-10">
                <span class="text-indigo-400 text-xs font-semibold uppercase tracking-widest">Keahlian</span>
                <h2 class="text-3xl font-bold mt-2">Keahlian <span class="text-indigo-400">Saya</span></h2>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">

                {{-- LEFT: Skill Icons Grid --}}
                <div>
                    <h3 class="text-lg font-semibold mb-5 text-gray-300">Teknologi yang Saya Kuasai</h3>
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
                                'postgresql'  => 'devicon-postgresql-plain colored',
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
                        <div class="grid grid-cols-3 sm:grid-cols-4 gap-3">
                            @foreach($profile->skills as $skill)
                                @php
                                    $key = strtolower(str_replace([' ', '.', '#'], '', $skill));
                                    $iconClass = $iconMap[$key] ?? null;
                                @endphp
                                <div class="flex flex-col items-center gap-2 bg-gray-800/50 border border-gray-700/50 hover:border-indigo-500/50 hover:bg-indigo-500/5 rounded-2xl p-4 transition-all duration-200 cursor-default group">
                                    @if($iconClass)
                                        <i class="{{ $iconClass }} text-3xl group-hover:scale-110 transition-transform duration-200"></i>
                                    @else
                                        <div class="w-8 h-8 bg-indigo-600/20 rounded-lg flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
                                            </svg>
                                        </div>
                                    @endif
                                    <span class="text-xs text-gray-400 text-center uppercase tracking-wide font-medium">{{ $skill }}</span>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 text-sm">Belum ada skill. Isi di admin → Profile → Skills.</p>
                    @endif
                </div>

                {{-- RIGHT: Skill Percentages --}}
                <div>
                    <h3 class="text-lg font-semibold mb-5 text-gray-300">Tingkat Keahlian</h3>
                    @if($profile?->skill_percentages && count($profile->skill_percentages) > 0)
                        <div class="space-y-5">
                            @foreach($profile->skill_percentages as $item)
                                @php
                                    $name = $item['name'] ?? 'Skill';
                                    $percentage = (int) ($item['percentage'] ?? 0);
                                @endphp
                                <div>
                                    <div class="flex justify-between text-sm mb-1.5">
                                        <span class="text-gray-300 font-medium">{{ $name }}</span>
                                        <span class="text-indigo-400 font-semibold">{{ $percentage }}%</span>
                                    </div>
                                    <div class="w-full bg-gray-800 rounded-full h-2.5 overflow-hidden">
                                        <div class="h-full rounded-full bg-gradient-to-r from-indigo-500 to-purple-500 transition-all duration-1000"
                                             style="width: {{ $percentage }}%"></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="flex flex-col items-center justify-center h-full py-12 text-gray-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-gray-700 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                            <p class="text-sm">Belum ada data persentase skill.</p>
                            <p class="text-xs text-gray-600 mt-1">Isi di admin → Profile → Skill Percentages.</p>
                        </div>
                    @endif
                </div>

            </div>
        </div>

        {{-- EXPERIENCE TIMELINE --}}
        @if($experiences->count() > 0)
        <div class="bg-gray-900/50 border border-gray-800 rounded-3xl p-8 mb-12">
            <div class="text-center mb-10">
                <span class="text-indigo-400 text-xs font-semibold uppercase tracking-widest">Pengalaman</span>
                <h2 class="text-3xl font-bold mt-2">Perjalanan <span class="text-indigo-400">Saya</span></h2>
            </div>
            <div class="relative max-w-3xl mx-auto">
                <div class="absolute left-6 top-0 bottom-0 w-px bg-gradient-to-b from-indigo-500 via-purple-500/50 to-transparent"></div>
                <div class="space-y-6">
                    @foreach($experiences as $i => $experience)
                        <div class="relative flex gap-6 items-start pl-16">
                            <div class="absolute left-0 w-12 h-12 bg-indigo-600 border-4 border-gray-900 rounded-full flex items-center justify-center flex-shrink-0 top-0">
                                <div class="w-3 h-3 bg-white rounded-full"></div>
                            </div>
                            <div class="flex-1 bg-gray-800/50 border border-gray-700/50 hover:border-indigo-500/50 rounded-2xl p-6 transition">
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
        @endif

        {{-- CONTACT INFO --}}
        <div class="bg-gray-900/50 border border-gray-800 rounded-3xl p-8">
            <div class="text-center mb-8">
                <span class="text-indigo-400 text-xs font-semibold uppercase tracking-widest">Kontak</span>
                <h2 class="text-3xl font-bold mt-2">Hubungi <span class="text-indigo-400">Saya</span></h2>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 max-w-4xl mx-auto">
                @if($profile?->email)
                <div class="flex items-center gap-4 bg-gray-800/50 border border-gray-700/50 hover:border-indigo-500/50 rounded-2xl p-4 transition">
                    <div class="w-10 h-10 bg-indigo-600/20 rounded-xl flex items-center justify-center flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div class="min-w-0">
                        <p class="text-xs text-gray-500 uppercase tracking-wider">Email</p>
                        <p class="text-white text-sm font-medium truncate">{{ $profile->email }}</p>
                    </div>
                </div>
                @endif
                @if($profile?->location)
                <div class="flex items-center gap-4 bg-gray-800/50 border border-gray-700/50 hover:border-indigo-500/50 rounded-2xl p-4 transition">
                    <div class="w-10 h-10 bg-purple-600/20 rounded-xl flex items-center justify-center flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <div class="min-w-0">
                        <p class="text-xs text-gray-500 uppercase tracking-wider">Lokasi</p>
                        <p class="text-white text-sm font-medium truncate">{{ $profile->location }}</p>
                    </div>
                </div>
                @endif
                @if($profile?->whatsapp)
                <div class="flex items-center gap-4 bg-gray-800/50 border border-gray-700/50 hover:border-green-500/50 rounded-2xl p-4 transition">
                    <div class="w-10 h-10 bg-green-600/20 rounded-xl flex items-center justify-center flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                    </div>
                    <div class="min-w-0">
                        <p class="text-xs text-gray-500 uppercase tracking-wider">WhatsApp</p>
                        <p class="text-white text-sm font-medium truncate">{{ $profile->whatsapp }}</p>
                    </div>
                </div>
                @endif
                <div class="flex items-center gap-4 bg-gray-800/50 border border-gray-700/50 hover:border-green-500/50 rounded-2xl p-4 transition">
                    <div class="w-10 h-10 bg-green-600/20 rounded-xl flex items-center justify-center flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div class="min-w-0">
                        <p class="text-xs text-gray-500 uppercase tracking-wider">Status</p>
                        <p class="text-white text-sm font-medium truncate">{{ $profile?->availability ?? 'Available' }}</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
