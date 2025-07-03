<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerWarranty extends Model
{
    use SoftDeletes;

    protected $fillable = ['customer_id', 'installer_id', 'product_id', 'product_warranty_id', 'vehicle_brand', 'model_name', 'year', 'vehicle_no', 'vin_no', 'installation_images', 'date_of_installation', 'product_lot_no', 'product_serial_no', 'warranty_status', 'warranty_reason', 'remarks', 'is_active'];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function installer()
    {
        return $this->belongsTo(User::class, 'installer_id');
    }

    public function products()
    {
        return $this->belongsTo(Products::class, 'product_id');
    }

    public function productWarranty()
    {
        return $this->belongsTo(Products::class, 'product_warranty_id');
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($product) {
            if (auth()->check()) {
                $product->installer_id = auth()->id();
            }
        });
    }
}
