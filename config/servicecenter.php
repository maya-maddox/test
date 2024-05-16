<?php

return [
    /* SERVICE CENTER */

    /* 
        This file manages the configuration settings for service center related settings
    */

    "returnslog" => [
        /* Returns Log Settings*/
        "returns_log_upload_enabled" => env("RETURNS_LOG_UPLOAD_ENABLED", false),

        // The reason for returning
        "return_reasons" => [
            //key, text
            "fault" => "Fault",
            "fault_refund" => "Fault/Refund",
            "refund" => "Refund",
            "exchange" => "Exchange",
            "qc_return" => "QC Return",
            "hq_stock" => "HQ Stock",
            "return_to_shipper" => "Return to Shipper",
            "extra_kit" => "Extra Kit",
            "cancelled_order" => "Cancelled Order",
        ],

        //Types of refunds which can be given to customers
        "refund_types" => [
            //key, text
            "full" => "Full",
            "partial" => "Partial",
            "not_applicable" => "Not Applicable",
            "no_refund" => "No Refund",
        ],


        //Types of outcomes for items which have been returned
        "return_item_outcomes" => [
            //key, text
            "wastage_rejected" => "Wastage, Rejected",
            "return_to_stock" => "Return to Stock",
            "repaired_return_to_stock" => "Repaired & Return to Stock",
            "repaired_rejected" => "Repaired & Rejected",
        ]

    ]
];