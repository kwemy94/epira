<?php

namespace App\Repositories;

use App\Models\StudyLevel;


class LevelRepository extends ResourceRepository {

    /**
     * @param StudyLevel $studyLevel
     */
    public function __construct(StudyLevel $studyLevel) {
        $this->model = $studyLevel;
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
