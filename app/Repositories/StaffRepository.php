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

    public function getDoctors(){
        return  $this->model
        ->with('patient', 'specialization', 'profesionnalTitle', 'staffType')
        ->join('profesionnal_titles','profesionnal_titles.id','profesionnal_title_id')
        ->where('profesionnal_titles.name','=',"Dr")
        ->select('staffs.*')
        ->orderBy('staffs.id','DESC')
        ->get();
    }
        public function getPharmaciens(){
        return  $this->model
        ->with('patient', 'specialization', 'profesionnalTitle', 'staffType')
        ->join('profesionnal_titles','profesionnal_titles.id','profesionnal_title_id')
        ->where('profesionnal_titles.name','=',"Ph")
        ->select('staffs.*')
        ->orderBy('staffs.id','DESC')
        ->get();
    }
}
