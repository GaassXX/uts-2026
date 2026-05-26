<div class="min-h-screen bg-gray-950 text-white">
    <div class="container mx-auto px-4 pt-24 pb-16 max-w-5xl">

        {{-- Back Button --}}
        <a href="{{ route('projects') }}"
           class="inline-flex items-center gap-2 text-blue-400 hover:text-blue-300 mb-8 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Back to Projects
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
                    <span class="inline-flex items-center gap-1 bg-purple-600 text-white px-3 py-1 rounded-full text-xs font-semibold tracking-wide">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                        </svg>
                        Final Project
                    </span>
                @endif
                <span class="inline-flex items-center gap-1 px-3 py-1 text-xs rounded-full font-semibold text-white
                    {{ $project->status === 'completed' ? 'bg-green-600' : ($project->status === 'planning' ? 'bg-gray-600' : 'bg-yellow-600') }}">
                    <span class="w-1.5 h-1.5 rounded-full bg-white/70"></span>
                    {{ ucfirst(str_replace('_', ' ', $project->status)) }}
                </span>
            </div>

            <h1 class="text-4xl font-bold text-white mb-4">{{ $project->title }}</h1>

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
                    <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <h2 class="text-lg font-semibold text-white">Deskripsi Project</h2>
                </div>
                <p class="text-gray-300 leading-relaxed">{!! nl2br(e($project->description)) !!}</p>
            </div>
        @endif

        {{-- SECTION 2: Solusi --}}
        @if ($project->solution)
            <div class="bg-gray-900 border border-gray-800 rounded-2xl p-6 mb-6">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-8 h-8 bg-indigo-600 rounded-lg flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                        </svg>
                    </div>
                    <h2 class="text-lg font-semibold text-white">Solusi yang Ditawarkan</h2>
                </div>
                <p class="text-gray-300 leading-relaxed">{!! nl2br(e($project->solution)) !!}</p>
            </div>
        @endif

        {{-- SECTION 3: Analisis Masalah --}}
        @if ($project->problem_analysis)
            <div class="bg-gray-900 border border-gray-800 rounded-2xl p-6 mb-6">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-8 h-8 bg-red-600 rounded-lg flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <h2 class="text-lg font-semibold text-white">Analisis Masalah & Kebutuhan Sistem</h2>
                </div>
                <p class="text-gray-300 leading-relaxed">{!! nl2br(e($project->problem_analysis)) !!}</p>
            </div>
        @endif

        {{-- SECTION 4: Fitur Utama --}}
        @if ($project->features && count($project->features) > 0)
            <div class="bg-gray-900 border border-gray-800 rounded-2xl p-6 mb-6">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-8 h-8 bg-cyan-600 rounded-lg flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <h2 class="text-lg font-semibold text-white">Fitur Utama</h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    @foreach ($project->features as $feature)
                        <div class="flex items-center gap-3 bg-gray-800 rounded-xl px-4 py-3">
                            <span class="w-2 h-2 bg-indigo-400 rounded-full flex-shrink-0"></span>
                            <span class="text-gray-300 text-sm">{{ $feature }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        {{-- SECTION 5: Tech Stack --}}
        @if ($project->tech_stack)
            <div class="bg-gray-900 border border-gray-800 rounded-2xl p-6 mb-6">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-8 h-8 bg-green-600 rounded-lg flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
                        </svg>
                    </div>
                    <h2 class="text-lg font-semibold text-white">Arsitektur & Tech Stack</h2>
                </div>
                @php
                    $iconMap = [
                        'php'         => 'devicon-php-plain colored',
                        'laravel'     => 'devicon-laravel-plain colored',
                        'livewire'    => 'devicon-livewire-original colored',
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
                        'linux'       => 'devicon-linux-plain',
                        'nginx'       => 'devicon-nginx-original colored',
                        'redis'       => 'devicon-redis-plain colored',
                        'filament'    => 'devicon-php-plain colored',
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
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3H5a2 2 0 00-2 2v4m6-6h10a2 2 0 012 2v4M9 3v18m0 0h10a2 2 0 002-2v-4M9 21H5a2 2 0 01-2-2v-4m0 0h18"/>
                                </svg>
                            @endif
                            <span class="text-sm text-gray-300">{{ $tech }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        {{-- SECTION 6: Flowchart --}}
        @if ($project->flowchart)
            <div class="bg-gray-900 border border-gray-800 rounded-2xl p-6 mb-6">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-8 h-8 bg-yellow-600 rounded-lg flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"/>
                        </svg>
                    </div>
                    <h2 class="text-lg font-semibold text-white">Flowchart Sistem</h2>
                </div>
                <img src="{{ Storage::url($project->flowchart) }}"
                     alt="Flowchart"
                     class="w-full rounded-xl border border-gray-700 cursor-pointer hover:opacity-90 transition"
                     onclick="openModal('{{ Storage::url($project->flowchart) }}')">
                <p class="text-gray-500 text-xs mt-2 text-center">Klik gambar untuk memperbesar</p>
            </div>
        @endif

        {{-- SECTION 7: ERD --}}
        @if ($project->erd_diagram)
            <div class="bg-gray-900 border border-gray-800 rounded-2xl p-6 mb-6">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-8 h-8 bg-orange-600 rounded-lg flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4"/>
                        </svg>
                    </div>
                    <h2 class="text-lg font-semibold text-white">ERD Diagram</h2>
                </div>
                <img src="{{ Storage::url($project->erd_diagram) }}"
                     alt="ERD Diagram"
                     class="w-full rounded-xl border border-gray-700 cursor-pointer hover:opacity-90 transition"
                     onclick="openModal('{{ Storage::url($project->erd_diagram) }}')">
                <p class="text-gray-500 text-xs mt-2 text-center">Klik gambar untuk memperbesar</p>
            </div>
        @endif

        {{-- SECTION 8: Use Case --}}
        @if ($project->use_case)
            <div class="bg-gray-900 border border-gray-800 rounded-2xl p-6 mb-6">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-8 h-8 bg-pink-600 rounded-lg flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <h2 class="text-lg font-semibold text-white">Use Case Diagram</h2>
                </div>
                <img src="{{ Storage::url($project->use_case) }}"
                     alt="Use Case"
                     class="w-full rounded-xl border border-gray-700 cursor-pointer hover:opacity-90 transition"
                     onclick="openModal('{{ Storage::url($project->use_case) }}')">
                <p class="text-gray-500 text-xs mt-2 text-center">Klik gambar untuk memperbesar</p>
            </div>
        @endif

        {{-- SECTION 9: Diagram Lainnya --}}
        @if ($project->diagram)
            <div class="bg-gray-900 border border-gray-800 rounded-2xl p-6 mb-6">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-8 h-8 bg-teal-600 rounded-lg flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h2 class="text-lg font-semibold text-white">Diagram Lainnya</h2>
                </div>
                <img src="{{ Storage::url($project->diagram) }}"
                     alt="Diagram"
                     class="w-full rounded-xl border border-gray-700 cursor-pointer hover:opacity-90 transition"
                     onclick="openModal('{{ Storage::url($project->diagram) }}')">
                <p class="text-gray-500 text-xs mt-2 text-center">Klik gambar untuk memperbesar</p>
            </div>
        @endif

        {{-- SECTION 10: Dokumen PDF --}}
        @if ($project->document)
            <div class="bg-gray-900 border border-gray-800 rounded-2xl p-6 mb-6">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-8 h-8 bg-red-700 rounded-lg flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h2 class="text-lg font-semibold text-white">Dokumentasi Project</h2>
                </div>
                <a href="{{ Storage::url($project->document) }}" target="_blank"
                   class="inline-flex items-center gap-3 bg-gray-800 hover:bg-gray-700 border border-gray-700 hover:border-red-500 px-5 py-3 rounded-xl transition">
                    <div class="w-10 h-10 bg-red-600/20 border border-red-500/30 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-white">Lihat Laporan PDF</p>
                        <p class="text-xs text-gray-400">Klik untuk membuka dokumen</p>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400 ml-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                    </svg>
                </a>
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
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                        </svg>
                        Live Demo
                    </a>
                @endif
            </div>
        @endif

        {{-- MODAL ZOOM --}}
        <div id="image-modal"
             class="hidden fixed inset-0 bg-black/90 z-50 flex items-center justify-center p-4"
             onclick="closeModal()">
            <img id="modal-img" src="" alt="Preview"
                 class="max-w-full max-h-full rounded-xl shadow-2xl">
        </div>

    </div>

    <script>
        function openModal(src) {
            document.getElementById('modal-img').src = src;
            document.getElementById('image-modal').classList.remove('hidden');
        }
        function closeModal() {
            document.getElementById('image-modal').classList.add('hidden');
        }
    </script>

</div>
