<?php
namespace App\Ingestors;

use App\Models\Sku;
use App\Models\SkuType;

class SkuIngestor extends IngestorStreamed
{

    protected function importAndRecord(): array { 
        $strJsonFileContents = file_get_contents(storage_path() . "/dummy-data/skus.json");
        $obj = json_decode($strJsonFileContents);

        $skus = [];
        foreach ($obj as $sku)
        {
            $skuType = null;
            if ($sku->{'Sku Types → Type'} !== null)
            {
                $skuType = SkuType::firstOrCreate([
                    "type" => $sku->{'Sku Types → Type'} 
                ]);
            }
            $skus[] = Sku::updateOrCreate([
                "sku" => $sku->Sku
            ],
            [
                "sku_type_id" => optional($skuType)->id
            ]);
        }
        
        return $skus;
    }
    
}