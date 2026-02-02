<?php

namespace App\Repositories;

use App\Models\Appointment;


class AppointmentRepository extends ResourceRepository {

    /**
     * @param Appointment $appointment
     */
    public function __construct(Appointment $appointment) {
        $this->model = $appointment;
    }

    public function getById($id){
        return $this->model
        // ->with('patients')
        ->where('id', $id)
        ->first();
    }
    public function getAll(){
        return $this->model
        // ->with('patients')
        ->orderBy('id','DESC')
        ->get();
    }

}
