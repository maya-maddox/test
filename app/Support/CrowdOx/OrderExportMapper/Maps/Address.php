<?php

namespace App\Support\CrowdOx\OrderExportMapper\Maps;

class Address extends BaseMap {

    public function export() {
        $orderAddress = $this->order->crowdOxOrderAddress;
        $projectCountryId = $this->order->crowdOxProject->crowdOxCountry->id;
        return [
            "Ship To Full Name" => $orderAddress->name,
            "Ship To Phone" => $orderAddress->phone_number,
            "Ship To Address 1" => $orderAddress->address_1,
            "Ship To Address 2" => $orderAddress->address_2,
            "Ship To City" => $orderAddress->city,
            "Ship To State" => $orderAddress->state,
            "Ship To Postal Code" => $orderAddress->postal_code,
            "Ship To Country" => $orderAddress->crowdOxCountry->name,
            "Ship To Country Code" => $orderAddress->crowdOxCountry->iso2,
            "Ship To Location" => $projectCountryId == $orderAddress->crowdOxCountry->id ? "Domestic" : "International"
        ];
    }
}
