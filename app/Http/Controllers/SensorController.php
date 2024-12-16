<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Carbon\Carbon;
class SensorController extends Controller
{
    // public function index(Request $request)
    // {
    //     // Ruta al archivo JSON dentro de la carpeta BG
    //     $jsonFile = public_path('BG/data.json');
    
    //     // Leer el contenido del archivo JSON
    //     $jsonData = file_get_contents($jsonFile);
    
    //     // Decodificar el contenido JSON
    //     $data = json_decode($jsonData, true);
    
    //     if (empty($data)) {
    //         return redirect()->route('dashboard')->withErrors(['error' => 'Datos JSON vacíos o no encontrados']);
    //     }
    
    //     $startDate = $request->input('start_date');
    //     $endDate = $request->input('end_date');
    //     $startTime = $request->input('start_time') ?: '00:00:00'; // Valor predeterminado si no se selecciona hora
    //     $endTime = $request->input('end_time') ?: '23:59:59';     // Valor predeterminado si no se selecciona hora
    
    //     $startDateTime = $startDate ? Carbon::parse("$startDate $startTime") : null;
    //     $endDateTime = $endDate ? Carbon::parse("$endDate $endTime") : null;
    
    //     $sensorData = [];
    //     $dateRanges = [];
    
    //     foreach ($data as $item) {
    //         if (isset($item['data']['sensorMessages']) && is_array($item['data']['sensorMessages'])) {
    //             foreach ($item['data']['sensorMessages'] as $sensor) {
    //                 $messageDate = Carbon::parse($sensor['messageDate']);
    
    //                 // Verificar si el mensaje está dentro del rango seleccionado
    //                 if ($startDateTime && $endDateTime && !$messageDate->between($startDateTime, $endDateTime)) {
    //                     continue;
    //                 }
    
    //                 // Desglosar los valores de 'dataValue' (separados por '|')
    //                 $dataValues = explode('|', $sensor['dataValue']);
    
    //                 // Agregar los datos de temperatura y humedad junto con la fecha
    //                 $sensorData[$sensor['sensorName']][] = [
    //                     'humidity' => (float) $dataValues[0],
    //                     'temperature' => (float) $dataValues[1],
    //                     'date' => $messageDate->toDateTimeString(), // Guardamos la fecha aquí
    //                 ];
    
    //                 // Mantener el rango de fechas por sensor
    //                 $dateRanges[$sensor['sensorName']][] = $messageDate->toDateTimeString();
    //             }
    //         }
    //     }
    
    //     // Calcular las estadísticas y preparar los datos para los gráficos
    //     $statistics = [];
    //     $temperatureData = [];
    //     $humidityData = [];
    //     $allDates = [];
    
    //     foreach ($sensorData as $sensorName => $values) {
    //         $statistics[$sensorName] = [
    //             'humidity' => $this->calculateStats(array_column($values, 'humidity')),
    //             'temperature' => $this->calculateStats(array_column($values, 'temperature')),
    //             'date_range' => $this->calculateDateRange($dateRanges[$sensorName] ?? []),
    //         ];
    
    //         // Preparar los datos para los gráficos
    //         $temperatureData[$sensorName] = array_column($values, 'temperature');
    //         $humidityData[$sensorName] = array_column($values, 'humidity');
    
    //         // Recolectar todas las fechas (sin duplicados)
    //         $allDates = array_merge($allDates, array_column($values, 'date'));
    //     }
    
    //     // Eliminar duplicados de las fechas
    //     $allDates = array_unique($allDates);
    //     sort($allDates); // Ordenamos las fechas
    
    //     // Pasar los datos a la vista
    //     return view('sensors', compact('statistics', 'startDate', 'endDate', 'startTime', 'endTime', 'temperatureData', 'humidityData', 'allDates'));
    // }
    public function index(Request $request)
    {
        // Ruta al archivo JSON dentro de la carpeta BG
        $jsonFile = public_path('BG/data.json');
    
        // Leer el contenido del archivo JSON
        $jsonData = file_get_contents($jsonFile);
    
        // Decodificar el contenido JSON
        $data = json_decode($jsonData, true);
    
        if (empty($data)) {
            return redirect()->route('dashboard')->withErrors(['error' => 'Datos JSON vacíos o no encontrados']);
        }
    
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $startTime = $request->input('start_time') ?: '00:00:00'; // Valor predeterminado si no se selecciona hora
        $endTime = $request->input('end_time') ?: '23:59:59';     // Valor predeterminado si no se selecciona hora
        

    
        $startDateTime = $startDate ? Carbon::parse("$startDate $startTime") : null;
        $endDateTime = $endDate ? Carbon::parse("$endDate $endTime") : null;
    
        $sensorData = [];
        $dateRanges = [];
        $allDates = [];  // Para almacenar todas las fechas
        $temperatureDataGraph = []; // Para todas las temperaturas
        $humidityDataGraph = [];    // Para todas las humedades
    
        // Recolectamos todos los datos
        foreach ($data as $item) {
            if (isset($item['data']['sensorMessages']) && is_array($item['data']['sensorMessages'])) {
                foreach ($item['data']['sensorMessages'] as $sensor) {
                    $messageDate = Carbon::parse($sensor['messageDate']);
    
                    // Verificar si el mensaje está dentro del rango seleccionado
                    if ($startDateTime && $endDateTime && !$messageDate->between($startDateTime, $endDateTime)) {
                        continue;
                    }
    
                    // Desglosar los valores de 'dataValue' (separados por '|')
                    $dataValues = explode('|', $sensor['dataValue']);
    
                    // Agregar los valores de temperatura y humedad para el gráfico global
                    $temperatureDataGraph[] = (float) $dataValues[1];  // Temperatura
                    $humidityDataGraph[] = (float) $dataValues[0];      // Humedad
                    $allDates[] = $messageDate->toDateTimeString();     // Fecha
    
                    // Agregar los datos de temperatura y humedad junto con la fecha para cada sensor
                    $sensorData[$sensor['sensorName']][] = [
                        'humidity' => (float) $dataValues[0],
                        'temperature' => (float) $dataValues[1],
                        'date' => $messageDate->toDateTimeString(), // Guardamos la fecha aquí
                    ];
    
                    // Mantener el rango de fechas por sensor
                    $dateRanges[$sensor['sensorName']][] = $messageDate->toDateTimeString();
                }
            }
        }
    
        // Eliminar duplicados de las fechas globales
        $allDates = array_unique($allDates);
        sort($allDates); // Ordenamos las fechas
    
        // Preparar los datos para los gráficos
        $statistics = [];
        $temperatureData = [];
        $humidityData = [];
    
        foreach ($sensorData as $sensorName => $values) {
            $statistics[$sensorName] = [
                'humidity' => $this->calculateStats(array_column($values, 'humidity')),
                'temperature' => $this->calculateStats(array_column($values, 'temperature')),
                'date_range' => $this->calculateDateRange($dateRanges[$sensorName] ?? []),
            ];
    
            // Preparar los datos para los gráficos por sensor
            $temperatureData[$sensorName] = array_column($values, 'temperature');
            $humidityData[$sensorName] = array_column($values, 'humidity');
        }
    
        // Pasar los datos a la vista para graficarlos
        return view('sensors', compact('statistics', 'startDate', 'endDate', 'startTime', 'endTime', 'temperatureData', 'humidityData', 'allDates', 'temperatureDataGraph', 'humidityDataGraph'));
    }
    
    private function calculateStats(array $values)
    {
        if (empty($values)) {
            return [
                'max' => null,
                'min' => null,
                'average' => null,
            ];
        }
    
        return [
            'max' => max($values),
            'min' => min($values),
            'average' => array_sum($values) / count($values),
        ];
    }
    
    /**
     * Calcular el rango de fechas para un conjunto de fechas.
     */
    private function calculateDateRange(array $dates)
    {
        if (empty($dates)) {
            return [
                'start' => null,
                'end' => null,
            ];
        }
    
        // Ordenar las fechas para obtener la más antigua y la más reciente
        sort($dates);
    
        return [
            'start' => $dates[0],              // Primera fecha (más antigua)
            'end' => $dates[count($dates) - 1] // Última fecha (más reciente)
        ];
    }
    
}

