<?php

namespace App\Support\CrowdOx\OrderExportMapper;

use App\CrowdOxOrder;

class CrowdOxOrderExportMapper
{

    /**
     * The CrowdOxOrder to export
     *
     * @var CrowdOxOrder
     */
    protected $order;

    /**
     * Mapping!
     *
     * @var array
     */
    protected $maps = [
        \App\Support\CrowdOx\OrderExportMapper\Maps\BasicInfo::class,
        \App\Support\CrowdOx\OrderExportMapper\Maps\OrderDates::class,
        \App\Support\CrowdOx\OrderExportMapper\Maps\OrderMonies::class,
        \App\Support\CrowdOx\OrderExportMapper\Maps\OrderNotes::class,
        \App\Support\CrowdOx\OrderExportMapper\Maps\OrderConfigurations::class,
        \App\Support\CrowdOx\OrderExportMapper\Maps\ManagementUrls::class,
        \App\Support\CrowdOx\OrderExportMapper\Maps\CustomerEmail::class,
        \App\Support\CrowdOx\OrderExportMapper\Maps\Address::class,
        \App\Support\CrowdOx\OrderExportMapper\Maps\Tags::class,
        \App\Support\CrowdOx\OrderExportMapper\Maps\OrderSelections::class,
        \App\Support\CrowdOx\OrderExportMapper\Maps\CustomOrderFields::class,
    ];

    public function __construct(CrowdOxOrder $order) {
        $this->order = $order;
    }


    public function export() {
        $arrays = [];
        foreach ($this->maps as $map) {
            $mapper = new $map($this->order);
            $values = $mapper->export();
            $arrays = array_merge($arrays, $values);
        }
        return $arrays;
    }


}
