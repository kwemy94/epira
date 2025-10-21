<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $guarded =['id'];

    public function patient(){
        return $this->belongsToMany(Patient::class);
    }

    public function typeContact(){
        return $this->belongsTo(ContactType::class);
    }
}
