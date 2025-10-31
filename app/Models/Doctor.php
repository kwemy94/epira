<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function patient()
    {
        return $this->belongsToMany(Patient::class, 'appointments', 'doctor_id', 'patient_id')
            ->withPivot('appointment_date', 'appointment_start_time', 'appointment_end_time', 'comment');
    }
}
