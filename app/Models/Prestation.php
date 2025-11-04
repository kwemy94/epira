<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestation extends Model
{
    use HasFactory;

    protected $guarded =['id'];
    protected $fillable =['prestation_type_id',"patient_id",'insurer_id','amount'];

    public function patient(){
         return $this->belongsTo(Patient::class);
    }

     public function insurer(){
         return $this->belongsTo(Insurer::class);
    }

    public function type(){
         return $this->belongsTo(PrestationType::class,'prestation_type_id');
    }

    public function visite(){
         return $this->hasOne(Visite::class);
    }
    public function devis(){
         return $this->hasOne(Devis::class);
    }
    public function hospitalisation(){
         return $this->hasOne(Hospitalisation::class);
    }
    public function radiologie(){
         return $this->hasOne(Radiologie::class);
    }
    public function pharmacie(){
         return $this->hasOne(Pharmacie::class);
    }
    public function consultation(){
         return $this->hasOne(Consultation::class);
    }
    public function ambulance(){
         return $this->hasOne(Ambulance::class);
    }
    public function analyse(){
         return $this->hasOne(Analyse::class);
    }

    public function actes(){
     return $this->belongsToMany(Acte::class, 'acte_prestation')
                    ->withPivot(['doctor_id', 'tarif_applique'])
                    ->withTimestamps();
    }
}
