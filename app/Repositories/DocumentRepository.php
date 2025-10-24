<?php

namespace App\Repositories;

use App\Models\DocumentType;


class DocumentRepository extends ResourceRepository {

    /**
     * @param DocumentType $document
     */
    public function __construct(DocumentType $document) {
        $this->model = $document;
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
