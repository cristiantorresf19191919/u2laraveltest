<?php

namespace App\Http\Controllers;

use App\Tarea;
use Illuminate\Http\Request;

class TareasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Tarea::where('user_id',auth()->id())->get();
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
    public function store(Request $request)
    {
        $tarea = new Tarea();
        $reglas = [
            'name' => 'required|unique:tareas,name',
            'description' => 'required|unique:tareas,description'
        ];
        if ( $this->validadorEntrada ($request, $reglas)){
            return  $this->validadorEntrada ($request, $reglas);
        }
        $tarea->name = $request->name;
        $tarea->description = $request->description;
        $tarea->user_id = auth()->id();

    if ($tarea->save()){
        return $tarea;
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $tarea = Tarea::find($id);
        $reglas = [
            'name' => 'required|unique:tareas,name',
            'description' => 'required|unique:tareas,description'

        ];
        if ( $this->validadorEntrada ($request, $reglas)){
            return  $this->validadorEntrada ($request, $reglas);
        }
        $tarea->name = $request->name;
        $tarea->description = $request->description;
        $tarea->save();
        return $tarea;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tarea = Tarea::find($id);
        $tarea->delete();
    }
}
