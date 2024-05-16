<?php

namespace App\Support\CrowdOx\OrderExportMapper\Maps;

class OrderSelections extends BaseMap {

    public function export() {
        $selections = [];

        foreach ($this->order->crowdOxOrderSelections as $orderSelection) {
            $product = $orderSelection->crowdOxProduct;
            $orderLine = $orderSelection->crowdOxOrderLine;
            $productBundle = $orderSelection->crowdOxOrderLine->crowdOxProductBundle;
            $productVariation = $orderSelection->crowdOxProductVariation;

            if ($product->type == "question") { continue; } // don't include questions here.
            $selections[] = [
                "Product Bundle" => $productBundle->name,
                "Product Line" => $orderLine->type,
                "Product Name" => $product->name,
                "Product Sku" => $productVariation->SKU,
                "Product Quantity" => $orderSelection->quantity,
            ];
        }

        return [
            "Order Selections" => $selections
        ];
    }
}
