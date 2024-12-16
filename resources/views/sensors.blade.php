<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Sensors Statistics') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <!-- Formulario para seleccionar el rango de fechas -->
                    <form method="GET" action="{{ route('sensors.index') }}" class="bg-white shadow rounded-lg p-4 mb-6">
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                            <div>
                                <label for="start_date" class="block text-sm font-medium text-gray-700">Fecha de Inicio</label>
                                <input 
                                    type="date" 
                                    id="start_date" 
                                    name="start_date" 
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" 
                                    value="{{ $startDate }}">
                            </div>
                            <div>
                                <label for="start_time" class="block text-sm font-medium text-gray-700">Hora de Inicio</label>
                                <input 
                                    type="time" 
                                    id="start_time" 
                                    name="start_time" 
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" 
                                    value="{{ $startTime }}">
                            </div>
                            <div>
                                <label for="end_date" class="block text-sm font-medium text-gray-700">Fecha Final</label>
                                <input 
                                    type="date" 
                                    id="end_date" 
                                    name="end_date" 
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" 
                                    value="{{ $endDate }}">
                            </div>
                            <div>
                                <label for="end_time" class="block text-sm font-medium text-gray-700">Hora Final</label>
                                <input 
                                    type="time" 
                                    id="end_time" 
                                    name="end_time" 
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" 
                                    value="{{ $endTime }}">
                            </div>
                            <div class="flex justify-center items-center col-span-1 sm:col-span-2 md:col-span-4">
                                <button 
                                    type="submit" 
                                    class="px-6 py-2 bg-indigo-600 text-white rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Filtrar
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Tabla de Resultados -->
                    <table class="min-w-full table-auto">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 text-left">Sensor Name</th>
                                <th class="px-4 py-2 text-left">Humidity (Max, Min, Avg)</th>
                                <th class="px-4 py-2 text-left">Temperature (Max, Min, Avg)</th>
                                <th class="px-4 py-2 text-left">Date Range</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($statistics as $sensorName => $stats)
                                <tr>
                                    <td class="px-4 py-2">{{ $sensorName }}</td>
                                    <td class="px-4 py-2">{{ $stats['humidity']['max'] }} | {{ $stats['humidity']['min'] }} | {{ number_format($stats['humidity']['average'], 2) }}</td>
                                    <td class="px-4 py-2">{{ $stats['temperature']['max'] }} | {{ $stats['temperature']['min'] }} | {{ number_format($stats['temperature']['average'], 2) }}</td>
                                    <td class="px-4 py-2">
                                        {{ $stats['date_range']['start'] ?? 'N/A' }} to {{ $stats['date_range']['end'] ?? 'N/A' }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-4 py-2 text-center">No data available for the selected date range.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <canvas id="temperatureChart"></canvas>
    <canvas id="humidityChart"></canvas>
    
    <script>
        var ctxTemperature = document.getElementById('temperatureChart').getContext('2d');
        var ctxHumidity = document.getElementById('humidityChart').getContext('2d');
    
        var temperatureData = @json($temperatureDataGraph); // Temperaturas de todos los sensores
        var humidityData = @json($humidityDataGraph);       // Humedades de todos los sensores
        var allDates = @json($allDates);                     // Fechas de todos los sensores
    
        // Crear el gráfico de temperatura
        new Chart(ctxTemperature, {
            type: 'line',
            data: {
                labels: allDates,
                datasets: [{
                    label: 'Temperatura',
                    data: temperatureData,
                    borderColor: 'rgb(255, 99, 132)',
                    fill: false
                }]
            }
        });
    
        // Crear el gráfico de humedad
        new Chart(ctxHumidity, {
            type: 'line',
            data: {
                labels: allDates,
                datasets: [{
                    label: 'Humedad',
                    data: humidityData,
                    borderColor: 'rgb(54, 162, 235)',
                    fill: false
                }]
            }
        });
    </script>

</x-app-layout>