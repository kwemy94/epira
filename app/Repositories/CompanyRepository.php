<?php

namespace App\Repositories;

use App\Models\Company;


class CompanyRepository extends ResourceRepository {

    /**
     * @param Company $company
     */
    public function __construct(Company $company) {
        $this->model = $company;
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
