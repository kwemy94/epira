<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Devis extends Model
{
    use HasFactory;

    protected $fillable = ['prestation_id',"total_amount","reference","prestation_type_id"];

    public function prestation(){
        return $this->belongsTo(Prestation::class);
    }

    public function devisLigne(){
        return $this->hasMany(DevisLine::class);
    }
}
