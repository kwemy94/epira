<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pharmacie extends Model
{
    use HasFactory;

        protected $fillable = ['prestation_id','pharmacien'];

    public function prestation(){
        return $this->belongsTo(Prestation::class);
    }
}
