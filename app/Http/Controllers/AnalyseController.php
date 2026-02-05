<?php

namespace App\Http\Controllers;

use App\Models\Acte;
use App\Models\Analyse;
use Illuminate\Http\Request;
use App\Repositories\PrestationRepository;
use App\Repositories\PatientRepository;
use App\Repositories\StaffRepository;


class AnalyseController extends Controller
{
    private $prestationRepository;
    private $patientRepository;
    private $staffRepository;

     public function __construct(
        StaffRepository $staffRepository,
        PrestationRepository $prestationRepository ,PatientRepository $patientRepository
    ) {
        $this->prestationRepository = $prestationRepository;
        $this->patientRepository = $patientRepository;
        $this->staffRepository = $staffRepository;
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
        
        $prestation_id = $request->prestation_id;
        $patient_id = $request->patient;
        $prestation = $this->prestationRepository->getById($prestation_id);
        $patient = $this->patientRepository->getById($patient_id);
        $actes= Acte::all();
        $medecins = $this->staffRepository->getDoctors();
        return view('dashboard.analyse.create',compact('prestation_id','patient','prestation',"actes",'medecins'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        toggleDatabase(true);
        $inputs = $request->all();
      
        try {
              $hospitalisation = Analyse::create([
                'prestation_id' => $inputs['prestation_id'],
                'reference' => $this->prestationRepository->generateReference('ANA'),
                'service' => $inputs['service'],
                'doctor' => $inputs['doctor_id'],
                'external_doctor' => $inputs['external_doctor'],
                'analysis_date' => $inputs['enter_date'],
                'result_date' => $inputs['exit_date'],
                'comment' => $inputs['comment'] ?? null,
            ]);
            $total = 0;
                $prestation = $this->prestationRepository->getById($inputs['prestation_id']);
                foreach ( $inputs['actes'] as $acte) {
                    $prestation->actes()->attach($acte['id'], [
                        'tarif_applique' => $acte['tarif'],
                        'doctor_id' => $acte['doctor_id'],
                    ]);
                    $total += $acte['tarif'];
                }

                $prestation->update(['amount' => $total]);
            $prestations = $this->prestationRepository->getAll();
            return redirect()->route('prestation.index')->with(["success"=>"Analyse créée avec succès",'prestations'=>$prestations]);

        } catch (\Throwable $th) {
            dd($th);
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
}
