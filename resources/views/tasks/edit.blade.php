<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 flex items-center gap-2">
            ✏️ Edit Task
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-xl mx-auto px-4 sm:px-6 lg:px-8">

            @if ($errors->any())
                <div class="mb-4 bg-red-100 text-red-700 p-3 rounded">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('projects.tasks.update', [$project, $task]) }}" method="POST"
                  class="bg-white p-6 rounded shadow">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="name" class="block font-medium text-gray-700">📝 Task Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $task->name) }}"
                           class="w-full border-gray-300 rounded shadow-sm mt-1">
                </div>

                <div class="flex justify-between items-center">
                    <div>
                        <label for="is_completed" class="inline-flex items-center">
                            <input type="checkbox" name="is_completed" id="is_completed"
                                   class="mr-2" {{ $task->is_completed ? 'checked' : '' }}>
                            <span class="text-sm text-gray-700">✅ Done</span>
                        </label>
                    </div>

                    <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition flex items-center gap-1">
                        💾 Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
