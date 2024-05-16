<?php
namespace App\Ingestors;

use App\Models\ReturnItem;
use App\Models\ReturnItemDiagnosis;
use App\Models\Returns;
use App\Models\Sku;
use App\Models\SkuType;
use App\User;

class ReturnItemsIngestor extends IngestorStreamed
{

    protected function importAndRecord(): array { 
        $strJsonFileContents = file_get_contents(storage_path() . "/dummy-data/return-items.json");
        $obj = json_decode($strJsonFileContents);

        $user = User::factory()->create();

        $returnItems = [];
        foreach ($obj as $return_item)
        {
            $return = Returns::updateOrCreate([
                'notes' => $return_item->{'Returns → Notes'}." Production Return ID: ".$return_item->{'Returns → Internal Return ID'},
            ], [
                "service_center_id" => 1,
                'supportsync_reference' => $return_item->{'Returns → Supportsync Reference'},
                'zendesk_reference' => $return_item->{'Returns → Zendesk Reference'},
                'other_reference' => $return_item->{'Returns → Other Reference'},
                'recieved_date' => $return_item->{'Returns → Recieved Date'},
                'sku_id' => $return_item->{'Skus_2 → Sku'} ? Sku::where('sku', $return_item->{'Skus_2 → Sku'})->firstOrFail()->id : null,
                'custom_sku' => $return_item->{'Returns → Custom Sku'},
                'check_in_user_id' => $user->id, //dummy data
                'technician_id' => $user->id, //dummy data
                'tested_date' => $return_item->{'Returns → Tested Date'},
                'return_reason' => $return_item->{'Returns → Return Reason'},
                'refund_type' => $return_item->{'Returns → Refund Type'},
                'customer_aware' => $return_item->{'Returns → Customer Aware'},
                'all_checks' => $return_item->{'Returns → All Checks'},
                'completed_date' => $return_item->{'Returns → Completed Date'},
            ]);

            $return_item_diagnosis = $return_item->{'Return Item Diagnoses → Diagnosis'} ? ReturnItemDiagnosis::firstOrCreate([
                'diagnosis' => $return_item->{'Return Item Diagnoses → Diagnosis'},
                'sku_type_id' => $return_item->{'Sku Types → Type'} ? SkuType::where('type', $return_item->{'Sku Types → Type'})->firstOrFail()->id : null,
            ]) : null;

            $returnItems[] = ReturnItem::updateOrCreate([
                'returns_id' => $return->id,
                'sku_id' => $return_item->{'Skus → Sku'} ? Sku::where('sku', $return_item->{'Skus → Sku'})->firstOrFail()->id : null,
                'custom_sku' => $return_item->{'Custom Sku'},
            ], [
                'serial_number' => $return_item->{'Serial Number'},
                'outcome' => $return_item->{'Outcome'},
                'return_item_diagnosis_id' => $return_item_diagnosis ? $return_item_diagnosis->id : null,
                'custom_diagnosis' => $return_item->{'Custom Diagnosis'},
                'pass' => $return_item->{'Pass'},
                'notes' => $return_item->{'Notes'},
            ]);

        }
        
        return $returnItems;
    }
    
}