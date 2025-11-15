<?php

namespace App\Repositories;

use App\Models\PrestationType;


class PrestationTypesRepository extends ResourceRepository {

    /**
     * @param Prestation $prestation
     */
    public function __construct(PrestationType $prestationTypes) {
        $this->model = $prestationTypes;
    }

    public function getById($id){
        return $this->model
        ->where('id', $id)
        ->first();
    }
    public function getAll(){
        return $this->model
        ->orderBy('id','ASC')
        ->get();
    }
    public function getPrestations(){
         return $this->model
         ->where('name','!=','Devis')
        ->orderBy('id','ASC')
        ->get();
    }


}
