<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Data;
class DataController extends Controller
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

    public function getAll() 
    {
        $data = Data::select('ph', 'temperatura', 'oxigeno_disuelto', 'conductividad')->orderBy('created_at')->get()->take(-10);

        $array = [
            'ph' => $data->pluck('ph')->all(),
            'temperatura' => $data->pluck('temperatura')->all(),
            'oxigenoDisuelto' => $data->pluck('oxigeno_disuelto')->all(),
            'conductividad' => $data->pluck('conductividad')->all(),
            'expextedValues'=>$this->expectedValues,
        ];
    
        $jsonData = json_encode($array);
        return $jsonData;
    }



}

