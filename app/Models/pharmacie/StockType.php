<?php

namespace App\Models\pharmacie;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockType extends Model
{
    use HasFactory;

    protected $table = 'p_stock_types';
    protected $guarded = ['id'];
    public function products(){
        return $this->hasMany(Product::class, 'stock_type_id');
    }
}
