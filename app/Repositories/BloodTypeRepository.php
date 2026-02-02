<?php

namespace App\Repositories;

use App\Models\BloodType;


class BloodTypeRepository extends ResourceRepository {

    /**
     * @param BloodType $bloodType
     */
    public function __construct(BloodType $bloodType) {
        $this->model = $bloodType;
    }

    public function getById($id){
        return $this->model
        ->with('patients')
        ->where('id', $id)
        ->first();
    }
    public function getAll(){
        return $this->model
        ->with('patients')
        ->orderBy('id','DESC')
        ->get();
    }

}
