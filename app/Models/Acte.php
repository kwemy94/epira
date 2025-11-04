<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Acte extends Model
{
    use HasFactory;
    protected $fillable = ['tarif',"type_acte_id"];

    public function type(){
        return $this->belongsTo(TypeActe::class,'type_acte_id');
    }

    public function prestations(){
        return $this->belongsToMany(Prestation::class, 'acte_prestation')
                       ->withPivot(['doctor_id', 'tarif_applique'])
                       ->withTimestamps();
    }   
}
