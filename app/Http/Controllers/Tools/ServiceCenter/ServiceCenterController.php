<?php
namespace App\Http\Controllers\Tools\ServiceCenter;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tools\ServiceCenter\NewServiceCenterRequest;
use App\Models\ServiceCenter;
use Illuminate\Support\Facades\Auth;

class ServiceCenterController extends Controller
{

    public function index(ServiceCenter $service_center = null) {
        return view('tools.service-center.index', ["service_centers" => ServiceCenter::all(), "service_center" => $service_center]);
    }

    public function select(ServiceCenter $service_center)
    {
        $service_center->selectUserPreference();
        return redirect(route('tools.servicecenter.index', $service_center));
    }


    public function create() {
        return view('tools.service-center.create');
    }

    public function store(NewServiceCenterRequest $request)
    {
        $service_center = ServiceCenter::create($request->all());
        return redirect(route('tools.servicecenter.index'));
    }

    public function returnsLog() {
        $service_centers = ServiceCenter::all();
        foreach ($service_centers as $service_center)
        {
            if ($service_center->isUserPreference()) {
                return redirect(route('tools.servicecenter.returnslog.index', [$service_center->id]));
            }
        }
        //no preference, redirect to selection
        return redirect(route('tools.servicecenter.index'));
    }
}