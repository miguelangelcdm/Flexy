<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class ServiceController extends Controller
{
    //
    public function index(){
        return view('mqtt.index');
    }

    public function save(Request $request){        
        Log::info('Datos recibidos:', $request->all());        
        // Ruta del archivo JSON (puedes cambiar la ruta según tus necesidades)
        $filePath = storage_path('app/public/data.json');

        // Datos que deseas añadir al archivo JSON
        $newData = [
            "Dispositivo" => $request->dispositivo,
            "Id" => $request->id,
            "Timestamp" => $request->timestamp,
            "Data" => [
                "Ph"=> $request->ph,
                "Temperatura" => $request->temperatura,
                "Conductividad" => $request->conductividad,
                "OxigenoDisuelto" => $request->oxigeno_disuelto,
            ]
        ];

        // Leer el contenido existente del archivo JSON
        if (File::exists($filePath)) {
            $jsonData = File::get($filePath);
            $dataArray = json_decode($jsonData, true);

            // Asegurarse de que el contenido existente sea un array
            if (!is_array($dataArray)) {
                $dataArray = [];
            }
        } else {
            // Si el archivo no existe, crear un nuevo array
            $dataArray = [];
        }

        // Añadir los nuevos datos al array
        $dataArray[] = $newData;

        // Convertir los datos a formato JSON
        $jsonData = json_encode($dataArray, JSON_PRETTY_PRINT);

        // Escribir los datos en el archivo JSON
        if (File::put($filePath, $jsonData)) {
            return response()->json(['success' => 'Datos añadidos al archivo JSON con éxito.']);
        } else {
            return response()->json(['error' => 'No se pudo escribir en el archivo JSON.']);
        }

        //return view('mqtt.index');
    }
}
