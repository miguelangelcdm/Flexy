<?php

namespace App\Http\Controllers;

use App\Models\Data;
use Carbon\Carbon;
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

        $data = Data::create([
            'ph' => $request->ph,
            'temperatura' => $request->temperatura,
            'conductividad' => $request->conductividad,
            'oxigeno_disuelto' => $request->oxigeno_disuelto,
            'device_id' => 1,
        ]);
        return "Datos registrados correctamente ";
    }
}
