<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Products extends Model
{
    use SoftDeletes;
    protected $fillable = ['name', 'image_urls', 'is_active', 'created_by'];

    protected $casts = [
        'image_urls' => 'array',
    ];

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function warranties()
    {
        return $this->hasMany(ProductWarranty::class, 'product_id');
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($product) {
            if (auth()->check()) {
                $product->created_by = auth()->id();
            }
        });
    }
}
