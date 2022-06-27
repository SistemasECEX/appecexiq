<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTipoDeUsuarioRequest;
use App\Http\Requests\UpdateTipoDeUsuarioRequest;
use App\Models\TipoDeUsuario;

class TipoDeUsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreTipoDeUsuarioRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTipoDeUsuarioRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TipoDeUsuario  $tipoDeUsuario
     * @return \Illuminate\Http\Response
     */
    public function show(TipoDeUsuario $tipoDeUsuario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TipoDeUsuario  $tipoDeUsuario
     * @return \Illuminate\Http\Response
     */
    public function edit(TipoDeUsuario $tipoDeUsuario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTipoDeUsuarioRequest  $request
     * @param  \App\Models\TipoDeUsuario  $tipoDeUsuario
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTipoDeUsuarioRequest $request, TipoDeUsuario $tipoDeUsuario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TipoDeUsuario  $tipoDeUsuario
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipoDeUsuario $tipoDeUsuario)
    {
        //
    }
}
