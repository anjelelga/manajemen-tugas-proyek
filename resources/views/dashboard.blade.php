<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            📊 Dashboard
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 text-green-700 bg-green-100 p-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Statistik Card --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <!-- Total Proyek -->
                <div class="bg-white p-6 rounded shadow text-center">
                    <div class="text-blue-500 mb-2 text-3xl">📁</div>
                    <h3 class="text-lg font-semibold text-gray-700">Total Project</h3>
                    <p class="text-3xl font-bold text-blue-600 mt-2">{{ $projectsCount }}</p>
                </div>

                <!-- Total Tugas -->
                <div class="bg-white p-6 rounded shadow text-center">
                    <div class="text-indigo-500 mb-2 text-3xl">📝</div>
                    <h3 class="text-lg font-semibold text-gray-700">Total Tasks</h3>
                    <p class="text-3xl font-bold text-indigo-600 mt-2">{{ $tasksCount }}</p>
                </div>

                <!-- Tugas Selesai -->
                <div class="bg-white p-6 rounded shadow text-center">
                    <div class="text-green-500 mb-2 text-3xl">✅</div>
                    <h3 class="text-lg font-semibold text-gray-700">Done</h3>
                    <p class="text-3xl font-bold text-green-600 mt-2">{{ $completedTasks }}</p>
                </div>
            </div>

            <!-- Grafik Progress -->
            <div class="bg-white p-4 rounded shadow-sm mb-3 mt-1">
                <h3 class="text-base font-semibold text-gray-400 mb-1">📈 All Progress</h3>

                <div class="flex justify-center">
                    <canvas id="progressChart" class="w-full max-w-[150px]" height="40"></canvas>
                </div>
            </div>

            {{-- Chart.js Script --}}
            <script>
                const ctx = document.getElementById('progressChart').getContext('2d');
                new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: ['Selesai', 'Belum'],
                        datasets: [{
                            data: [{{ $completedTasks }}, {{ $tasksCount - $completedTasks }}],
                            backgroundColor: ['#16a34a', '#d1d5db'],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        aspectRatio: 2,
                        cutout: '50%',
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: {
                                    boxWidth: 10,
                                    font: {
                                        size: 13
                                    }
                                }
                            }
                        }
                    }
                });
            </script>
        </div>
    </div>
</x-app-layout>
