<?php

namespace App\Repositories;

use App\Models\Insurer;


class InsurerRepository extends ResourceRepository {

    /**
     * @param Insurer $insurer
     */
    public function __construct(Insurer $insurer) {
        $this->model = $insurer;
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
