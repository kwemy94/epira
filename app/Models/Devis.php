<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Devis extends Model
{
    use HasFactory;

    protected $fillable = ['prestation_id'];

    public function prestation(){
        return $this->belongsTo(Prestation::class);
    }
}
