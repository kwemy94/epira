<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visite extends Model
{
    use HasFactory;    
    protected $fillable = ['prestation_id','doctor','enter_date','exit_date','service','reference'];

    public function prestation(){
        return $this->belongsTo(Prestation::class);
    }
}
