<?php

namespace App\Repositories;

use App\Models\ProfesionnalTitle;


class ProfesionnalTitleRepository extends ResourceRepository {

    /**
     * @param ProfesionnalTitle $profesionnalTitle
     */
    public function __construct(ProfesionnalTitle $profesionnalTitle) {
        $this->model = $profesionnalTitle;
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
