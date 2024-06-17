<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Data;
class DataController extends Controller
{
    

    public function getAll() 
    {
        $data = Data::select('ph', 'temperatura', 'oxigeno_disuelto', 'conductividad')->orderBy('created_at')->get()->take(-10);

        $array = [
            'ph' => $data->pluck('ph')->all(),
            'temperatura' => $data->pluck('temperatura')->all(),
            'oxigenoDisuelto' => $data->pluck('oxigeno_disuelto')->all(),
            'conductividad' => $data->pluck('conductividad')->all(),
        ];
    
        $jsonData = json_encode($array);
        return $jsonData;
    }



}

