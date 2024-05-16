<?php

namespace App\Http\Controllers\Stores\CrowdOx;

use App\CrowdOxOrderLine;
use App\Http\Controllers\Controller;
use App\Ingestors\CrowdOx\CrowdOxOrderLineIngestor;
use App\Jobs\Ingestors\CrowdOx\IngestCrowdOxOrderLines;
use Illuminate\Http\Request;

class CrowdOxOrderLineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('stores.crowdox.order-lines.index', ["crowdox_order_lines" => CrowdOxOrderLine::paginate(50)]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CrowdOxOrderLine  $crowdOxOrderLine
     * @return \Illuminate\Http\Response
     */
    public function show(CrowdOxOrderLine $crowdOxOrderLine)
    {
        //
    }


    public function import(Request $request)
    {
        $ingestor = new CrowdOxOrderLineIngestor($request->get('crowd_ox_order_line_id', null));
        $ingestor->ingest();

        return redirect()->back();
    }


    /**
     * Import order lines via job
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function importDispatch(Request $request) {
        IngestCrowdOxOrderLines::dispatch($request->get('page_start', 1), null); //dispatch job

        return redirect()->back();
    }
}
