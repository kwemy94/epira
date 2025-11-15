<?php

namespace App\Repositories;

use App\Models\Prestation;
use Illuminate\Support\Facades\DB;

class PrestationRepository extends ResourceRepository {

    /**
     * @param Prestation $prestation
     */
    public function __construct(Prestation $prestation) {
        $this->model = $prestation;
    }

    public function getById($id){
        return $this->model
        ->with('patient','insurer','type','hospitalisation','consultation','analyse','pharmacie','radiologie','visite','devis')
        ->where('id', $id)
        ->first();
    }
    public function getAll(){
        return $this->model->with('patient','insurer','type','hospitalisation','consultation','analyse','pharmacie','radiologie','visite','devis')
        ->orderBy('id','DESC')
        ->get();
    }

    public function getByPatientId($patient_id){
        return $this->model
        ->where('patient_id', $patient_id)
        ->with('patient','insurer','type','hospitalisation','consultation','analyse','pharmacie','radiologie','visite','devis')
        ->orderBy('id','DESC')
        ->get();
    }
        
    
    public function generateReference($prefix){

        $year = date('Y');

        $lastReference = DB::table("hospitalisations")
            ->where("reference", 'like', $prefix . $year . '%')
            ->orderBy("reference", 'desc')
            ->value("reference");

        if($lastReference){
            $number = intval(substr($lastReference, strlen($prefix . $year))) + 1;
        } else {    
            $number = 1;
        }   
        return $prefix . $year . str_pad($number, 5, '0', STR_PAD_LEFT);
    }

    
}
