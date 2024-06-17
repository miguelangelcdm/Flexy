<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Data;
class DataController extends Controller
{

    public function getAll() {
        // Obtener todos los registros, pero solo seleccionar las columnas necesarias
        // $data = Data::select('ph', 'temperatura', 'oxigeno_disuelto', 'conductividad')
        //     ->latest()
        //     ->orderBy('created_at')
        //     ->take(10)
        //     ->get();
        $data = Data::select('ph', 'temperatura', 'oxigeno_disuelto', 'conductividad')->orderBy('created_at')
        ->get()->take(-10);
       
        // Extraer los valores de cada columna en arreglos separados
        $array = [
            'ph' => $data->pluck('ph')->all(),
            'temperatura' => $data->pluck('temperatura')->all(),
            'oxigenoDisuelto' => $data->pluck('oxigeno_disuelto')->all(),
            'conductividad' => $data->pluck('conductividad')->all(),
        ];
    
        $jsonData = json_encode($array);
        return $jsonData;
    }
    
    

    // public function getAll(){
    //     $temp=Data::all();
        
    //     $data=json_encode($temp);
    //     return $data;
    // }
}

