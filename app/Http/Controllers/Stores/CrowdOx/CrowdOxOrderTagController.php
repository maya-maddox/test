<?php

namespace App\Http\Controllers\Stores\CrowdOx;

use App\CrowdOxOrderTag;
use App\Http\Controllers\Controller;
use App\Ingestors\CrowdOx\CrowdOxOrderTagIngestor;
use Illuminate\Http\Request;

class CrowdOxOrderTagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('stores.crowdox.order-tags.index', ["crowdox_order_tags" => CrowdOxOrderTag::all()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CrowdOxOrderTag  $crowdOxOrderTag
     * @return \Illuminate\Http\Response
     */
    public function show(CrowdOxOrderTag $crowdOxOrderTag)
    {
        //
    }


    public function import()
    {
        $ingestor = new CrowdOxOrderTagIngestor();
        $ingestor->ingest();

        return redirect()->back();
    }
}
