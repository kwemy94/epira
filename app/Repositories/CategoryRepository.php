<?php

namespace App\Repositories;

use App\Models\Category;


class CategoryRepository extends ResourceRepository {

    /**
     * @param Category $category
     */
    public function __construct(Category $category) {
        $this->model = $category;
    }

    public function getById($id){
        return $this->model
        ->with('patients')
        ->where('id', $id)
        ->first();
    }
    public function getAll(){
        return $this->model
        ->with('patients')
        ->orderBy('id','DESC')
        ->get();
    }

}
