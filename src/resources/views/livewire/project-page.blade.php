<div class="min-h-screen bg-gray-950 text-white">
    <div class="max-w-7xl mx-auto px-6 pt-24 pb-16">

        {{-- HEADER CENTER --}}
        <div class="text-center mb-12">
            <h1 class="text-5xl font-bold mb-4">
                My <span class="text-indigo-400">Projects</span>
            </h1>
            <p class="text-gray-400 text-lg max-w-xl mx-auto">
                Kumpulan project yang sedang saya kerjakan menggunakan Laravel, Livewire, Filament, dan teknologi modern lainnya.
            </p>
        </div>

        {{-- FILTER & SEARCH --}}
        <div class="flex flex-col sm:flex-row gap-3 mb-10 max-w-2xl mx-auto">

            {{-- Dropdown Filter --}}
            <div class="relative" x-data="{ open: false, selected: 'All Status' }">
                <button @click="open = !open"
                        class="flex items-center gap-3 bg-gray-900 border border-gray-700 hover:border-indigo-500 rounded-xl px-4 py-3 text-sm text-gray-300 transition min-w-40">
                    <span x-text="selected" class="flex-1 text-left"></span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                <div x-show="open"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 scale-100"
                     x-transition:leave-end="opacity-0 scale-95"
                     @click.outside="open = false"
                     class="absolute top-full mt-2 left-0 w-48 bg-gray-900 border border-gray-700 rounded-xl shadow-xl z-50 overflow-hidden">

                    @foreach(['' => 'All Status', 'planning' => 'Planning', 'in_progress' => 'In Progress', 'completed' => 'Completed'] as $val => $label)
                        @php
                            $icons = [
                                ''            => '◉',
                                'planning'    => '🟡',
                                'in_progress' => '🔵',
                                'completed'   => '🟢',
                            ];
                        @endphp
                        <button
                            wire:click="$set('filterStatus', '{{ $val }}')"
                            @click="selected = '{{ $label }}'; open = false"
                            class="flex items-center gap-3 w-full px-4 py-3 text-sm text-gray-300 hover:bg-indigo-600/20 hover:text-white transition text-left">
                            <span>{{ $icons[$val] }}</span>
                            {{ $label }}
                        </button>
                    @endforeach
                </div>
            </div>

            {{-- Search --}}
            <div class="relative flex-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-500 absolute left-4 top-1/2 -translate-y-1/2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <input wire:model.live.debounce.300ms="search"
                       type="text"
                       placeholder= "Cari project..."
                       class="w-full bg-gray-900 border border-gray-700 focus:border-indigo-500 rounded-xl pl-11 pr-4 py-3 text-sm outline-none transition">
            </div>
        </div>

        {{-- Loading --}}
        <div wire:loading.flex wire:target="search,filterStatus"
             class="fixed inset-0 bg-black/40 z-50 items-center justify-center backdrop-blur-sm">
            <div class="bg-gray-900 border border-gray-700 rounded-2xl px-6 py-4 flex items-center gap-3">
                <svg class="animate-spin h-5 w-5 text-indigo-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
                </svg>
                <span class="text-gray-300 text-sm">Memuat...</span>
            </div>
        </div>

        {{-- PROJECTS GRID --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($projects as $project)
                <div class="group bg-gray-900 border border-gray-800 hover:border-indigo-500/50 rounded-2xl overflow-hidden transition-all duration-300 hover:shadow-2xl hover:shadow-indigo-500/10 flex flex-col">

                    {{-- THUMBNAIL --}}
                    <div class="relative h-52 bg-gradient-to-br from-indigo-900/30 to-purple-900/30 overflow-hidden">
                        @if ($project->thumbnail)
                            <img src="{{ Storage::url($project->thumbnail) }}"
                                 alt="{{ $project->title }}"
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                            <div class="w-full h-full flex items-center justify-center">
                                <div class="text-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 text-indigo-800 mx-auto mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                    <p class="text-indigo-700 text-xs">No Preview</p>
                                </div>
                            </div>
                        @endif

                        {{-- Status Badge Overlay --}}
                        <div class="absolute top-3 left-3">
                            <span class="inline-flex items-center gap-1.5 text-xs font-semibold px-3 py-1.5 rounded-full backdrop-blur-md
                                {{ $project->status === 'completed'
                                    ? 'bg-green-500/90 text-white'
                                    : ($project->status === 'planning'
                                        ? 'bg-yellow-500/90 text-white'
                                        : 'bg-blue-500/90 text-white') }}">
                                <span class="w-1.5 h-1.5 rounded-full bg-white {{ $project->status === 'in_progress' ? 'animate-pulse' : '' }}"></span>
                                {{ ucfirst(str_replace('_', ' ', $project->status)) }}
                            </span>
                        </div>

                        {{-- Final Badge --}}
                        @if ($project->is_final_project)
                            <div class="absolute top-3 right-3">
                                <span class="text-xs bg-purple-600/90 backdrop-blur-md text-white px-2 py-1 rounded-full font-semibold">
                                    🎓 Final
                                </span>
                            </div>
                        @endif
                    </div>

                    {{-- CONTENT --}}
                    <div class="p-6 flex flex-col flex-1">

                        {{-- Title --}}
                        <h3 class="text-xl font-bold text-white mb-2 group-hover:text-indigo-300 transition-colors duration-300 line-clamp-1">
                            {{ $project->title }}
                        </h3>

                        {{-- Description --}}
                        <p class="text-gray-400 text-sm mb-4 line-clamp-2 flex-1">
                            {{ \Illuminate\Support\Str::limit($project->description, 120) }}
                        </p>

                        {{-- Progress --}}
                        <div class="mb-4">
                            <div class="flex justify-between text-xs text-gray-400 mb-1.5">
                                <span>Progress</span>
                                <span class="text-indigo-400 font-semibold">{{ $project->progress }}%</span>
                            </div>
                            <div class="w-full bg-gray-800 rounded-full h-1.5 overflow-hidden">
                                <div class="h-1.5 rounded-full bg-gradient-to-r from-indigo-500 to-purple-500 transition-all duration-1000"
                                     style="width: {{ $project->progress }}%"></div>
                            </div>
                        </div>

                        {{-- Tech Stack --}}
                        @if ($project->tech_stack)
                            <div class="flex flex-wrap gap-1.5 mb-5">
                                @php
                                    $deviconMap = [
                                        'laravel'     => 'devicon-laravel-plain colored',
                                        'php'         => 'devicon-php-plain colored',
                                        'livewire'    => 'devicon-livewire-original colored',
                                        'filament'    => 'devicon-php-plain colored',
                                        'mysql'       => 'devicon-mysql-plain colored',
                                        'mariadb'     => 'devicon-mariadb-plain colored',
                                        'docker'      => 'devicon-docker-plain colored',
                                        'tailwind'    => 'devicon-tailwindcss-plain colored',
                                        'tailwindcss' => 'devicon-tailwindcss-plain colored',
                                        'javascript'  => 'devicon-javascript-plain colored',
                                        'js'          => 'devicon-javascript-plain colored',
                                        'vue'         => 'devicon-vuejs-plain colored',
                                        'react'       => 'devicon-react-original colored',
                                        'git'         => 'devicon-git-plain colored',
                                        'github'      => 'devicon-github-original',
                                        'python'      => 'devicon-python-plain colored',
                                        'nodejs'      => 'devicon-nodejs-plain colored',
                                        'alpine'      => 'devicon-alpinejs-plain colored',
                                        'alpinejs'    => 'devicon-alpinejs-plain colored',
                                        'nginx'       => 'devicon-nginx-original colored',
                                    ];
                                @endphp
                                @foreach (array_slice((array) $project->tech_stack, 0, 4) as $tech)
                                    @php
                                        $techKey = strtolower(str_replace([' ', '.', '#'], '', $tech));
                                        $icon = $deviconMap[$techKey] ?? null;
                                    @endphp
                                    <span class="inline-flex items-center gap-1 bg-gray-800 border border-gray-700 text-gray-300 px-2.5 py-1 rounded-full text-xs font-medium hover:border-indigo-500 transition">
                                        @if($icon)
                                            <i class="{{ $icon }} text-sm"></i>
                                        @endif
                                        {{ $tech }}
                                    </span>
                                @endforeach
                                @if (count((array) $project->tech_stack) > 4)
                                    <span class="text-gray-500 text-xs px-2 py-1">+{{ count((array) $project->tech_stack) - 4 }}</span>
                                @endif
                            </div>
                        @endif

                        {{-- BUTTONS --}}
                        <div class="flex gap-2 mt-auto">
                            <a href="{{ route('projects.detail', $project) }}"
                               class="flex-1 inline-flex items-center justify-center gap-2 text-sm font-semibold text-white bg-indigo-600 hover:bg-indigo-500 px-4 py-2.5 rounded-xl transition-all duration-200 group/btn">
                                View Detail
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 group-hover/btn:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>

                            @if ($project->github_url)
                                <a href="{{ $project->github_url }}" target="_blank"
                                   class="inline-flex items-center justify-center gap-2 text-sm font-semibold text-gray-300 hover:text-white bg-gray-800 hover:bg-gray-700 border border-gray-700 hover:border-gray-500 px-4 py-2.5 rounded-xl transition-all duration-200">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0 0 24 12c0-6.63-5.37-12-12-12z"/>
                                    </svg>
                                    GitHub
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-20">
                    <div class="w-16 h-16 bg-gray-900 border border-gray-800 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/>
                        </svg>
                    </div>
                    <p class="text-gray-400 text-lg font-medium">
                        {{ $search ? 'Project tidak ditemukan' : 'Belum ada project' }}
                    </p>
                    <p class="text-gray-500 text-sm mt-1">
                        {{ $search ? 'Coba kata kunci lain' : 'Project akan muncul di sini.' }}
                    </p>
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if ($projects->hasPages())
            <div class="mt-10 flex justify-center">
                {{ $projects->links() }}
            </div>
        @endif

    </div>
</div>
