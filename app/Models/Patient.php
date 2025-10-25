<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Patient extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function getAgeAttribute()
    {
        # Calculer l'age du patient
        return $this->birth_date ? Carbon::parse($this->birth_date)->age : null;
    }

    public function pathology()
    {
        return $this->belongsToMany(Doctor::class, 'pathology_patient', 'patient_id', 'pathology_id');
    }

    public function doctor()
    {
        return $this->belongsToMany(Doctor::class, 'appointments', 'patient_id', 'doctor_id');
    }
    public function insurer()
    {
        return $this->belongsToMany(Insurer::class, 'insurer_patient', 'patient_id', 'insurer_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
    public function matrimonial()
    {
        return $this->belongsTo(Matrimonial::class);
    }
    public function levelStudy()
    {
        return $this->belongsTo(StudyLevel::class);
    }
    public function contacts()
    {
        return $this->belongsToMany(Contact::class, 'contact_patient', 'patient_id', 'contact_id');
    }
}
