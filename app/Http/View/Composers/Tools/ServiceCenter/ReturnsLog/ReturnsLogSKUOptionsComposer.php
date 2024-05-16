<?php

namespace App\Http\View\Composers\Tools\ServiceCenter\ReturnsLog;

use App\Models\Sku;
use App\User;
use stdClass;
use Illuminate\View\View;

class ReturnsLogSKUOptionsComposer
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
        $options = Sku::all()->loadCount('returns');
        foreach ($options as $option) {
            $object = new stdClass();
            $object->value = $option->id;
            $object->text = $option->sku;
            $object->returns_count = $option->returns_count;
            $array[] = $object;
        }
        usort($array, function ($a, $b) { //https://stackoverflow.com/a/2477524
            return $b->returns_count <=> $a->returns_count;
        });

        $defaultOption = new stdClass();
        $defaultOption->value = null;
        $defaultOption->text = "Please Select...";
        $defaultOption->disabled = true;

        $array = array_merge([$defaultOption], $array);
        return $view->with(["sku_options" => $array]);
    }
}