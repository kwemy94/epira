<?php

namespace App\Repositories;

use App\Models\Contact;


class ContactRepository extends ResourceRepository {

    /**
     * @param Contact $contact
     */
    public function __construct(Contact $contact) {
        $this->model = $contact;
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
