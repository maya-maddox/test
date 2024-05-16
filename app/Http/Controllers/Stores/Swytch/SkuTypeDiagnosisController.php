<?php

namespace App\Http\Controllers\Stores\Swytch;

use App\Http\Controllers\Controller;
use App\Http\Requests\Stores\SwytchSkuTypeUpdateAssignmentsRequest;
use App\Ingestors\GoogleSheets\SkusIngestor;
use App\Models\ReturnItemDiagnosis;
use App\Models\Sku;
use App\Models\SkuType;
use Illuminate\Http\Request;

class SkuTypeDiagnosisController extends Controller
{

    public function store(Request $request, SkuType $skuType)
    {
        $request->validate(["diagnosis" => "required|string"]);

        ReturnItemDiagnosis::create([
            "sku_type_id" => $skuType->id,
            "diagnosis" => $request->input('diagnosis')
        ]);

        return back();
    }
}
