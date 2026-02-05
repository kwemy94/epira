<?php

namespace App\Http\Controllers;

use App\Models\Allergy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Repositories\AllergyRepository;

class AllergyController extends Controller
{
    private $allergyRepository;

    public function __construct(
        AllergyRepository $allergyRepository
    ) {
        $this->allergyRepository = $allergyRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        toggleDatabase(true);
        try {
            $inputs = $request->all();
            DB::beginTransaction();
            // dd($inputs);
            if (isset($inputs['allergy_id'])) {
                $allergy = $this->allergyRepository->getById($inputs['allergy_id']);
                $allergy->patients()->syncWithoutDetaching([
                    $inputs['patient_id'] => [
                        'detection_end_date' => $inputs['detection_end_date'],
                        'detection_date' => $inputs['detection_date'],
                        'comment' => $inputs['comment'],
                    ],
                ]);
            } else {
                $allergy = $this->allergyRepository->store($inputs);
                $allergy->patients()->attach($request->patient_id, [
                    'detection_end_date' => $inputs['detection_end_date'],
                    'detection_date' => $inputs['detection_date'],
                    'comment' => $inputs['comment'],
                ]);
            }
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error("Erreur create Allergy : " . $th->getMessage());
            return redirect()->back()->with('error', 'Echec création d\'allergie');
        }
        return redirect()->back()->with('success', 'Allergie crée avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(Allergy $allergy)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Allergy $allergy)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        toggleDatabase(true);
        try {
            $inputs = $request->all();
            DB::beginTransaction();
            $allergy = $this->allergyRepository->getById($id);
            // dd($inputs, $allergy);
            $this->allergyRepository->update($allergy->id, $inputs);
            $allergy->patients()->syncWithoutDetaching([
                $inputs['patient_id'] => [
                    'detection_end_date' => $inputs['detection_end_date'],
                    'detection_date' => $inputs['detection_date'],
                    'comment' => $inputs['comment'],
                ],
            ]);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error("Erreur update Allergy : " . $th->getMessage());
            return redirect()->back()->with('error', 'Echec de mise à jour de l\'allergie');
        }
        return redirect()->back()->with('success', 'Allergie mis à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        toggleDatabase(true);

        # supprimer l'allergie sur le patient (table pivot) et non  supprimer l'allergie en elle meme
        try {
            $allergy = $this->allergyRepository->getById($id);
            if (!$allergy) {
                return redirect()->back()->with('error', 'Allergie introuvable.');
            }

            $allergy->patients()->detach($request->patient_id);

            return redirect()->back()->with('success', 'Allergie patient supprimée');
        } catch (\Throwable $th) {
            Log::error("Erreur Delete Allergy : " . $th->getMessage());
            return redirect()->back()->with('error', 'Echec de suppression de l\'allergie');
        }
    }
}
