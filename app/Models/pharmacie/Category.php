<?php

namespace App\Models\pharmacie;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'p_categories';

    public function products(){
        return $this->hasMany(Product::class, 'product_id');
    }
}
