<?php

namespace App\Http\Controllers;

use App\Models\Data;
use App\Models\Alert;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class ServiceController extends Controller
{
    private $expectedValues;

    public function __construct()
    {
        $this->setExpectedValues();
    }

    private function setExpectedValues()
    {
        $this->expectedValues = [
            'min' => [
                'ph' => 6.5,
                'oxigeno_disuelto' => 4, // DO (Oxígeno disuelto) en mg/L
                'conductividad' => 2000, // en uS/cm
                'temperatura' => 17 // delta en °C
            ],
            'max' => [
                'ph' => 8.4,
                'oxigeno_disuelto' => 5, // DO (Oxígeno disuelto) en mg/L
                'conductividad' => 3000, // en uS/cm
                'temperatura' => 23 // delta en °C
            ]
        ];
    }
    
    private function checkAlerts($observedValues){
        // Verificar pH
        if ($observedValues['ph'] < $this->expectedValues['min']['ph'] || $observedValues['ph'] > $this->expectedValues['max']['ph']) {
            Alert::create([
                'parameter' => 'pH',
                'observed_value' => $observedValues['ph'],               
                'deviation' => $observedValues['ph'] < $this->expectedValues['min']['ph'] ? $this->expectedValues['min']['ph'] - $observedValues['ph'] : $observedValues['ph'] - $this->expectedValues['max']['ph'],
                'message' => 'El valor de pH está fuera del rango permitido.',
                
            ]);
        }
        
        //return $observedValues['ph'].' minimo'.$this->expectedValues['min']['ph'].' maximo'.$this->expectedValues['max']['ph'];

        // Verificar oxigeno_disuelto (Oxígeno disuelto)
        if ($observedValues['oxigeno_disuelto'] < $this->expectedValues['min']['oxigeno_disuelto']) {
            Alert::create([
                'parameter' => 'oxigeno_disuelto',
                'observed_value' => $observedValues['oxigeno_disuelto'],            
                'deviation' => $this->expectedValues['min']['oxigeno_disuelto'] - $observedValues['oxigeno_disuelto'],
                'message' => 'El valor de oxigeno_disuelto está fuera del rango permitioxigeno_disuelto.',
        
            ]);
        }

        // Verificar Conductividad
        if ($observedValues['conductividad'] < $this->expectedValues['min']['conductividad'] || $observedValues['conductividad'] > $this->expectedValues['max']['conductividad']) {
            Alert::create([
                'parameter' => 'Conductividad',
                'observed_value' => $observedValues['conductividad'],                
                'deviation' => $observedValues['conductividad'] < $this->expectedValues['min']['conductividad'] ? $this->expectedValues['min']['conductividad'] - $observedValues['conductividad'] : $observedValues['conductividad'] - $this->expectedValues['max']['conductividad'],
                'message' => 'El valor de Conductividad está fuera del rango permitido.',
        
            ]);
        }

        // Verificar Temperatura
        if ($observedValues['temperatura'] < $this->expectedValues['min']['temperatura'] || $observedValues['temperatura'] > $this->expectedValues['max']['temperatura']) {
            Alert::create([
                'parameter' => 'Temperatura',
                'observed_value' => $observedValues['temperatura'],            
                'deviation' => $observedValues['temperatura'] < $this->expectedValues['min']['temperatura'] ? $this->expectedValues['min']['temperatura'] - $observedValues['temperatura'] : $observedValues['temperatura'] - $this->expectedValues['max']['temperatura'],
                'message' => 'El valor de Temperatura está fuera del rango permitido.',
        
            ]);
        }
    }

    public function index(){
        return view('mqtt.index');
        //return $this->expectedValue;
    }

    public function save(Request $request)
    { 
        $observedValues = $request->all(); // Supongamos que recibes los valores observados desde la solicitud

        $this->checkAlerts($observedValues);

        $data = Data::create([
            'ph' => $request->ph,
            'temperatura' => $request->temperatura,
            'conductividad' => $request->conductividad,
            'oxigeno_disuelto' => $request->oxigeno_disuelto,
            'device_id' => 1,
        ]);
        
        return "Datos registrados correctamente";


    }
}
