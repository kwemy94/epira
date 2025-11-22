<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ambulance extends Model
{
    use HasFactory;

    protected $fillable = ['prestation_id','doctor','reference','type_ambulance',"motif","start_date",'end_date','service','comment'];

    public function prestation(){
        return $this->belongsTo(Prestation::class);
    }
}
