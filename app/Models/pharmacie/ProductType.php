<?php

namespace App\Models\pharmacie;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductType extends Model
{
    use HasFactory, SoftDeletes;

    protected $table ='p_product_types';
    protected $guarded = ['id'];

    public function products(){
        return $this->hasMany(Product::class, 'product_type_id');
    }
}
