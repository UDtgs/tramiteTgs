<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PeticionesController extends Controller
{
    public function index(){
        $data=['title'=>'Simulador Tramites'];
        return view('index')->with($data);
    }
}
