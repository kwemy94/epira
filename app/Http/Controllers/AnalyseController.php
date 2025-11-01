<?php

namespace App\Http\Controllers;

use App\Models\Analyse;
use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Prestation;
use App\Models\Visite;
use Illuminate\Support\Facades\DB;
use App\Repositories\PrestationRepository;
use App\Repositories\PatientRepository;

class AnalyseController extends Controller
{
    private $prestationRepository;
    private $patientRepository;

     public function __construct(
        PrestationRepository $prestationRepository ,PatientRepository $patientRepository
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
    public function create(Request $request)
    {
         $doctors = Doctor::all();
        $prestation_id = $request->prestation_id;
        $patient_id = $request->patient;
        $prestation = $this->prestationRepository->getById($prestation_id);
        $patient = $this->patientRepository->getById($patient_id);
        
        return view('dashboard.analyse.create',compact('doctors','prestation_id','patient','prestation'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
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
        $prestations = $this->prestationRepository->getAll();

        return View('dashboard.prestation.index', compact('prestations'))->with('success', 'Visite créée avec succès');
    
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
