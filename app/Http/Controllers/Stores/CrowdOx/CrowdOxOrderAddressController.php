<?php

namespace App\Http\Controllers\Stores\CrowdOx;

use App\CrowdOxOrderAddress;
use App\Http\Controllers\Controller;
use App\Ingestors\CrowdOx\CrowdOxOrderAddressIngestor;
use App\Jobs\Ingestors\CrowdOx\IngestCrowdOxOrderAddresses;
use Illuminate\Http\Request;

class CrowdOxOrderAddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('stores.crowdox.order-addresses.index', ["crowdox_order_addresses" => CrowdOxOrderAddress::all()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CrowdOxOrderAddress  $crowdOxOrderAddress
     * @return \Illuminate\Http\Response
     */
    public function show(CrowdOxOrderAddress $crowdOxOrderAddress)
    {
        //
    }


    public function import()
    {
        $ingestor = new CrowdOxOrderAddressIngestor();
        $ingestor->ingest();

        return redirect()->back();
    }

    /**
     * Import order addresses via job
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function importDispatch(Request $request) {
        IngestCrowdOxOrderAddresses::dispatch($request->get('page_start', 1), null); //dispatch job

        return redirect()->back();
    }
}
