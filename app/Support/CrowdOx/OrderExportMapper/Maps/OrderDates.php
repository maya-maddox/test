<?php

namespace App\Support\CrowdOx\OrderExportMapper\Maps;

class OrderDates extends BaseMap {

    public function export() {
        $json = json_decode($this->order->raw_data);
        return [
            "Order Created Date" => $this->order->co_created_at,
            "Order Invited Date" => $this->order->co_invited_at,
            "Order Paid Date" => "???2",
            "Order Completed Date" => $this->order->co_approved_at,
            "Order Canceled Date" => $this->order->co_cancelled_at,
            "Order Refused Date" => $this->order->co_refused_at,
        ];
    }
}
