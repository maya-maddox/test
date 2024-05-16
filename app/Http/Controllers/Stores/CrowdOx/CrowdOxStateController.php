<?php

namespace App\Http\Controllers\Stores\CrowdOx;

use App\CrowdOxState;
use App\Http\Controllers\Controller;
use App\Ingestors\CrowdOx\CrowdOxStateIngestor;
use Illuminate\Http\Request;

class CrowdOxStateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('stores.crowdox.states.index', ["crowdox_states" => CrowdOxState::all()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CrowdOxState  $crowdOxState
     * @return \Illuminate\Http\Response
     */
    public function show(CrowdOxState $crowdOxState)
    {
        //
    }


    public function import()
    {
        $ingestor = new CrowdOxStateIngestor();
        $ingestor->ingest();

        return redirect()->back();
    }
}
