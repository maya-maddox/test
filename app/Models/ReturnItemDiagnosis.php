<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReturnItemDiagnosis extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'diagnosis',
        'sku_type_id'
    ];

    public function skuType() {
        return $this->belongsTo(SkuType::class);
    }
}