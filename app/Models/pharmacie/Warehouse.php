<?php

namespace App\Models\pharmacie;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Warehouse extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'p_warehouses';

    protected $guarded = ['id'];

    public function productsPosition()
    {
        return $this->belongsToMany(Product::class, 'p_stock_position', 'warehouse_id', 'product_id')
            ->withPivot(['quantity', 'sale_unit_price', 'buy_unit_price'])
            ->withTimestamps();
    }
    public function productsMvt()
    {
        return $this->belongsToMany(Product::class, 'p_stock_movement', 'warehouse_id', 'product_id')
            ->withPivot(['quantity', 'sale_unit_price', 'movement_type', 'buy_unit_price'])
            ->withTimestamps();
    }

    
}
