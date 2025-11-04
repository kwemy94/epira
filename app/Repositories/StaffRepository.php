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
