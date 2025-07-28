<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            📁 List Projects
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Tombol & Filter --}}
            <div class="flex items-center justify-between mb-4">
                <a href="{{ route('projects.create') }}"
                   class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">
                    ➕ New Project
                </a>
            </div>

            @if(session('success'))
                <div class="mt-2 mb-4 px-4 py-2 bg-green-100 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid gap-4">
                @forelse ($projects as $project)
                    <div class="border p-4 rounded shadow-sm bg-white">
                        <h3 class="text-xl font-bold text-gray-800">📌 {{ $project->name }}</h3>
                        <p class="text-gray-600">{{ $project->description }}</p>
                        <p class="text-sm text-gray-500">🗓️ Deadline: {{ $project->deadline }}</p>

                                {{-- Hitung progress --}}
                        @php
                            $total = $project->tasks->count();
                            $done = $project->tasks->where('is_completed', true)->count();
                            $progress = $total > 0 ? round(($done / $total) * 100) : 0;
                        @endphp

                        <div class="mt-3">
                            <div class="text-sm text-gray-600 mb-1">📊 Progress: {{ $progress }}%</div>
                            <div class="w-full bg-gray-200 rounded h-3">
                                <div class="bg-green-500 h-3 rounded" style="width: {{ $progress }}%;"></div>
                            </div>
                        </div>

                        <div class="mt-3 flex gap-2 flex-wrap">
                            {{-- Tombol Edit --}}
                            <a href="{{ route('projects.edit', $project->id) }}"
                               class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600 text-sm">
                                ✏️ Edit
                            </a>

                            {{-- Tombol Hapus --}}
                            <form action="{{ route('projects.destroy', $project->id) }}" method="POST"
                                  onsubmit="return confirm('Hapus proyek ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 text-sm">
                                    🗑️ Delete
                                </button>
                            </form>

                            {{-- Lihat Detail --}}
                            <a href="{{ route('projects.show', $project->id) }}"
                               class="bg-indigo-500 text-white px-3 py-1 rounded hover:bg-indigo-600 text-sm">
                                👁️ Details
                            </a>

                            {{-- 🔗 Link ke Task List --}}
                            <a href="{{ route('projects.tasks.index', $project->id) }}"
                               class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600 text-sm">
                                📋 Task List
                            </a>

                            {{-- 🔗 Link ke Anggota Proyek --}}
                            <a href="{{ route('projects.members.index', $project->id) }}"
                               class="bg-purple-500 text-white px-3 py-1 rounded hover:bg-purple-600 text-sm">
                                👥 Team
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="text-gray-500">Belum ada proyek 😢</div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
