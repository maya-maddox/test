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
        return Sku::withCount('returnItems')->orderByDesc('return_items_count')->limit(5)->get();
    }
}