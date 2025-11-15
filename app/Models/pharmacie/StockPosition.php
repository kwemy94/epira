<?php

namespace App\Models\pharmacie;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StockPosition extends Model
{
    use HasFactory, SoftDeletes;

    protected $table ='p_stock_position';

    protected $guarded = ['id'];
    
}
