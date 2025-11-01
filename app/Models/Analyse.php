<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Analyse extends Model
{
    use HasFactory;
    protected $fillable = ['prestation_id','doctor','reference','external_doctor','analyse_date','result_date','service','comment'];

    public function prestation(){
        return $this->belongsTo(Prestation::class);
    }
}
