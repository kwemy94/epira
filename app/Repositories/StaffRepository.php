<?php

namespace App\Repositories;

use App\Models\Staff;


class StaffRepository extends ResourceRepository {

    /**
     * @param Staff $staff
     */
    public function __construct(Staff $staff) {
        $this->model = $staff;
    }

    public function getById($id){
        return $this->model
        ->with('patient', 'specialization', 'profesionnalTitle', 'staffType')
        ->where('id', $id)
        ->first();
    }
    public function getAll(){
        return $this->model
        ->with('patient', 'specialization', 'profesionnalTitle', 'staffType')
        ->orderBy('id','DESC')
        ->get();
    }

}
