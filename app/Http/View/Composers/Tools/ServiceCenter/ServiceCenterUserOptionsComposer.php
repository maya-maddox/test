<?php

namespace App\Http\View\Composers\Tools\ServiceCenter;

use App\User;
use stdClass;
use Illuminate\View\View;

class ServiceCenterUserOptionsComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $array = [];
        $options = User::all()->loadCount('serviceCenterReturnsCheckerIn', 'serviceCenterReturnsTechnician');
        foreach ($options as $option) {
            $object = new stdClass();
            $object->value = $option->id;
            $object->text = $option->name;
            $object->serviceCenterCount = $option->service_center_returns_checker_in_count + $option->service_center_returns_technician_in_count;
            $array[] = $object;
        }
        usort($array, function ($a, $b) { //https://stackoverflow.com/a/2477524
            return $b->serviceCenterCount <=> $a->serviceCenterCount;
        });
        return $view->with(["user_options" => $array]);
    }
}