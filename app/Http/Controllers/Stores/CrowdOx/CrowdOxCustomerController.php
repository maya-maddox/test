<?php

namespace App\Http\Controllers\Stores\CrowdOx;

use App\CrowdOxCustomer;
use App\Http\Controllers\Controller;
use App\Ingestors\CrowdOx\CrowdOxCustomerIngestor;
use App\Jobs\Ingestors\CrowdOx\IngestCrowdOxCustomers;
use Illuminate\Http\Request;

class CrowdOxCustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('stores.crowdox.customers.index', ["crowdox_customers" => CrowdOxCustomer::paginate(50)]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CrowdOxCustomer  $crowdOxCustomer
     * @return \Illuminate\Http\Response
     */
    public function show(CrowdOxCustomer $crowdOxCustomer)
    {
        //
    }


    public function import()
    {
        $ingestor = new CrowdOxCustomerIngestor();
        $ingestor->ingest();

        return redirect()->back();
    }

    /**
     * Import customers via job
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function importDispatch(Request $request) {
        IngestCrowdOxCustomers::dispatch($request->get('page_start', 1), null); //dispatch job

        return redirect()->back();
    }
}
