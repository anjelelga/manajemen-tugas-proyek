<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight flex items-center gap-2">
            🆕 Add a new project
        </h2>
    </x-slot>

    <div class="py-10 max-w-3xl mx-auto">
        <form method="POST" action="{{ route('projects.store') }}" class="bg-white p-6 rounded shadow">
            @csrf

            <div class="mb-4">
                <label class="block font-medium text-sm text-gray-700">📌 Project Name</label>
                <input type="text" name="name" class="form-input w-full" required>
            </div>

            <div class="mb-4">
                <label class="block font-medium text-sm text-gray-700">📝 Project Description</label>
                <textarea name="description" class="form-input w-full" rows="4"></textarea>
            </div>

            <div class="mb-4">
                <label class="block font-medium text-sm text-gray-700">⏳ Deadline</label>
                <input type="date" name="deadline" class="form-input w-full">
            </div>

            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                💾 Save
            </button>
        </form>
    </div>
</x-app-layout>
