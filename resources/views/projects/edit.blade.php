<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            ✏️ Edit Project
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">

            @if ($errors->any())
                <div class="mb-4 bg-red-100 text-red-700 p-3 rounded">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('projects.update', $project) }}" method="POST" class="bg-white p-6 rounded shadow">
                @csrf
                @method('PUT')

                <!-- Nama Proyek -->
                <div class="mb-4">
                    <label for="name" class="block font-medium text-gray-700">
                        📁 Project Name
                    </label>
                    <input type="text" name="name" id="name" value="{{ old('name', $project->name) }}"
                           class="w-full border-gray-300 rounded shadow-sm mt-1" required>
                </div>

                <!-- Deskripsi Proyek -->
                <div class="mb-4">
                    <label for="description" class="block font-medium text-gray-700">
                        📝 Description
                    </label>
                    <textarea name="description" id="description" rows="3"
                              class="w-full border-gray-300 rounded shadow-sm mt-1" required>{{ old('description', $project->description) }}</textarea>
                </div>

                <!-- Deadline -->
                <div class="mb-4">
                    <label for="deadline" class="block font-medium text-gray-700">
                        📅 Deadline
                    </label>
                    <input type="date" name="deadline" id="deadline" value="{{ old('deadline', $project->deadline) }}"
                           class="w-full border-gray-300 rounded shadow-sm mt-1" required>
                </div>

                <!-- Tombol Simpan -->
                <div class="flex justify-end">
                    <button type="submit"
                            class="px-5 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition flex items-center gap-2">
                        💾 Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
