<div class="min-h-screen flex items-center py-24 px-6"
     style="background: radial-gradient(ellipse at 20% 50%, rgba(99,60,180,0.15) 0%, transparent 60%), radial-gradient(ellipse at 80% 20%, rgba(79,70,229,0.1) 0%, transparent 60%), #030712;">

    <div class="max-w-6xl mx-auto w-full">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            {{-- LEFT: Info --}}
            <div class="bg-gray-900/60 backdrop-blur border border-gray-800 rounded-3xl p-8 flex flex-col justify-between">

                <div>
                    {{-- Badge --}}
                    <div class="inline-flex items-center gap-2 bg-indigo-600/20 border border-indigo-500/30 text-indigo-300 text-xs font-semibold px-3 py-1.5 rounded-full mb-6">
                        <span class="w-1.5 h-1.5 bg-indigo-400 rounded-full"></span>
                        GET IN TOUCH
                    </div>

                    <h1 class="text-4xl font-bold text-white mb-3">
                        Contact <span class="text-indigo-400">Me</span>
                    </h1>
                    <p class="text-gray-400 text-sm leading-relaxed mb-8">
                        Punya project menarik atau ingin bekerja sama?<br>
                        Silakan hubungi saya melalui informasi di bawah ini.
                    </p>

                    {{-- Contact Items --}}
                    <div class="space-y-3">

                        {{-- Email --}}
                        @if($profile?->email)
                        <a href="mailto:{{ $profile->email }}"
                           class="flex items-center gap-4 bg-gray-800/50 hover:bg-indigo-600/10 border border-gray-700/50 hover:border-indigo-500/50 rounded-2xl px-4 py-3.5 transition group">
                            <div class="w-10 h-10 bg-indigo-600/20 rounded-xl flex items-center justify-center flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-white text-sm font-semibold">Email</p>
                                <p class="text-gray-400 text-xs truncate">{{ $profile->email }}</p>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-600 group-hover:text-indigo-400 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                        @endif

                        {{-- WhatsApp --}}
                        @if($profile?->whatsapp)
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $profile->whatsapp) }}" target="_blank"
                           class="flex items-center gap-4 bg-gray-800/50 hover:bg-green-600/10 border border-gray-700/50 hover:border-green-500/50 rounded-2xl px-4 py-3.5 transition group">
                            <div class="w-10 h-10 bg-green-600/20 rounded-xl flex items-center justify-center flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-400" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-white text-sm font-semibold">WhatsApp</p>
                                <p class="text-gray-400 text-xs">{{ $profile->whatsapp }}</p>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-600 group-hover:text-green-400 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                        @endif

                        {{-- GitHub --}}
                        @if($profile?->github)
                        <a href="{{ $profile->github }}" target="_blank"
                           class="flex items-center gap-4 bg-gray-800/50 hover:bg-gray-700/50 border border-gray-700/50 hover:border-gray-500/50 rounded-2xl px-4 py-3.5 transition group">
                            <div class="w-10 h-10 bg-gray-700/50 rounded-xl flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0 0 24 12c0-6.63-5.37-12-12-12z"/>
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-white text-sm font-semibold">GitHub</p>
                                <p class="text-gray-400 text-xs truncate">{{ $profile->github }}</p>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-600 group-hover:text-white transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                        @endif

                        {{-- LinkedIn --}}
                        @if($profile?->linkedin)
                        <a href="{{ $profile->linkedin }}" target="_blank"
                           class="flex items-center gap-4 bg-gray-800/50 hover:bg-blue-600/10 border border-gray-700/50 hover:border-blue-500/50 rounded-2xl px-4 py-3.5 transition group">
                            <div class="w-10 h-10 bg-blue-600/20 rounded-xl flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-blue-400" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 0 1-2.063-2.065 2.064 2.064 0 1 1 2.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-white text-sm font-semibold">LinkedIn</p>
                                <p class="text-gray-400 text-xs truncate">{{ $profile->linkedin }}</p>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-600 group-hover:text-blue-400 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                        @endif

                        {{-- Location --}}
                        @if($profile?->location)
                        <div class="flex items-center gap-4 bg-gray-800/50 border border-gray-700/50 rounded-2xl px-4 py-3.5">
                            <div class="w-10 h-10 bg-purple-600/20 rounded-xl flex items-center justify-center flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-white text-sm font-semibold">Location</p>
                                <p class="text-gray-400 text-xs">{{ $profile->location }}</p>
                            </div>
                        </div>
                        @endif

                    </div>
                </div>

                {{-- Social Icons --}}
                <div class="flex gap-3 mt-8">
                    @if($profile?->github)
                    <a href="{{ $profile->github }}" target="_blank"
                       class="w-10 h-10 bg-gray-800 hover:bg-gray-700 border border-gray-700 hover:border-gray-500 rounded-xl flex items-center justify-center transition text-gray-400 hover:text-white">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0 0 24 12c0-6.63-5.37-12-12-12z"/>
                        </svg>
                    </a>
                    @endif
                    @if($profile?->linkedin)
                    <a href="{{ $profile->linkedin }}" target="_blank"
                       class="w-10 h-10 bg-gray-800 hover:bg-blue-600/20 border border-gray-700 hover:border-blue-500/50 rounded-xl flex items-center justify-center transition text-gray-400 hover:text-blue-400">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 0 1-2.063-2.065 2.064 2.064 0 1 1 2.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                        </svg>
                    </a>
                    @endif
                    @if($profile?->instagram)
                    <a href="https://instagram.com/{{ ltrim($profile->instagram, '@') }}" target="_blank"
                       class="w-10 h-10 bg-gray-800 hover:bg-pink-600/20 border border-gray-700 hover:border-pink-500/50 rounded-xl flex items-center justify-center transition text-gray-400 hover:text-pink-400">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                        </svg>
                    </a>
                    @endif
                    <a href="mailto:{{ $profile?->email }}"
                       class="w-10 h-10 bg-gray-800 hover:bg-indigo-600/20 border border-gray-700 hover:border-indigo-500/50 rounded-xl flex items-center justify-center transition text-gray-400 hover:text-indigo-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </a>
                </div>
            </div>

            {{-- RIGHT: Form --}}
            <div class="bg-gray-900/60 backdrop-blur border border-gray-800 rounded-3xl p-8">

                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-white">Send Message</h2>
                        <p class="text-gray-400 text-xs">Isi formulir di bawah ini dan saya akan segera merespon.</p>
                    </div>
                </div>

                @if(session('success'))
                    <div class="flex items-center gap-3 bg-green-500/10 border border-green-500/30 text-green-400 px-4 py-3 rounded-xl mb-6 text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ session('success') }}
                    </div>
                @endif

                <form wire:submit.prevent="submit" class="space-y-4">

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs text-gray-400 mb-1.5 uppercase tracking-wider">Your Name</label>
                            <div class="relative">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-500 absolute left-3 top-1/2 -translate-y-1/2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                <input wire:model="name" type="text" placeholder="Masukkan nama Anda"
                                       class="w-full bg-gray-800/50 border border-gray-700 focus:border-indigo-500 rounded-xl pl-10 pr-4 py-3 text-sm outline-none transition placeholder-gray-600">
                            </div>
                            @error('name') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-xs text-gray-400 mb-1.5 uppercase tracking-wider">Email Address</label>
                            <div class="relative">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-500 absolute left-3 top-1/2 -translate-y-1/2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                                <input wire:model="email" type="email" placeholder="Masukkan email Anda"
                                       class="w-full bg-gray-800/50 border border-gray-700 focus:border-indigo-500 rounded-xl pl-10 pr-4 py-3 text-sm outline-none transition placeholder-gray-600">
                            </div>
                            @error('email') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs text-gray-400 mb-1.5 uppercase tracking-wider">Subject</label>
                        <div class="relative">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-500 absolute left-3 top-1/2 -translate-y-1/2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
                            </svg>
                            <input wire:model="subject" type="text" placeholder="Tulis subject"
                                   class="w-full bg-gray-800/50 border border-gray-700 focus:border-indigo-500 rounded-xl pl-10 pr-4 py-3 text-sm outline-none transition placeholder-gray-600">
                        </div>
                        @error('subject') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-xs text-gray-400 mb-1.5 uppercase tracking-wider">Message</label>
                        <div class="relative">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-500 absolute left-3 top-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                            </svg>
                            <textarea wire:model="message" rows="5" placeholder="Tulis pesan Anda di sini..."
                                      class="w-full bg-gray-800/50 border border-gray-700 focus:border-indigo-500 rounded-xl pl-10 pr-4 py-3 text-sm outline-none transition resize-none placeholder-gray-600"></textarea>
                        </div>
                        @error('message') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <button type="submit"
                            class="w-full flex items-center justify-center gap-2 py-3.5 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-500 hover:to-purple-500 rounded-xl font-semibold text-sm transition-all duration-200 hover:shadow-lg hover:shadow-indigo-500/25">
                        <span wire:loading.remove>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 inline mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                            </svg>
                            Send Message
                        </span>
                        <span wire:loading>Mengirim...</span>
                    </button>

                </form>
            </div>
        </div>
    </div>
</div>
