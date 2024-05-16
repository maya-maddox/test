<?php
namespace App\Http\Controllers\Tools\ServiceCenter\ReturnsLog;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tools\ServiceCenter\ReturnsLog\NewServiceCenterReturnsLogCheckInRequest;
use App\Models\Returns;
use App\Models\ServiceCenter;
use Illuminate\Support\Facades\Auth;

class CheckInController extends Controller
{
    public function create(ServiceCenter $service_center) 
    {
        return view('tools.service-center.returns-log.check-in', [
            "service_center" => $service_center, 
            "return_reason_options" => config('servicecenter.returnslog.return_reasons')]);
    }

    public function store(NewServiceCenterReturnsLogCheckInRequest $request, ServiceCenter $service_center) {
        $return = Returns::Create(array_merge([
            "service_center_id" => $service_center->id],
            $request->input())
        );
        if ($request->input('redirect-to') == "processing") {
            return redirect(route('tools.servicecenter.returnslog.edit', ["service_center" => $service_center->id, "return" => $return->id]));
        }
        return redirect(route('tools.servicecenter.returnslog.index', $service_center->id));
    }
}