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
        $prestations=$this->prestationRepository->getAll();
       
        //formater les prestations pour recuperer les references des relations et le nom du medecin
        $prestations = $prestations->map(function ($prestation) {
            if($prestation->hospitalisation){
               $ref = $prestation->hospitalisation->reference;
               $doc = $prestation->hospitalisation->doctor;
               $motif = $prestation->hospitalisation->motif;
            }elseif($prestation->consultation){
               $ref = $prestation->consultation->reference;
               $doc = $prestation->consultation->doctor;
               $motif = $prestation->consultation->motif;
            }elseif($prestation->visite){
               $ref = $prestation->visite->reference;
               $doc = $prestation->visite->doctor;
               $motif = $prestation->visite->motif;
            }elseif($prestation->analyse){
               $ref = $prestation->analyse->reference;
               $doc = $prestation->analyse->doctor;
               $motif = $prestation->analyse->motif;
            }elseif($prestation->radiologie){
               $ref = $prestation->radiologie->reference;
               $doc = $prestation->radiologie->doctor;
               $motif = $prestation->radiologie->motif;
            }elseif($prestation->ambulance){
               $ref = $prestation->ambulance->reference;
               $doc = $prestation->ambulance->doctor;
               $motif = $prestation->ambulance->motif;
            }elseif($prestation->pharmacie){
               $ref = $prestation->pharmacie->reference;
               $doc = $prestation->pharmacie->doctor;
               $motif = $prestation->pharmacie->motif;
            }elseif($prestation->devis){
               $ref = $prestation->devis->reference;
               $doc = $prestation->devis->doctor;
               $motif = $prestation->devis->motif;
            }

            //je veux ajouter ces infos a la prestation
            $prestation->reference = $ref ?? null;
            $prestation->doctor = $doc ?? null;
            $prestation->motif = $motif ?? null;
            return $prestation;
        });
        $patients=$this->patientRepository->getAll();

        return view('dashboard.prestation.index',compact('prestations','patients'));
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
        $patients=$this->patientRepository->getAll();
        if($patient_id){
            $patient = $this->patientRepository->getById($patient_id);
             return view('dashboard.prestation.create', compact( 'prestations','prestation_types','patient'));
        }
        return view('dashboard.prestation.create', compact( 'prestations','prestation_types','patients'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        try {
            $inputs = $request->all();
           
            $patient_id = $this->patientRepository->getByName($inputs['patient_id'])==null ?$inputs['patient_id']:$this->patientRepository->getByName($inputs['patient_id'])->id;

            $inputs['patient_id']=$patient_id;
            $prestation = $this->prestationRepository->store($inputs);
            $type = $inputs['prestation_type_id'];
       
            switch ($type) {
                case '1':
                     return redirect()->route('hospitalisation.create', ['patient' => $patient_id,'prestation_id' => $prestation->id]);
                    break;
                case '2':
                     return redirect()->route('consultation.create', ['patient' => $patient_id,'prestation_id' => $prestation->id]);
                    break;      
                case '3':
                     return redirect()->route('visite.create', ['patient' => $patient_id,'prestation_id' => $prestation->id]);
                    break; 
                case '4':
                     return redirect()->route('analyse.create', ['patient' => $patient_id,'prestation_id' => $prestation->id]);
                    break;
                case '5':
                     return redirect()->route('radiologie.create', ['patient' => $patient_id,'prestation_id' => $prestation->id]);
                    break;
                case '6':
                     return redirect()->route('ambulance.create', ['patient' => $patient_id,'prestation_id' => $prestation->id]);
                    break;  
                case '7':
                     return redirect()->route('pharmacie.create', ['patient' => $patient_id,'prestation_id' => $prestation->id]);
                    break;
                case '8':
                    redirect()->route('devis.create', ['patient' => $patient_id,'prestation_id' => $prestation->id]);
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
