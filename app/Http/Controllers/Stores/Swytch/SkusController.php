<?php

namespace App\Http\Controllers\Stores\Swytch;

use App\Http\Controllers\Controller;
use App\Ingestors\GoogleSheets\SkusIngestor;
use App\Models\Sku;

class SkusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('stores.swytch.skus.index', ["skus" => Sku::paginate(50)]);
    }


    public function import()
    {
        $ingestor = new SkusIngestor();
        $ingestor->ingest();

        return redirect()->back();
    }

}
