<?php

namespace App\Repositories;

use App\Models\StaffType;


class StaffTypeRepository extends ResourceRepository {

    /**
     * @param StaffType $staffType
     */
    public function __construct(StaffType $staffType) {
        $this->model = $staffType;
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
