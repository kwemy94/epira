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

}
