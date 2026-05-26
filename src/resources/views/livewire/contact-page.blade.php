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

    <div class="bg-gray-900 border border-gray-800 rounded-2xl p-8">
        <form wire:submit.prevent="submit" class="space-y-5">
            <div>
                <label class="block text-sm text-gray-400 mb-1">Nama <span class="text-red-400">*</span></label>
                <input wire:model="name" type="text" placeholder="John Doe"
                       class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-3 focus:border-indigo-500 outline-none transition">
                @error('name')
                    <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block text-sm text-gray-400 mb-1">Email <span class="text-red-400">*</span></label>
                <input wire:model="email" type="email" placeholder="john@example.com"
                       class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-3 focus:border-indigo-500 outline-none transition">
                @error('email')
                    <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block text-sm text-gray-400 mb-1">Subject <span class="text-red-400">*</span></label>
                <input wire:model="subject" type="text" placeholder="Perihal pesan..."
                       class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-3 focus:border-indigo-500 outline-none transition">
                @error('subject')
                    <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block text-sm text-gray-400 mb-1">Pesan <span class="text-red-400">*</span></label>
                <textarea wire:model="message" rows="5" placeholder="Tulis pesan anda di sini..."
                          class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-3 focus:border-indigo-500 outline-none transition resize-none"></textarea>
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
