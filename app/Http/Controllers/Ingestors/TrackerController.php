<?php

namespace App\Http\Controllers\Ingestors;

use App\Http\Controllers\Controller;
use App\Ingestion;
use Illuminate\Http\Request;

class TrackerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('ingestors.tracker.index', ["ingestions" => Ingestion::paginate(50)]);
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
     * @param  \App\Ingestion  $ingestion
     * @return \Illuminate\Http\Response
     */
    public function show(Ingestion $ingestion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ingestion  $ingestion
     * @return \Illuminate\Http\Response
     */
    public function edit(Ingestion $ingestion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ingestion  $ingestion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ingestion $ingestion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ingestion  $ingestion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ingestion $ingestion)
    {
        //
    }
}
