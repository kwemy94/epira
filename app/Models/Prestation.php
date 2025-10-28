<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestation extends Model
{
    use HasFactory;

    protected $guarded =['id'];

    public function patient(){
         return $this->belongsTo(Patient::class);
    }

     public function insurer(){
         return $this->belongsTo(Insurer::class);
    }
}
