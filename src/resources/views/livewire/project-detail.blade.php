<div class="min-h-screen bg-gray-950 text-white">
    <div class="container mx-auto px-4 pt-24 pb-16 max-w-5xl">

        {{-- Back Button --}}
        <a href="{{ route('projects') }}"
           class="inline-flex items-center gap-2 text-blue-400 hover:text-blue-300 mb-8 transition">
            ← Back to Projects
        </a>

        {{-- Thumbnail --}}
        @if ($project->thumbnail)
            <img src="{{ Storage::url($project->thumbnail) }}"
                 alt="{{ $project->title }}"
                 class="w-full h-72 object-cover rounded-2xl mb-8 mt-4 shadow-xl">
        @endif

        {{-- Header --}}
        <div class="mb-8">
            <div class="flex flex-wrap items-center gap-3 mb-3">
                @if ($project->is_final_project)
                    <span class="bg-purple-600 text-white px-3 py-1 rounded-full text-xs font-semibold tracking-wide">
                        🎓 Final Project
                    </span>
                @endif
                <span class="px-3 py-1 text-xs rounded-full font-semibold text-white
                    {{ $project->status === 'completed' ? 'bg-green-600' : ($project->status === 'planning' ? 'bg-gray-600' : 'bg-yellow-600') }}">
                    {{ ucfirst(str_replace('_', ' ', $project->status)) }}
                </span>
            </div>

            <h1 class="text-4xl font-bold text-white mb-4">{{ $project->title }}</h1>

            {{-- Progress Bar --}}
            <div class="flex items-center gap-4">
                <div class="flex-1 bg-gray-700 rounded-full h-2">
                    <div class="bg-blue-500 h-2 rounded-full transition-all"
                         style="width: {{ $project->progress }}%"></div>
                </div>
                <span class="text-gray-400 text-sm whitespace-nowrap">{{ $project->progress }}% Complete</span>
            </div>
        </div>

        {{-- SECTION 1: Deskripsi --}}
        @if ($project->description)
            <div class="bg-gray-900 border border-gray-800 rounded-2xl p-6 mb-6">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center text-sm">📋</div>
                    <h2 class="text-lg font-semibold text-white">Deskripsi & Solusi</h2>
                </div>
                <p class="text-gray-300 leading-relaxed">{!! nl2br(e($project->description)) !!}</p>
            </div>
        @endif

        {{-- SECTION 2: Analisis Masalah --}}
        @if ($project->problem_analysis)
            <div class="bg-gray-900 border border-gray-800 rounded-2xl p-6 mb-6">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-8 h-8 bg-red-600 rounded-lg flex items-center justify-center text-sm">🔍</div>
                    <h2 class="text-lg font-semibold text-white">Analisis Masalah & Kebutuhan Sistem</h2>
                </div>
                <p class="text-gray-300 leading-relaxed">{!! nl2br(e($project->problem_analysis)) !!}</p>
            </div>
        @endif

        {{-- SECTION 3: Tech Stack --}}
        @if ($project->tech_stack)
            <div class="bg-gray-900 border border-gray-800 rounded-2xl p-6 mb-6">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-8 h-8 bg-green-600 rounded-lg flex items-center justify-center text-sm">⚙️</div>
                    <h2 class="text-lg font-semibold text-white">Arsitektur & Tech Stack</h2>
                </div>
                @php
                    $iconMap = [
                        'php'        => 'devicon-php-plain colored',
                        'laravel'    => 'devicon-laravel-plain colored',
                        'livewire'   => 'devicon-livewire-original colored',
                        'html'       => 'devicon-html5-plain colored',
                        'css'        => 'devicon-css3-plain colored',
                        'javascript' => 'devicon-javascript-plain colored',
                        'js'         => 'devicon-javascript-plain colored',
                        'typescript' => 'devicon-typescript-plain colored',
                        'vue'        => 'devicon-vuejs-plain colored',
                        'react'      => 'devicon-react-original colored',
                        'mysql'      => 'devicon-mysql-plain colored',
                        'mariadb'    => 'devicon-mariadb-plain colored',
                        'postgresql' => 'devicon-postgresql-plain colored',
                        'docker'     => 'devicon-docker-plain colored',
                        'git'        => 'devicon-git-plain colored',
                        'github'     => 'devicon-github-original',
                        'tailwind'   => 'devicon-tailwindcss-plain colored',
                        'tailwindcss'=> 'devicon-tailwindcss-plain colored',
                        'bootstrap'  => 'devicon-bootstrap-plain colored',
                        'python'     => 'devicon-python-plain colored',
                        'nodejs'     => 'devicon-nodejs-plain colored',
                        'linux'      => 'devicon-linux-plain',
                        'nginx'      => 'devicon-nginx-original colored',
                        'redis'      => 'devicon-redis-plain colored',
                        'filament'   => 'devicon-php-plain colored',
                    ];
                @endphp
                <div class="flex flex-wrap gap-3">
                    @foreach ((array) $project->tech_stack as $tech)
                        @php
                            $key = strtolower(str_replace([' ', '.', '#'], '', $tech));
                            $iconClass = $iconMap[$key] ?? null;
                        @endphp
                        <div class="flex items-center gap-2 bg-gray-800 border border-gray-700 hover:border-blue-500 rounded-xl px-4 py-2 transition">
                            @if($iconClass)
                                <i class="{{ $iconClass }} text-2xl"></i>
                            @else
                                <span class="text-xl">💻</span>
                            @endif
                            <span class="text-sm text-gray-300">{{ $tech }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        {{-- SECTION 4: Diagram ERD / Flowchart --}}
        @if ($project->diagram)
            <div class="bg-gray-900 border border-gray-800 rounded-2xl p-6 mb-6">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-8 h-8 bg-yellow-600 rounded-lg flex items-center justify-center text-sm">🗂️</div>
                    <h2 class="text-lg font-semibold text-white">Rencana Perancangan (ERD / Flowchart)</h2>
                </div>
                <img src="{{ Storage::url($project->diagram) }}"
                     alt="Diagram"
                     class="w-full rounded-xl border border-gray-700 cursor-pointer hover:opacity-90 transition"
                     onclick="document.getElementById('diagram-modal').classList.remove('hidden')">
                <p class="text-gray-500 text-xs mt-2 text-center">Klik gambar untuk memperbesar</p>
            </div>

            {{-- Modal zoom diagram --}}
            <div id="diagram-modal"
                 class="hidden fixed inset-0 bg-black/80 z-50 flex items-center justify-center p-4"
                 onclick="this.classList.add('hidden')">
                <img src="{{ Storage::url($project->diagram) }}"
                     alt="Diagram"
                     class="max-w-full max-h-full rounded-xl shadow-2xl">
            </div>
        @endif

        {{-- Links --}}
        @if ($project->github_url || $project->demo_url)
            <div class="flex flex-wrap gap-4 mt-4">
                @if ($project->github_url)
                    <a href="{{ $project->github_url }}" target="_blank"
                       class="inline-flex items-center gap-2 bg-gray-800 hover:bg-gray-700 border border-gray-700 text-white px-6 py-3 rounded-xl text-sm font-semibold transition">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0 0 24 12c0-6.63-5.37-12-12-12z"/>
                        </svg>
                        GitHub Repository
                    </a>
                @endif

                @if ($project->demo_url)
                    <a href="{{ $project->demo_url }}" target="_blank"
                       class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-500 text-white px-6 py-3 rounded-xl text-sm font-semibold transition">
                        🚀 Live Demo
                    </a>
                @endif
            </div>
        @endif

    </div>
</div>
