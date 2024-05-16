<?php

namespace App\Support\CrowdOx\OrderExportMapper\Maps;

class OrderMonies extends BaseMap {

    public function export() {

        // $total = 0;
        // foreach ($this->order->crowdOxOrderLines as $orderLine) {
        //     $prices = json_decode($orderLine->raw_data)->attributes->{'price-data'}->prices;
        //     $total = $total + array_reduce($prices, function($price) {
        //         return $price->amount_cents;
        //     });
        // }


        return [
            // "Order Total" => $total/100,
            "Order Amount Paid" => "???",
            "Order Tax Paid" => "???",
            "Order Shipping Paid" => "???",
            "Order Balance" => "???",
        ];
    }
}
