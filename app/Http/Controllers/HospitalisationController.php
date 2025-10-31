<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hospitalisation;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Prestation;
use Illuminate\Support\Facades\DB;

class HospitalisationController extends Controller
{
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
        $patient_id = $request->patient_id;
        $patient = Patient::find($patient_id);
        return view('dashboard.hospitalisation.create',compact('doctors','prestation_id','patient'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $inputs = $request->all();
        // $inputs['prestation_id']=$request->route('prestation_id');
        // dd($inputs);
      
        try {
              $hospitalisation = Hospitalisation::create([
            'prestation_id' => $inputs['prestation_id'],
            'reference' => $this->generateReference('HOSP'),
            'service' => $inputs['service'],
            'doctor' => $inputs['doctor_id'],
            'enter_date' => $inputs['enter_date'],
            'exit_date' => $inputs['exit_date'],
            'chambre' => $inputs['chambre'],
            'motif' => $inputs['motif'] ?? null,
            'comment' => $inputs['comment'] ?? null,
        ]);
        $prestations = Prestation::all();

        return View('dashboard.prestation.index', compact('prestations'));
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

    public function generateReference($prefix){

        $year = date('Y');

        $lastReference = DB::table("hospitalisations")
            ->where("reference", 'like', $prefix . $year . '%')
            ->orderBy("reference", 'desc')
            ->value("reference");

        if($lastReference){
            $number = intval(substr($lastReference, strlen($prefix . $year))) + 1;
        } else {    
            $number = 1;
        }   
        return $prefix . $year . str_pad($number, 5, '0', STR_PAD_LEFT);
    }
}
