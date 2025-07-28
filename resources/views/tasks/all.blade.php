<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            📋 All Task
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            @foreach ($projects as $project)
                <div class="mb-6">
                    <h3 class="text-lg font-bold mb-2">📁 {{ $project->name }}</h3>
                    <ul class="space-y-2">
                        @foreach ($project->tasks as $task)
                            <li class="bg-white p-3 rounded shadow flex justify-between">
                                <span class="{{ $task->is_completed ? 'line-through text-gray-500' : '' }}">
                                    {{ $task->name }}
                                </span>
                                <span class="text-sm text-gray-400">
                                    {{ $task->is_completed ? '✅' : '❌' }}
                                </span>
                            </li>
                        @endforeach
                        @if($project->tasks->isEmpty())
                            <li class="text-gray-400 italic">Belum ada tugas</li>
                        @endif
                    </ul>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
