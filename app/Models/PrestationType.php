<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrestationType extends Model
{
    use HasFactory;

    protected $fillable = ['name','code'];

    public function prestations(){
        return $this->hasMany(Prestation::class);
    }
}
