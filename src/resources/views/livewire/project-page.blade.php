<div class="container mx-auto px-4 py-12">
    <h1 class="text-3xl font-bold mb-8 text-white">Projects</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($projects as $project)
            <a href="{{ route('projects.detail', $project) }}"
               class="block bg-gray-800 rounded-xl p-6 hover:bg-gray-700 transition">

                {{-- Thumbnail --}}
                @if ($project->thumbnail)
                    <img src="{{ Storage::url($project->thumbnail) }}"
                         alt="{{ $project->title }}"
                         class="w-full h-48 object-cover rounded-lg mb-4">
                @endif

                {{-- Title --}}
                <h2 class="text-xl font-semibold text-white mb-2">
                    {{ $project->title }}
                </h2>

                {{-- Status Badge --}}
                <span class="inline-block px-3 py-1 text-sm rounded-full mb-3
                    {{ $project->status === 'completed' ? 'bg-green-600' : 'bg-yellow-600' }} text-white">
                    {{ $project->status }}
                </span>

                {{-- Progress --}}
                <div class="w-full bg-gray-600 rounded-full h-2 mb-2">
                    <div class="bg-blue-500 h-2 rounded-full"
                         style="width: {{ $project->progress }}%"></div>
                </div>
                <p class="text-gray-400 text-sm">Progress: {{ $project->progress }}%</p>

            </a>
        @empty
            <p class="text-gray-400">Belum ada project.</p>
        @endforelse
    </div>
</div>
