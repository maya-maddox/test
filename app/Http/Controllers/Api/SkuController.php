<?php
namespace App\Http\Controllers\Api;

use App\Models\Returns;
use App\Models\ServiceCenter;
use App\Models\Sku;

class SkuController
{

    public function index()
    {
        return Sku::all()->load('skuType')->loadCount('returnItems');
    }
}