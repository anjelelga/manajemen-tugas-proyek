<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight flex items-center gap-2">
    ✅ Task List - {{ $project->name }}
</h2>

    </x-slot>

    <div class="py-6">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 text-green-700 bg-green-100 p-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Form Tambah Tugas --}}
            <form action="{{ route('projects.tasks.store', $project->id) }}" method="POST" class="mb-6 bg-white p-4 rounded shadow">
                @csrf
                <label for="name" class="block font-medium text-gray-700 mb-1">📝 Task Name</label>
                <input type="text" name="name" id="name" class="w-full border-gray-300 rounded shadow-sm mb-2" required>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    ➕ Add Tasks
                </button>
            </form>

            {{-- Daftar Tugas --}}
            <h3 class="text-lg font-semibold mb-3">📋 Task List</h3>
            <ul class="space-y-3">
    @forelse($project->tasks as $task)
        {{-- isi setiap task --}}
        <li class="flex justify-between items-center bg-white p-4 rounded shadow">
            <form action="{{ route('projects.tasks.toggle', [$project, $task]) }}" method="POST" class="flex items-center w-full">
                @csrf
                <label class="flex items-center space-x-2 w-full">
                    <input type="checkbox" onchange="this.form.submit()" {{ $task->is_completed ? 'checked' : '' }}>
                    <span class="{{ $task->is_completed ? 'line-through text-gray-500' : '' }}">
                        {{ $task->name }}
                    </span>
                </label>
            </form>
            <div class="flex gap-2 items-center">
                <a href="{{ route('projects.tasks.edit', [$project, $task]) }}" class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600 text-sm flex items-center gap-1">✏️ Edit</a>
                <form action="{{ route('projects.tasks.destroy', [$project, $task]) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus tugas ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700 text-sm flex items-center gap-1">🗑️ Delete</button>
                </form>
            </div>
        </li>
    @empty
        <li class="text-gray-500 italic text-center">Belum ada tugas pada proyek ini.</li>
    @endforelse

    
</ul>
            {{-- Tombol Kembali --}}
            <div class="mt-5 text-right">
                <a href="{{ route('projects.index') }}"
                   class="inline-block px-4 py-2 bg-gray-700 text-white rounded hover:bg-gray-800 transition">
                    &larr; Kembali ke Daftar Proyek
                </a>
            </div>

        </div>
    </div>
</x-app-layout>
