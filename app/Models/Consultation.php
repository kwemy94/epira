<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    use HasFactory;

    protected $fillable = ['prestation_id','doctor','reference','unit_price','start_date','end_date','tarif'];

    public function prestation(){
        return $this->belongsTo(Prestation::class);
    }
}
