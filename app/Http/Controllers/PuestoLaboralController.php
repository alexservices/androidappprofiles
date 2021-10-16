<?php

namespace App\Http\Controllers;

use App\Models\Puesto_Laboral;
use Illuminate\Http\Request;
use App\Models\User;

class PuestoLaboralController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $puestos = Puesto_Laboral::puesto_usuario()
        ->simplepaginate(2);
        return view ('profiles.index', compact('puestos'))
        ; 

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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Puesto_Laboral  $puesto_Laboral
     * @return \Illuminate\Http\Response
     */
    public function show(Puesto_Laboral $puesto_Laboral)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Puesto_Laboral  $puesto_Laboral
     * @return \Illuminate\Http\Response
     */
    public function edit(Puesto_Laboral $puesto_Laboral)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Puesto_Laboral  $puesto_Laboral
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Puesto_Laboral $puesto_Laboral)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Puesto_Laboral  $puesto_Laboral
     * @return \Illuminate\Http\Response
     */
    public function destroy(Puesto_Laboral $puesto_Laboral)
    {
        //
    }
}
