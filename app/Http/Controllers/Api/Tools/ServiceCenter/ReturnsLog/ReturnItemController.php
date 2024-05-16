<?php
namespace App\Http\Controllers\Api\Tools\ServiceCenter\ReturnsLog;

use App\Http\Requests\Tools\ServiceCenter\ReturnsLog\NewServiceCenterReturnLogReturnItemRequest;
use App\Models\ReturnItem;
use App\Models\Returns;
use App\Models\ServiceCenter;

class ReturnItemController
{

    public function index(ServiceCenter $service_center, Returns $return)
    {
        return $return->returnItems->load('sku');
    }

    public function store(NewServiceCenterReturnLogReturnItemRequest $request, ServiceCenter $service_center, Returns $return)
    {
        return $return->returnItems()->create($request->input());
    }

    public function update(NewServiceCenterReturnLogReturnItemRequest $request, ServiceCenter $service_center, Returns $return, ReturnItem $returnitem)
    {
        return $returnitem->update($request->input());
    }

    public function destroy(ServiceCenter $service_center, Returns $return, ReturnItem $returnitem)
    {
        $returnitem->delete();
        return;
    }
}