<?php

namespace App\Http\Controllers;

use App\Models\Devis;
use App\Models\DevisLine;
use Illuminate\Http\Request;
use App\Repositories\PatientRepository;
use App\Repositories\PrestationRepository;
use App\Repositories\PrestationTypesRepository;
use Illuminate\Support\Facades\DB;

class DevisController extends Controller
{
    private $prestationRepository;
    private $patientRepository;
    private $prestationTypesRepository;
    public function __construct(PrestationRepository $prestationRepository, PatientRepository $patientRepository,
    PrestationTypesRepository $prestationTypesRepository)
    {
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
        toggleDatabase(true);
        $prestations = $this->prestationRepository->getAll();
        $prestation_id = $request->prestation_id;
        $patient_id = $request->patient;
        $prestation_types = $this->prestationTypesRepository->getPrestations();
        $prestation = $this->prestationRepository->getById($prestation_id);
        $patient = $this->patientRepository->getById($patient_id);

        return view('dashboard.devis.create',compact('prestations','prestation_id','patient','prestation','prestation_types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        toggleDatabase(true);

        $inputs = $request->all();
        $total = array_sum($request->montant_total);
        DB::beginTransaction();
        try {
            # Enregistrer le devis principal
            $devis = Devis::create([
                'prestation_id'=>$request->prestation_id,
                'prestation_type_id' => $request->prestation_type_id,               
                'reference' => $this->prestationRepository->generateReference('DE'),
                'total_amount' => array_sum($request->montant_total), // facultatif
            ]);

            #Enregistrer les lignes du devis
            if ($request->has('libelle')) {
                foreach ($request->libelle as $index => $value) {

                    DevisLine::create([
                        'devis_id'=> $devis->id, // association ✔
                        'label'=> $request->libelle[$index],
                        'unit_price'=> $request->prix_unitaire[$index],
                        'quantity'=> $request->quantite[$index],
                        'total_amount'=> $request->montant_total[$index],
                        'comment'=> $request->commentaire[$index] ?? null,
                    ]);
                }
            }
            #Mise à jour de la prestation
            $prestation = $this->prestationRepository->getById($inputs['prestation_id']);
            $prestation->update(['amount' => $total]);
            DB::commit();
            return redirect()->route('prestation.index')->with('success', 'Devis enregistré avec succès.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Erreur : ' . $e->getMessage());
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function createdevisLine(Request $request)
    {
        $data = $request->all();
    
        
        return response()->json(['data'=>$data]);

    }
}
