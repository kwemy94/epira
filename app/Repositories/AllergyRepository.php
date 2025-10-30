<?php

namespace App\Repositories;

use App\Models\Allergy;


class AllergyRepository extends ResourceRepository {

    /**
     * @param Allergy $allergy
     */
    public function __construct(Allergy $allergy) {
        $this->model = $allergy;
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
