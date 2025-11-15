<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DevisLine extends Model
{
    use HasFactory;
    protected $fillable = [
        'devis_id',
        'quantity',
        'unit_price',
        'label',
        'total_amount',
        'comment',
    ];

    public function devis()
    {
        return $this->belongsTo(Devis::class);
    }
}
