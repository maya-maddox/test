<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SkuType extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type'
    ];

    public function skus()
    {
        return $this->hasMany(Sku::class);
    }

    public function returnItemDiagnoses()
    {
        return $this->hasMany(ReturnItemDiagnosis::class);
    }
}
