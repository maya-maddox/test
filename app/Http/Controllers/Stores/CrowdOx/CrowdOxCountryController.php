<?php

namespace App\Http\Controllers\Stores\CrowdOx;

use App\CrowdOxCountry;
use App\Http\Controllers\Controller;
use App\Ingestors\CrowdOx\CrowdOxCountryIngestor;
use Illuminate\Http\Request;

class CrowdOxCountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('stores.crowdox.countries.index', ["crowdox_countries" => CrowdOxCountry::all()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CrowdOxCountry  $crowdOxCountry
     * @return \Illuminate\Http\Response
     */
    public function show(CrowdOxCountry $crowdOxCountry)
    {
        //
    }


    public function import()
    {
        $ingestor = new CrowdOxCountryIngestor();
        $ingestor->ingest();

        return redirect()->back();
    }
}
