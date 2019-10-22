<?php

namespace App\Http\Controllers;

use App\Pasatiempo;
use Illuminate\Http\Request;

class PasatiempoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Pasatiempo::where('user_id',auth()->id())->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pasatiempo = new Pasatiempo();

            $pasatiempo->name = $request->name;
            $pasatiempo->description = $request->description;
            $pasatiempo->user_id = auth()->id();

        if ($pasatiempo->save()){
            return $pasatiempo;
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
        $pasatiempo = Pasatiempo::find($id);
        $pasatiempo->name = $request->name;
        $pasatiempo->description = $request->description;
        $pasatiempo->save();
        return $pasatiempo;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pasatiempo = Pasatiempo::find($id);
        $pasatiempo->delete();
    }
}
