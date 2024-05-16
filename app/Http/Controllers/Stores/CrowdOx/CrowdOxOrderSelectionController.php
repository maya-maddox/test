<?php

namespace App\Http\Controllers\Stores\CrowdOx;

use App\CrowdOxOrderSelection;
use App\Http\Controllers\Controller;
use App\Ingestors\CrowdOx\CrowdOxOrderSelectionIngestor;
use App\Jobs\Ingestors\CrowdOx\IngestCrowdOxOrderSelections;
use Illuminate\Http\Request;

class CrowdOxOrderSelectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('stores.crowdox.order-selections.index', ["crowdox_order_selections" => CrowdOxOrderSelection::all()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CrowdOxOrderSelection  $crowdOxOrderSelection
     * @return \Illuminate\Http\Response
     */
    public function show(CrowdOxOrderSelection $crowdOxOrderSelection)
    {
        //
    }


    public function import()
    {
        $ingestor = new CrowdOxOrderSelectionIngestor();
        $ingestor->ingest();

        return redirect()->back();
    }

    /**
     * Import order selections via job
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function importDispatch(Request $request) {
        IngestCrowdOxOrderSelections::dispatch($request->get('page_start', 1), null); //dispatch job

        return redirect()->back();
    }
}
