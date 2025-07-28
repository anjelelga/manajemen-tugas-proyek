<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            📄 Project Details
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Box Detail -->
            <div class="bg-white p-6 rounded shadow mb-6">
                <h3 class="text-2xl font-bold text-gray-800 mb-3 flex items-center gap-2">
                    📁 {{ $project->name }}
                </h3>

                <p class="text-gray-700 mb-4">
                    <span class="font-semibold inline-flex items-center gap-1">
                        📝 Description:
                    </span><br>
                    {{ $project->description ?? 'Tidak ada deskripsi.' }}
                </p>

                <p class="text-gray-600">
                    <span class="font-semibold inline-flex items-center gap-1">
                        📅 Deadline:
                    </span>
                    {{ $project->deadline ? \Carbon\Carbon::parse($project->deadline)->translatedFormat('d F Y') : '-' }}
                </p>
            </div>

            {{-- Tombol Kembali --}}
            <div class="mt-13 text-right">
                <a href="{{ route('projects.index') }}"
                   class="inline-block px-4 py-2 bg-gray-700 text-white rounded hover:bg-gray-800 transition">
                    &larr; Kembali ke Daftar Proyek
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
