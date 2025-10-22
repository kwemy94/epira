<?php

namespace App\Repositories;

use App\Models\Patient;


class PatientRepository extends ResourceRepository {

    /**
     * @param Patient $patient
     */
    public function __construct(Patient $patient) {
        $this->model = $patient;
    }

    public function getById($id){
        return $this->model
        ->with('pathology', 'doctor', 'insurer', 'category', 'country', 'matrimonial', 'levelStudy')
        ->where('id', $id)
        ->first();
    }
    public function getAll(){
        return $this->model
        ->with('pathology', 'doctor', 'insurer', 'category', 'country', 'matrimonial', 'levelStudy')
        ->orderBy('id','DESC')
        ->get();
    }

}
