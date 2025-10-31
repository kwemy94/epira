<?php

namespace App\Repositories;

use App\Models\Prestation;


class PrestationRepository extends ResourceRepository {

    /**
     * @param Prestation $prestation
     */
    public function __construct(Prestation $prestation) {
        $this->model = $prestation;
    }

    public function getById($id){
        return $this->model
        ->where('id', $id)
        ->first();
    }
    public function getAll(){
        return $this->model->with('patient','insurer')
        ->orderBy('id','DESC')
        ->get();
    }

    public function getByPatientId($patient_id){
        return $this->model
        ->where('patient_id', $patient_id)
        ->with('patient','insurer','type','hospitalisation','consultation','analyse','pharmacie','radiologie','visite','devis')
        ->orderBy('id','DESC')
        ->get();
    }

}
