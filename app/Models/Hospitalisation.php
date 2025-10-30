<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hospitalisation extends Model
{
    use HasFactory;

    protected $fillable = ['prestation_id','doctor'];

    public function prestation(){
        return $this->belongsTo(Prestation::class);
    }
}
