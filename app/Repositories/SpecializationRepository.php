<?php

namespace App\Repositories;

use App\Models\Specialization;


class SpecializationRepository extends ResourceRepository {

    /**
     * @param Specialization $specialization
     */
    public function __construct(Specialization $specialization) {
        $this->model = $specialization;
    }

    public function getById($id){
        return $this->model
        ->with('staffs')
        ->where('id', $id)
        ->first();
    }
    public function getAll(){
        return $this->model
        ->with('staffs')
        ->orderBy('id','DESC')
        ->get();
    }

}
