<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductWarranty extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'product_id',
        'warranty_size',
        'warranty_coverage',
        'price',
        'is_active'
    ];

    public function product()
    {
        return $this->belongsTo(Products::class, 'product_id');
    }
}
