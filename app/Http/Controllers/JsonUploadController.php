<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JsonUploadController extends Controller
{
    public function create()
    {
        return view('upload-json');
    }

    public function store(Request $request)
    {
        // Aumentar el límite de memoria para archivos grandes
        ini_set('memory_limit', '1G');
    
        // Validar el archivo cargado
        $request->validate([
            'json_file' => 'required|file|max:25600', // 25 MB
        ]);
    
        // Verificar el tamaño del archivo manualmente
        if ($request->file('json_file')->getSize() > 25 * 1024 * 1024) { // 25 MB
            return back()->withErrors(['json_file' => 'El archivo supera el tamaño máximo permitido de 25 MB.']);
        }
    
        // Verificar que el archivo tenga la extensión .json
        if ($request->file('json_file')->getClientOriginalExtension() !== 'json') {
            return back()->withErrors(['json_file' => 'El archivo debe tener la extensión .json.']);
        }
    
        // Crear la carpeta "public/BG" si no existe
        $directory = public_path('BG');
        if (!file_exists($directory)) {
            mkdir($directory, 0755, true);
        }
    
        // Guardar el archivo en "public/BG" con un nombre único
        $fileName = uniqid() . '.json';
        $request->file('json_file')->move($directory, $fileName);
    
        // Obtener la ruta completa del archivo guardado
        $filePath = $directory . DIRECTORY_SEPARATOR . $fileName;
    
        // Leer y decodificar el contenido del archivo JSON
        $content = json_decode(file_get_contents($filePath), true);

        // dd([
        //     'file_path' => $filePath,
        //     'decoded_content' => $content,
        //     'json_error' => json_last_error(),
        //     'json_error_message' => json_last_error_msg(),
        // ]);
    
        // Validar si el contenido del archivo JSON es válido
        if (json_last_error() !== JSON_ERROR_NONE) {
            return back()->withErrors(['json_file' => 'El archivo JSON no es válido.']);
        }
    
        // Procesar el contenido según sea necesario
        return back()->with('success', 'Archivo JSON subido correctamente.')->with('json_content', $content);
    }    

}