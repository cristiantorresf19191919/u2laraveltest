<?php

namespace App\Http\Controllers;

use App\Pasatiempo;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = User::with('pasatiempos')->get();

        return $user;



    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $usuario = User::find( $id);
        if ($usuario){
            $asociativoArreglo = [
                "name" => $request['name'],
                "username" => $request['username'],
                "city" => $request['city']
            ];
            $usuario =  User::create($asociativoArreglo);
            $usuario->save();
            $usuario->pasatiempos()->save($request['pasatiempos']);
        }
        return $usuario;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->get('name');
        $user->username = $request->get('username');
        $user->city = $request->get('city');
        $user->pasatiempos = $request->get('pasatiempos');
        $user->save();
        return $user;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $pasatiempo_id)
    {
        $usuario = User::find($id);
        if ($usuario){
            $pasatiempo = pasatiempo::find($pasatiempo_id);
            if ($pasatiempo){
                if ($usuario->pasatiempos()->find($pasatiempo_id)){
                    // solo desvincula los estudiantes para que no vote error
                    $usuario->pasatiempos()->detach();
                    // ya desvinculado ahora si borra el curso con el id dado
                    $pasatiempo->delete();
                    $usuario->delete();
                }
            }
        }
    }
}
