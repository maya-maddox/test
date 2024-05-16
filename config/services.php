<?php
return [
    'list' => [
        "Internal Services" =>
        [
            "tools.servicecenter.index" => "Service Center Tools Index",
        ],
        "Stores" =>
        [
            "Crowdox" => [
                "stores.crowdox.customers.index" => "CrowdOx Customers",
                "stores.crowdox.countries.index" => "CrowdOx Countries",
                "stores.crowdox.orders.index" => "CrowdOx Orders",
                "stores.crowdox.orderaddresses.index" => "CrowdOx Order Addresses",
                "stores.crowdox.ordertags.index" => "CrowdOx Order Tags",
                "stores.crowdox.orderlines.index" => "CrowdOx Order Lines",
                "stores.crowdox.orderselections.index" => "CrowdOx Order Selections",
                "stores.crowdox.ordertransactions.index" => "CrowdOx Order Transactions",
                "stores.crowdox.products.index" => "CrowdOx Products",
                "stores.crowdox.productvariations.index" => "CrowdOx Product Variations",
                "stores.crowdox.projects.index" => "CrowdOx Projects",
                "stores.crowdox.projectcustomfields.index" => "CrowdOx Project Custom Fields",
                "stores.crowdox.states.index" => "CrowdOx States",
            ],
            "Swytch" => [
                "stores.swytch.skus.index" => "Swytch SKUs",
                "stores.swytch.sku-type.index" => "Swytch SKU Types",
            ],
        ],
    ],


    'trackable_types' => [
        'ingestor', 'operator', 'discharger'
    ],
];
