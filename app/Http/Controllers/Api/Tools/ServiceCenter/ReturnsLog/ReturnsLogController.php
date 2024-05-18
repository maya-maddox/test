<?php
namespace App\Http\Controllers\Api\Tools\ServiceCenter\ReturnsLog;

use App\Http\Requests\Tools\ServiceCenter\ReturnsLog\ServiceCenterReturnLogReturnRequest;
use App\Models\Returns;
use App\Models\ServiceCenter;
use App\Models\Sku;

class ReturnsLogController
{

    public function show(ServiceCenter $service_center, Returns $return)
    {
        return $return->load('checkInUser', 'sku', 'returnItems.sku');
    }

    public function update(ServiceCenterReturnLogReturnRequest $request, ServiceCenter $service_center, Returns $return)
    {
        return $return->update($request->input());
    }

    public function destroy(ServiceCenter $service_center, Returns $return)
    {
        $return->delete();
        return;
    }

    public function suggestedSkus(ServiceCenter $service_center, Returns $return)
    {
        $return_sku = $return->sku_name;
        $all_skus = Sku::all();

        $suggested_skus = [];

        foreach ($all_skus as $sku) {
            if (strpos($return_sku, $sku->sku) || $return_sku === $sku->sku) {
                $suggested_skus[] = $sku;
            }
        }

        return $suggested_skus;
    }
}