<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Validator;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function crearRespuestaExitosa($data, $code)
    {
        return response()->json($data=['data'=>$data], $code);
    }

    function validadorEntrada ($request, $reglas){
        $validador = Validator::make($request->all(),$reglas);
        if ($validador->fails()){
            return response()->json(['error'=>$validador->errors()],202);
        }

    }

}
