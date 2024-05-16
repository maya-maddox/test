<?php
namespace App\Ingestors;

use App\Models\Returns;
use App\Models\Sku;
use App\User;

class CheckInReturnsIngestor extends IngestorStreamed
{

    protected function importAndRecord(): array { 
        $strJsonFileContents = file_get_contents(storage_path() . "/dummy-data/checked-in-returns.json");
        $obj = json_decode($strJsonFileContents);

        $user = User::factory()->create();

        $returns = [];
        foreach ($obj as $return_item)
        {
            $sku = $return_item->{'Skus → Sku'} ? Sku::where('sku', $return_item->{'Skus → Sku'})->firstOrFail()->id : null;
            $returns[] = Returns::updateOrCreate([
                'sku_id' => $sku,
                'custom_sku' => $sku == null ? $return_item->{'Skus → Sku'} : null, 
                'recieved_date' => $return_item->{'Recieved Date'},
                'return_reason' => $return_item->{'Return Reason'},
                "service_center_id" => 1,
            ], [
                'check_in_user_id' => $user->id, //dummy data
            ]);
        }
        
        return $returns;
    }
    
}