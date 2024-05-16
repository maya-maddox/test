<?php

namespace App\Http\View\Composers\Stores\SkuType;

use App\Models\SkuType;
use Illuminate\View\View;

class SkuTypeOptionsComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $options = SkuType::all()->mapWithKeys(fn ($type) => [$type->id => $type->type]);
        $array = array_merge([0 => "Other"], $options->toArray());
        return $view->with(["skuTypeOptions" => $array]);
    }
}


