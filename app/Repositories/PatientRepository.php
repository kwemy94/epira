<?php

namespace App\Repositories;

use App\Models\Patient;


class PatientRepository extends ResourceRepository
{

    /**
     * @param Patient $patient
     */
    public function __construct(Patient $patient)
    {
        $this->model = $patient;
    }

    public function getById($id)
    {
        return $this->model
            ->with('contacts.typeContact', 'pathology', 'doctor', 'insurer', 'category', 'country', 'matrimonial', 'levelStudy')
            ->where('id', $id)
            ->first();
    }
    public function getAll($paginate = null, $search = null)
    {
        // Préparer la requête
        $query = $this->model
            ->with('contacts.typeContact', 'pathology', 'doctor', 'insurer', 'category', 'country', 'matrimonial', 'levelStudy')
            ->orderBy('id', 'DESC');

        // Nettoyer le search
        $search = trim($search);

        // Ajouter la recherche si elle existe
        $query->when(!empty($search), function ($q) use ($search) {
            $q->where(function ($sub) use ($search) {
                $sub->where('firstname', 'like', "%{$search}%")
                    ->orWhere('lastname', 'like', "%{$search}%")
                    ->orWhere('reference', 'like', "%{$search}%")
                    ->orWhere('sexe', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%");
            });
        });

        // Pagination OU full list
        if ($paginate) {
            return $query->paginate($paginate)
                ->appends(['search' => $search]);
        }

        return $query->get();
    }


    public function getByName($name)
    {
        return $this->model->where('firstname', 'LIKE', '%' . $name . '%')->orWhere('lastname', 'LIKE', '%' . $name . '%')->first();
    }

}
