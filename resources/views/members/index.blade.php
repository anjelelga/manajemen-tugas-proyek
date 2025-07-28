<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            👥 Project Team - {{ $project->name }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Notifikasi --}}
            @if(session('success'))
                <div class="mb-4 text-green-700 bg-green-100 p-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-4 text-red-700 bg-red-100 p-3 rounded">
                    {{ session('error') }}
                </div>
            @endif

            {{-- Form Tambah Anggota --}}
            <form action="{{ route('projects.members.store', $project) }}" method="POST" class="bg-white p-4 rounded shadow mb-6">
                @csrf
                <label for="email" class="block font-medium text-gray-700 mb-1">📧 Member Email </label>
                <input type="email" name="email" id="email" class="w-full border-gray-300 rounded shadow-sm mb-2" required>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    ➕ Add Members
                </button>
            </form>

            {{-- Daftar Anggota --}}
            <h3 class="text-lg font-semibold mb-3">👨‍💻 Team List</h3>
            <ul class="space-y-2 mb-6">
                @forelse($project->members as $member)
                    <li class="bg-white p-3 rounded shadow flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <span class="text-gray-800">👤 {{ $member->name }}</span>
                            <span class="text-sm text-gray-500">({{ $member->email }})</span>
                        </div>
                        <form action="{{ route('projects.members.destroy', [$project->id, $member->id]) }}"
                              method="POST" onsubmit="return confirm('Hapus anggota ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-600 hover:text-red-800 text-sm">❌ Delete</button>
                        </form>
                    </li>
                @empty
                    <li class="text-gray-500 italic text-center">Belum ada anggota tim pada proyek ini.</li>
                @endforelse
            </ul>

            {{-- Tombol Kembali --}}
            <div class="flex justify-end">
                <a href="{{ route('projects.index') }}"
                   class="inline-block px-4 py-2 bg-gray-700 text-white rounded hover:bg-gray-800 transition">
                    &larr; Kembali ke Daftar Proyek
                </a>
            </div>

        </div>
    </div>
</x-app-layout>
