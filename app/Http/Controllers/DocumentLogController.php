<?php

namespace App\Http\Controllers;

use App\Models\document_log;
use App\Http\Requests\Storedocument_logRequest;
use App\Http\Requests\Updatedocument_logRequest;

class DocumentLogController extends Controller
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
     * @param  \App\Http\Requests\Storedocument_logRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storedocument_logRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\document_log  $document_log
     * @return \Illuminate\Http\Response
     */
    public function show(document_log $document_log)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\document_log  $document_log
     * @return \Illuminate\Http\Response
     */
    public function edit(document_log $document_log)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updatedocument_logRequest  $request
     * @param  \App\Models\document_log  $document_log
     * @return \Illuminate\Http\Response
     */
    public function update(Updatedocument_logRequest $request, document_log $document_log)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\document_log  $document_log
     * @return \Illuminate\Http\Response
     */
    public function destroy(document_log $document_log)
    {
        //
    }
}
