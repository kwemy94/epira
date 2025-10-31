<?php

namespace App\Http\Controllers;

use App\Models\Prestation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Repositories\PrestationRepository;
use App\Repositories\PatientRepository;
use App\Repositories\PrestationTypesRepository;

class PrestationController extends Controller
{
    private $prestationRepository;
    private $patientRepository;
    private $prestationTypesRepository;

    public function __construct(
        PrestationRepository $prestationRepository ,PatientRepository $patientRepository,
        PrestationTypesRepository $prestationTypesRepository
    ) {
        $this->prestationRepository = $prestationRepository;
        $this->patientRepository = $patientRepository;
        $this->prestationTypesRepository = $prestationTypesRepository;
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
    public function create(Request $request)
    {
        //get patient_id from route parameter
        $patient_id = $request->route('patient_id');
        $prestation_types = $this->prestationTypesRepository->getAll();
        $prestations = $this->prestationRepository->getAll();
        if($patient_id){
            $patient = $this->patientRepository->getById($patient_id);
             return view('dashboard.prestation.create', compact( 'prestations','prestation_types','patient'));
        }
        return view('dashboard.prestation.create', compact( 'prestations','prestation_types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        try {
            $inputs = $request->all();
           
            
            $patient = $this->patientRepository->getByName($inputs['patient_id']);
            $patient_id = $patient->id;
            $inputs['patient_id']=$patient_id;
            //  dd($inputs);
            $prestation = $this->prestationRepository->store($inputs);
            $type = $inputs['prestation_type_id'];
            // dd($type);
            switch ($type) {
                case '1':
                     return redirect()->route('hospitalisation.create', ['patient' => $patient_id,'prestation_id' => $prestation->id]);
                    // redirect()->route('hospitalisation.create', ['prestation_id' => $prestation->id, 'patient'=>$patient]);
                    break;
                case '2':
                    # code...
                    break;      
                case '3':
                    # code...
                    break; 
                case '4':
                    # code...
                    break;
                case '5':
                    # code...
                    break;
                case '6':
                    # code...
                    break;  
                case '7':
                    # code...
                    break;
                case '8':
                    redirect()->route('devis.create', ['prestation_id' => $prestation->id]);
                    break;  
                    
                default:
                
                    return redirect()->route('hospitalisation.create', ['patient' => $patient_id,'prestation_id' => $prestation->id]);
                    break;
            }
            
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error("Erreur create prestation : " . $th->getMessage());
            return redirect()->back()->with('error', $th->getMessage());
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
