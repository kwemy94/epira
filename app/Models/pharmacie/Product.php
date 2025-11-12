<?php

namespace App\Models\pharmacie;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'p_products';

    protected $guarded = ['id'];

    public function buyUnit(){
        return $this->belongsTo(Unit::class, 'buy_unit_id');
    }
    public function saleUnit(){
        return $this->belongsTo(Unit::class, 'sale_unit_id');
    }

    public function productType(){
        return $this->belongsTo(ProductType::class, 'product_type_id');
    }
    public function stockType(){
        return $this->belongsTo(StockType::class, 'stock_type_id');
    }
    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }

     public function productsPosition()
    {
        return $this->belongsToMany(Warehouse::class, 'p_stock_position', 'product_id', 'warehouse_id')
            ->withPivot(['quantity', 'sale_unit_price', 'buy_unit_price'])
            ->withTimestamps();
    }
    public function productsMvt()
    {
        return $this->belongsToMany(Warehouse::class, 'p_stock_movement', 'product_id', 'warehouse_id')
            ->withPivot(['quantity', 'sale_unit_price', 'movement_type', 'buy_unit_price'])
            ->withTimestamps();
    }
}
