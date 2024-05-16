<?php

namespace App\Http\Controllers\Stores\CrowdOx;

use App\CrowdOxOrderTransaction;
use App\Http\Controllers\Controller;
use App\Ingestors\CrowdOx\CrowdOxOrderTransactionIngestor;
use Illuminate\Http\Request;

class CrowdOxOrderTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('stores.crowdox.order-transactions.index', ["crowdox_order_transactions" => CrowdOxOrderTransaction::paginate(50)]);
    }


    public function import()
    {
        $ingestor = new CrowdOxOrderTransactionIngestor();
        $ingestor->ingest();

        return redirect()->back();
    }
}
