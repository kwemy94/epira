<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Radiologie extends Model
{
    use HasFactory;
        protected $fillable = ['prestation_id','doctor','reference','exams_date','result_date','service'];

    public function prestation(){
        return $this->belongsTo(Prestation::class);
    }
}
