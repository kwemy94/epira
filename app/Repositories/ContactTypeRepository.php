<?php

namespace App\Repositories;

use App\Models\ContactType;


class ContactTypeRepository extends ResourceRepository {

    /**
     * @param Contact $contactType
     */
    public function __construct(ContactType $contactType) {
        $this->model = $contactType;
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
