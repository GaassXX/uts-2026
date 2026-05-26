<div class="max-w-2xl mx-auto px-4 py-16">
    <div class="text-center mb-10">
        <h1 class="text-4xl font-bold mb-2">Contact Us</h1>
        <p class="text-gray-400">Ada pertanyaan atau mau kolaborasi? Kirim pesan ke saya.</p>
    </div>

    @if(session('success'))
        <div class="bg-green-900/50 border border-green-700 text-green-300 px-4 py-3 rounded-lg mb-6">
            ✅ {{ session('success') }}
        </div>
    @endif

    <div class="bg-gray-900 border border-gray-800 rounded-2xl p-8"
         x-data="{
             charCount: 0,
             maxChar: 1000,
             showPreview: false,
             name: '',
             email: '',
             subject: '',
             message: '',
             updateCount(val) {
                 this.charCount = val.length;
                 this.message = val;
             }
         }">

        {{-- Preview Toggle --}}
        <div class="flex justify-end mb-4">
            <button
                type="button"
                @click="showPreview = !showPreview"
                :class="showPreview ? 'bg-indigo-600 text-white' : 'bg-gray-800 text-gray-400 hover:text-white'"
                class="flex items-center gap-2 px-3 py-1.5 rounded-lg text-sm font-medium transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                </svg>
                <span x-text="showPreview ? 'Tutup Preview' : 'Preview Pesan'"></span>
            </button>
        </div>

        {{-- Preview Box --}}
        <div x-show="showPreview"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 -translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-2"
             class="mb-6 bg-gray-800 border border-indigo-500/30 rounded-xl p-5 space-y-2 text-sm">
            <p class="text-gray-400 text-xs font-semibold uppercase tracking-wider mb-3">📋 Preview Pesan</p>
            <p><span class="text-gray-500">Dari:</span> <span class="text-white" x-text="name || '—'"></span></p>
            <p><span class="text-gray-500">Email:</span> <span class="text-white" x-text="email || '—'"></span></p>
            <p><span class="text-gray-500">Subject:</span> <span class="text-white" x-text="subject || '—'"></span></p>
            <p><span class="text-gray-500">Pesan:</span> <span class="text-white" x-text="message || '—'"></span></p>
        </div>

        <form wire:submit.prevent="submit" class="space-y-5">
            <div>
                <label class="block text-sm text-gray-400 mb-1">Nama <span class="text-red-400">*</span></label>
                <input wire:model="name"
                       x-model="name"
                       type="text"
                       placeholder="John Doe"
                       class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-3 focus:border-indigo-500 outline-none transition">
                @error('name')
                    <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block text-sm text-gray-400 mb-1">Email <span class="text-red-400">*</span></label>
                <input wire:model="email"
                       x-model="email"
                       type="email"
                       placeholder="john@example.com"
                       class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-3 focus:border-indigo-500 outline-none transition">
                @error('email')
                    <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block text-sm text-gray-400 mb-1">Subject <span class="text-red-400">*</span></label>
                <input wire:model="subject"
                       x-model="subject"
                       type="text"
                       placeholder="Perihal pesan..."
                       class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-3 focus:border-indigo-500 outline-none transition">
                @error('subject')
                    <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <div class="flex justify-between items-center mb-1">
                    <label class="block text-sm text-gray-400">Pesan <span class="text-red-400">*</span></label>
                    <span class="text-xs"
                          :class="charCount > maxChar * 0.9 ? 'text-red-400' : 'text-gray-500'"
                          x-text="charCount + ' / ' + maxChar + ' karakter'">
                    </span>
                </div>
                <textarea wire:model="message"
                          @input="updateCount($event.target.value)"
                          rows="5"
                          :maxlength="maxChar"
                          placeholder="Tulis pesan anda di sini..."
                          class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-3 focus:border-indigo-500 outline-none transition resize-none"></textarea>

                {{-- Character progress bar --}}
                <div class="mt-1 h-1 bg-gray-700 rounded-full overflow-hidden">
                    <div class="h-full rounded-full transition-all duration-300"
                         :class="charCount > maxChar * 0.9 ? 'bg-red-500' : 'bg-indigo-500'"
                         :style="'width: ' + Math.min((charCount / maxChar) * 100, 100) + '%'">
                    </div>
                </div>

                @error('message')
                    <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit"
                    class="w-full py-3 bg-indigo-600 hover:bg-indigo-700 rounded-lg font-semibold transition">
                <span wire:loading.remove>Kirim Pesan</span>
                <span wire:loading>Mengirim...</span>
            </button>
        </form>
    </div>
</div>
