<?php

namespace App\Http\Controllers;

use App\Models\Prestation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Repositories\PrestationRepository;
use App\Repositories\PatientRepository;

class PrestationController extends Controller
{
    private $prestationRepository;
    private $patientRepository;

    public function __construct(
        PrestationRepository $prestationRepository ,PatientRepository $patientRepository,
    ) {
        $this->prestationRepository = $prestationRepository;
         $this->patientRepository = $patientRepository;
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
        //
        try {
            $inputs = $request->all();
            // dd($inputs);
            DB::beginTransaction();
            $patient_id = $this->patientRepository->getByName($inputs['patient_id'])->id;
            $inputs['patient_id']=$patient_id;
            $prestation = $this->prestationRepository->store($inputs);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error("Erreur create prestation : " . $th->getMessage());
            return redirect()->back()->with('error', 'Echec création de la prestation');
        }
        return redirect()->back()->with('success', 'Prestation créée avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(Prestation $prestation)
    {
        return response()->json($prestation);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Prestation $prestation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Prestation $prestation)
    {
         try {
            $inputs = $request->all();
            $patient_id = $this->patientRepository->getByName($inputs['patient_id'])->id;
            $inputs['patient_id']=$patient_id;
            $this->prestationRepository->update($prestation->id, $inputs);
            return redirect()->back()->with('success', "Prestation mise à jour avec succès");
            
        } catch (\Throwable $th) {
            Log::info("erreur update prestation" . $th->getMessage());
            return redirect()->back()->with('error', "Echec de mise à jour de la prestation");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Prestation $prestation)
    {
         try {
            DB::beginTransaction();
            $this->prestationRepository->destroy($prestation->id);
            DB::commit();
            return redirect()->back()->with('success', 'Prestation supprimée avec succès');

        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error("Erreur delete assurer : " . $th->getMessage());
            return redirect()->back()->with('error', 'Echec de suppression de la prestation');
        }
    }
}
