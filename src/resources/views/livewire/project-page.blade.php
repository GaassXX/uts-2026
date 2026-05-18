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
                <div class="bg-gray-900 border border-gray-800 hover:border-indigo-500 rounded-2xl p-6 transition group hover:shadow-xl hover:shadow-indigo-500/20 flex flex-col h-full">

                    {{-- Top Section: Icon/Thumbnail and Status --}}
                    <div class="flex items-start justify-between mb-4">
                        <div class="w-14 h-14 rounded-xl bg-indigo-900/50 border border-indigo-800 flex items-center justify-center flex-shrink-0 overflow-hidden">
                            @if ($project->thumbnail)
                                <img src="{{ Storage::url($project->thumbnail) }}"
                                     alt="{{ $project->title }}"
                                     class="w-full h-full object-cover">
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                </svg>
                            @endif
                        </div>

                        {{-- More Options Menu --}}
                        <button class="text-gray-600 hover:text-gray-300 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <circle cx="12" cy="5" r="2"/>
                                <circle cx="12" cy="12" r="2"/>
                                <circle cx="12" cy="19" r="2"/>
                            </svg>
                        </button>
                    </div>

                    {{-- Status Badge --}}
                    <div class="flex items-center gap-2 mb-3">
                        <span class="flex items-center gap-1.5 text-xs font-medium
                            {{ $project->status === 'completed' ? 'text-green-400' : ($project->status === 'planning' ? 'text-gray-400' : 'text-blue-400') }}">
                            <span class="w-2 h-2 rounded-full
                                {{ $project->status === 'completed' ? 'bg-green-400' : ($project->status === 'planning' ? 'bg-gray-400' : 'bg-blue-400') }}"></span>
                            {{ ucfirst(str_replace('_', ' ', $project->status)) }}
                        </span>
                    </div>

                    {{-- Title --}}
                    <h3 class="text-xl font-bold text-white mb-2">{{ $project->title }}</h3>

                    {{-- Subtitle --}}
                    <p class="text-gray-400 text-sm mb-4">sedang berjalan</p>

                    {{-- Tech Stack --}}
                    @if ($project->tech_stack)
                        <div class="flex flex-wrap gap-1 mb-4">
                            @foreach (array_slice((array) $project->tech_stack, 0, 3) as $tech)
                                <span class="bg-gray-800/50 text-indigo-400 px-2 py-0.5 rounded text-xs font-medium">{{ $tech }}</span>
                            @endforeach
                        </div>
                    @endif

                    {{-- Progress Bar --}}
                    <div class="mb-4 flex-1">
                        <div class="flex justify-between text-xs text-gray-500 mb-2">
                            <span>Progress</span>
                            <span class="text-indigo-400 font-semibold">{{ $project->progress }}%</span>
                        </div>
                        <div class="w-full bg-gray-800 rounded-full h-2">
                            <div class="h-2 rounded-full bg-gradient-to-r from-indigo-500 to-purple-500"
                                 style="width: {{ $project->progress }}%"></div>
                        </div>
                    </div>

                    {{-- Updated Info --}}
                    <div class="flex items-center gap-1.5 text-gray-500 text-xs mb-4 pb-4 border-b border-gray-800">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        Updated {{ $project->updated_at->diffForHumans() }}
                    </div>

                    {{-- View Detail Button --}}
                    <a href="{{ route('projects.detail', $project) }}"
                       class="inline-flex items-center justify-center gap-1.5 text-sm text-indigo-400 hover:text-white bg-indigo-950/50 hover:bg-indigo-600 border border-indigo-800 hover:border-indigo-500 px-4 py-2 rounded-lg transition font-medium w-full">
                        View Detail →
                    </a>
                </div>
            @empty
                <div class="col-span-full text-center py-12">
                    <p class="text-gray-500 text-lg">Belum ada project.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
