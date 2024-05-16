<?php

namespace App\Http\Controllers\Stores\CrowdOx;

use App\CrowdOxProduct;
use App\Http\Controllers\Controller;
use App\Ingestors\CrowdOx\CrowdOxProductIngestor;
use Illuminate\Http\Request;

class CrowdOxProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('stores.crowdox.products.index', ["crowdox_products" => CrowdOxProduct::all()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CrowdOxProduct  $crowdOxProduct
     * @return \Illuminate\Http\Response
     */
    public function show(CrowdOxProduct $crowdOxProduct)
    {
        //
    }


    public function import()
    {
        $ingestor = new CrowdOxProductIngestor();
        $ingestor->ingest();

        return redirect()->back();
    }
}
