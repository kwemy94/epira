<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Allergy extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function patients()
    {
        return $this->belongsToMany(Patient::class)
            ->withPivot('detection_date', 'detection_end_date', 'comment');
    }
}
