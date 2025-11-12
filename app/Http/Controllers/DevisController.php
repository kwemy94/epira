<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\PatientRepository;
use App\Repositories\PrestationRepository;

class DevisController extends Controller
{
    private $prestationRepository;
    private $patientRepository;
    public function __construct(PrestationRepository $prestationRepository, PatientRepository $patientRepository)
    {
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
        
        $prestations = $this->prestationRepository->getAll();
        $prestation_id = $request->prestation_id;
        $patient_id = $request->patient;
        $prestation = $this->prestationRepository->getById($prestation_id);
        $patient = $this->patientRepository->getById($patient_id);
        return view('dashboard.devis.create',compact('prestations','prestation_id','patient','prestation'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
