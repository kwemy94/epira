<?php

namespace App\Repositories;

use App\Models\Pathology;


class PathologyRepository extends ResourceRepository {

    /**
     * @param Pathology $Pathology
     */
    public function __construct(Pathology $pathology) {
        $this->model = $pathology;
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
