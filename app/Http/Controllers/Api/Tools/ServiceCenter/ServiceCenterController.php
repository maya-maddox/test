<?php
namespace App\Http\Controllers\Api\Tools\ServiceCenter;

use App\Models\ServiceCenter;
use App\User;
use Illuminate\Support\Facades\Auth;
use stdClass;

class ServiceCenterController
{

    public function users() {
        $array = [];
        $options = User::all()->loadCount('serviceCenterReturnsCheckerIn', 'serviceCenterReturnsTechnician');
        foreach ($options as $option) {
            $object = new stdClass();
            $object->value = $option->id;
            $object->text = $option->name;
            $object->self = $option->id == Auth::id();
            $object->serviceCenterCount = $option->service_center_returns_checker_in_count + $option->service_center_returns_technician_in_count;
            $array[] = $object;
        }
        usort($array, function ($a, $b) { //https://stackoverflow.com/a/2477524
            return $b->serviceCenterCount <=> $a->serviceCenterCount;
        });
        return $array;
    }
}