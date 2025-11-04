<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $table = 'staffs';

    protected $guarded = ['id'];

    public function patient(){
        return $this->belongsToMany(Patient::class,'appointments', 'staff_id', 'patient_id')
            ->withPivot('appointment_date', 'appointment_start_time', 'appointment_end_time', 'comment');
    }

    public function specialization(){
        return $this->belongsTo(Specialization::class);
    }
    public function profesionnalTitle(){
        return $this->belongsTo(ProfesionnalTitle::class);
    }
    public function staffType(){
        return $this->belongsTo(StaffType::class);
    }
}
