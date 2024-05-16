<?php
namespace App\Http\Controllers\Api;

use App\Models\Returns;
use App\Models\ServiceCenter;
use App\Models\Sku;
use App\Models\SkuType;

class SkuTypeController
{

    public function index()
    {
        return SkuType::all()->load('returnItemDiagnoses');
    }
}