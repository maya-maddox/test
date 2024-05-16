<?php

namespace App\Support\CrowdOx\OrderExportMapper\Maps;

class CustomOrderFields extends BaseMap {

    public function export() {
        $customOrderFields = [];

        foreach ($this->order->crowdOxProject->crowdOxProjectCustomFields as $custom_field) {
            $orderCustomField = $this->order->crowdOxProjectCustomFields->where('name', $custom_field->name)->first();
            $customOrderFields[$custom_field->name] = $orderCustomField ? $orderCustomField->pivot->value : null;
        }
        return $customOrderFields;
    }
}
