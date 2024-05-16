<?php

namespace App\Http\Controllers\Stores\Swytch;

use App\Http\Controllers\Controller;
use App\Http\Requests\Stores\SwytchSkuTypeUpdateAssignmentsRequest;
use App\Ingestors\GoogleSheets\SkusIngestor;
use App\Models\Sku;
use App\Models\SkuType;
use Illuminate\Http\Request;

class SkuTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $skuTypes = SkuType::all()->loadCount('skus');
        return view('stores.swytch.sku-type.index', [
            "skuTypes" => $skuTypes,
            "skus" => Sku::all()->sortBy('sku')]);
    }

    public function store(Request $request)
    {
        $request->validate(["type" => "required|string"]);
        SkuType::create($request->input());
        return back();
    }

    public function updateAssignments(SwytchSkuTypeUpdateAssignmentsRequest $request)
    {
        foreach ($request->input('sku_assignments', []) as $sku_assignment)
        {
            Sku::where('id', $sku_assignment['sku_id'])->update(['sku_type_id' => $sku_assignment['sku_type_id']]);
        }
        return back();
    }

    public function show(SkuType $skuType)
    {
        return view('stores.swytch.sku-type.show', [
            "skuType" => $skuType
        ]);
    }
}
