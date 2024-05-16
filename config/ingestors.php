<?php

return [

    //crowdox transformers. Ordered by relative relation levels
    'crowd_ox_transformers' => [
        'countries' => App\Ingestors\CrowdOx\Transformers\Country::class,
        'states' => App\Ingestors\CrowdOx\Transformers\State::class,
        'projects' => App\Ingestors\CrowdOx\Transformers\Project::class,

        'order-tags' => App\Ingestors\CrowdOx\Transformers\OrderTag::class,
        'project-custom-fields' => App\Ingestors\CrowdOx\Transformers\ProjectCustomField::class,
        'products' => App\Ingestors\CrowdOx\Transformers\Product::class,

        'product-variations' => App\Ingestors\CrowdOx\Transformers\ProductVariation::class,

        'customers' => App\Ingestors\CrowdOx\Transformers\Customer::class,
        'orders' => App\Ingestors\CrowdOx\Transformers\Order::class,

        'order-transactions' => App\Ingestors\CrowdOx\Transformers\OrderTransaction::class,
        'order-addresses' => App\Ingestors\CrowdOx\Transformers\OrderAddress::class,
        'order-lines' => App\Ingestors\CrowdOx\Transformers\OrderLine::class,

        'order-selections' => App\Ingestors\CrowdOx\Transformers\OrderSelection::class,
    ],

    'crowd_ox_transformers_post' => [
        App\CrowdOxOrder::class => App\Ingestors\CrowdOx\Transformers\PostOrderCleaner::class,
    ],

];
