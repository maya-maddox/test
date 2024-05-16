<?php

namespace App\Http\Controllers\Stores\CrowdOx;

use App\CrowdOxProductVariation;
use App\Http\Controllers\Controller;
use App\Ingestors\CrowdOx\CrowdOxProductVariationIngestor;
use Illuminate\Http\Request;

class CrowdOxProductVariationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('stores.crowdox.product-variations.index', ["crowdox_product_variations" => CrowdOxProductVariation::all()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CrowdOxProductVariation  $crowdOxProductVariation
     * @return \Illuminate\Http\Response
     */
    public function show(CrowdOxProductVariation $crowdOxProductVariation)
    {
        //
    }


    public function import()
    {
        $ingestor = new CrowdOxProductVariationIngestor();
        $ingestor->ingest();

        return redirect()->back();
    }
}
