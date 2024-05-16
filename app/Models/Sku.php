<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sku extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sku',
        'sku_type_id'
    ];

    public function skuType()
    {
        return $this->belongsTo(SkuType::class);
    }

    public function returns()
    {
        return $this->hasMany(Returns::class);
    }

    public function returnItems()
    {
        return $this->hasMany(ReturnItem::class);
    }
}