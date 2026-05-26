<div class="min-h-screen bg-gray-950 text-white">
    <div class="mx-auto px-4 pt-5 pb-16">

        {{-- Header --}}
        <div class="py-12 border-b border-gray-800">
            <div class="flex items-center gap-2 text-indigo-400 text-xs font-semibold uppercase tracking-widest mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8V11h-8v10zm0-18v6h8V3h-8z"/>
                </svg>
                MY PROJECTS
            </div>
            <h1 class="text-5xl font-bold text-white mb-3">Projects</h1>
            <p class="text-gray-400 text-lg">Kumpulan project yang sedang saya kerjakan</p>
        </div>

        {{-- Projects Grid --}}
        <div class="mt-12 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($projects as $project)
                <div class="group bg-gradient-to-br from-gray-900 via-gray-900 to-gray-950 border border-gray-800 hover:border-indigo-500/50 rounded-2xl p-6 transition-all duration-300 ease-smooth hover:shadow-2xl hover:shadow-indigo-500/20 flex flex-col h-full animate-fade-up overflow-hidden relative">

                    {{-- Animated Background Gradient --}}
                    <div class="absolute inset-0 bg-gradient-to-tr from-indigo-600/5 to-purple-600/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none"></div>

                    {{-- Content Wrapper --}}
                    <div class="relative z-10 flex flex-col h-full">

                        {{-- Top Section: Icon/Thumbnail and Status --}}
                        <div class="flex items-start justify-between mb-4">
                            <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-indigo-900/50 to-purple-900/50 border border-indigo-800/50 hover:border-indigo-500 flex items-center justify-center flex-shrink-0 overflow-hidden group/icon transition-all duration-300">
                                @if ($project->thumbnail)
                                    <img src="{{ Storage::url($project->thumbnail) }}"
                                         alt="{{ $project->title }}"
                                         class="w-full h-full object-cover group-hover/icon:scale-110 transition-transform duration-300">
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-indigo-400 group-hover/icon:text-indigo-300 transition-colors duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                    </svg>
                                @endif
                            </div>

                            {{-- More Options Menu --}}
                            <button class="text-gray-600 hover:text-indigo-400 transition-colors duration-200 hover:bg-indigo-950/50 p-2 rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <circle cx="12" cy="5" r="2"/>
                                    <circle cx="12" cy="12" r="2"/>
                                    <circle cx="12" cy="19" r="2"/>
                                </svg>
                            </button>
                        </div>

                        {{-- Status Badge --}}
                        <div class="flex items-center gap-2 mb-3">
                            <span class="flex items-center gap-1.5 text-xs font-semibold px-3 py-1.5 rounded-full backdrop-blur-sm transition-all duration-300
                                {{ $project->status === 'completed' ? 'bg-green-500/20 text-green-300 border border-green-500/30' : ($project->status === 'planning' ? 'bg-gray-500/20 text-gray-300 border border-gray-500/30' : 'bg-blue-500/20 text-blue-300 border border-blue-500/30') }}">
                                <span class="w-2 h-2 rounded-full inline-block
                                    {{ $project->status === 'completed' ? 'bg-green-400 animate-pulse' : ($project->status === 'planning' ? 'bg-gray-400' : 'bg-blue-400 animate-pulse-slow') }}"></span>
                                {{ ucfirst(str_replace('_', ' ', $project->status)) }}
                            </span>
                        </div>

                        {{-- Title --}}
                        <h3 class="text-xl font-bold text-white mb-2 group-hover:text-indigo-300 transition-colors duration-300 line-clamp-2">{{ $project->title }}</h3>

                        {{-- Short Description --}}
                        <p class="text-gray-400 text-sm mb-4 line-clamp-2 group-hover:text-gray-300 transition-colors duration-300">
                            {{ $project->short_description ?? 'Innovative project showcasing modern web technologies' }}
                        </p>

                        {{-- Tech Stack with Icons --}}
                        @if ($project->tech_stack)
                            <div class="flex flex-wrap gap-2 mb-4">
                                @foreach (array_slice((array) $project->tech_stack, 0, 3) as $tech)
                                    <span class="bg-gradient-to-r from-indigo-900/40 to-purple-900/40 text-indigo-300 px-2.5 py-1 rounded-full text-xs font-medium border border-indigo-700/30 hover:border-indigo-500/50 transition-all duration-200 hover:shadow-lg hover:shadow-indigo-500/10">
                                        {{ $tech }}
                                    </span>
                                @endforeach
                                @if (count((array) $project->tech_stack) > 3)
                                    <span class="text-gray-500 text-xs px-2 py-1 italic">+{{ count((array) $project->tech_stack) - 3 }} more</span>
                                @endif
                            </div>
                        @endif

                        {{-- Progress Bar with Animation --}}
                        <div class="mb-4 flex-1">
                            <div class="flex justify-between text-xs text-gray-400 mb-2 font-medium">
                                <span class="group-hover:text-gray-300 transition-colors duration-300">Progress</span>
                                <span class="text-indigo-400 font-semibold group-hover:text-indigo-300 transition-colors duration-300">{{ $project->progress }}%</span>
                            </div>
                            <div class="w-full bg-gray-800/50 rounded-full h-2 border border-gray-700/50 overflow-hidden">
                                <div class="h-2 rounded-full bg-gradient-to-r from-indigo-500 via-purple-500 to-indigo-400 transition-all duration-1000 ease-smooth"
                                     style="width: {{ $project->progress }}%; box-shadow: 0 0 10px rgba(79, 70, 229, 0.5)"></div>
                            </div>
                        </div>

                        {{-- Updated Info --}}
                        <div class="flex items-center gap-1.5 text-gray-500 text-xs mb-4 pb-4 border-b border-gray-800/50 group-hover:border-gray-700 transition-colors duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <span class="group-hover:text-gray-300 transition-colors duration-300">Updated {{ $project->updated_at->diffForHumans() }}</span>
                        </div>

                        {{-- View Detail Button --}}
                        <a href="{{ route('projects.detail', $project) }}"
                           class="inline-flex items-center justify-center gap-1.5 text-sm font-semibold text-indigo-300 hover:text-white bg-gradient-to-r from-indigo-950/60 to-purple-950/60 hover:from-indigo-700 hover:to-purple-700 border border-indigo-700/50 hover:border-indigo-500 px-4 py-2.5 rounded-lg transition-all duration-300 ease-smooth w-full group/btn hover:shadow-lg hover:shadow-indigo-500/20 active:scale-95">
                            <span class="group-hover/btn:text-indigo-100">View Detail</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transition-transform duration-300 group-hover/btn:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-20">
                    <div class="text-center space-y-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 mx-auto text-gray-700 opacity-50" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                        </svg>
                        <p class="text-gray-400 text-lg font-medium">Belum ada project</p>
                        <p class="text-gray-500 text-sm">Mulai buat project Anda sekarang!</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</div>
