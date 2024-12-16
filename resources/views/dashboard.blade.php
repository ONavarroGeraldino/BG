<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("Bienvenido") }}
                </div>
            </div>
        </div>          
    </div>
  
    {{-- <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Subir archivo JSON') }}
            </h2>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Mensajes de éxito -->
                    @if(session('success'))
                        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                            {{ session('success') }}
                            <pre class="bg-gray-100 p-2 mt-2 rounded">{{ print_r(session('json_content'), true) }}</pre>
                        </div>
                    @endif

                    <!-- Mensajes de error -->
                    @if($errors->any())
                        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Formulario -->
                    <form action="{{ route('upload.json.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label for="json_file" class="block text-sm font-medium text-gray-700">Seleccionar archivo JSON</label>
                            <input type="file" id="json_file" name="json_file" class="mt-1 block w-full text-sm border-gray-300 rounded focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded">Subir</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
{{-- <div class="container mx-auto">
    <h2 class="text-lg font-semibold mb-4">Sensor Data Table</h2>
    <table class="min-w-full divide-y divide-gray-200">
        <thead>
            <tr>
                <th class="px-4 py-2 text-left">Sensor Name</th>
                <th class="px-4 py-2 text-left">Temperature (°C)</th>
                <th class="px-4 py-2 text-left">Humidity (%)</th>
                <th class="px-4 py-2 text-left">Battery Level (%)</th>
                <th class="px-4 py-2 text-left">Message Date</th>
            </tr>
        </thead>
        <tbody>
            @forelse($sensors as $sensor)
                <tr class="border-t">
                    <td class="px-4 py-2">{{ $sensor['sensorName'] }}</td>
                    <td class="px-4 py-2">{{ $sensor['temperature'] }}</td>
                    <td class="px-4 py-2">{{ $sensor['humidity'] }}</td>
                    <td class="px-4 py-2">{{ $sensor['batteryLevel'] }}</td>
                    <td class="px-4 py-2">{{ $sensor['messageDate'] }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-4 py-2 text-center">No data available</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div> --}}

</x-app-layout>
