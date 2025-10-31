<?php

namespace App\Repositories;

use App\Models\Doctor;


class DoctorRepository extends ResourceRepository {

    /**
     * @param Doctor $doctor
     */
    public function __construct(Doctor $doctor) {
        $this->model = $doctor;
    }

    public function getById($id){
        return $this->model
        ->with('patient')
        ->where('id', $id)
        ->first();
    }
    public function getAll(){
        return $this->model
        ->with('patient')
        ->orderBy('id','DESC')
        ->get();
    }

}
