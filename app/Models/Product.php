<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    const PRICE_PRECISION = 2;

    protected $fillable = [
        'name',
        'manufacturer',
        'material_id',
        'is_visible',
        'price',
        'currency'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public static function boot() {

        parent::boot();

        self::creating(function ($product) {
            $product->price = round($product->price, self::PRICE_PRECISION, PHP_ROUND_HALF_UP);
        });

    }

    public function material()
    {
        return $this->belongsTo(Material::class);
    }
}
