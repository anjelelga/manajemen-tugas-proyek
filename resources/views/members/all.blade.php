<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            👥 All Team
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            @foreach ($projects as $project)
                <div class="mb-6">
                    <h3 class="text-lg font-bold mb-2">📁 {{ $project->name }}</h3>
                    <ul class="space-y-2">
                        @forelse ($project->members as $member)
                            <li class="bg-white p-3 rounded shadow flex justify-between">
                                <span>👤 {{ $member->name }} ({{ $member->email }})</span>
                            </li>
                        @empty
                            <li class="text-gray-400 italic">Belum ada anggota tim</li>
                        @endforelse
                    </ul>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
