<?php

namespace App\Repositories;

use App\Models\Country;


class CountryRepository extends ResourceRepository {

    /**
     * @param Country $country
     */
    public function __construct(Country $country) {
        $this->model = $country;
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
