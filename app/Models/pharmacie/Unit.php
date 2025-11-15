<?php

namespace App\Models\pharmacie;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Unit extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'p_units';
    protected $guarded = ['id'];

    public function productSales(){
        return $this->hasMany(Product::class, 'sale_unit_id');
    }
    public function productBuy(){
        return $this->hasMany(Product::class, 'buy_unit_id');
    }
}
