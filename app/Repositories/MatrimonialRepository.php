<?php

namespace App\Repositories;

use App\Models\Matrimonial;


class MatrimonialRepository extends ResourceRepository {

    /**
     * @param Matrimonial $matrimonial
     */
    public function __construct(Matrimonial $matrimonial) {
        $this->model = $matrimonial;
    }

    public function getById($id){
        return $this->model
        ->where('id', $id)
        ->first();
    }
    public function getAll(){
        return $this->model
        ->orderBy('id','DESC')
        ->get();
    }

}
