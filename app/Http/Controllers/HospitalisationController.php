<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hospitalisation;
use App\Models\Doctor;
use App\Models\Patient;

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
        return view('dashboard.hospitalisation.create',compact('doctors','prestation_id'));
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
            'service' => $inputs['service'],
            'doctor' => $inputs['doctor_id'],
            'enter_date' => $inputs['enter_date'],
            'exit_date' => $inputs['exit_date'],
            'chambre' => $inputs['chambre'],
            'motif' => $inputs['motif'] ?? null,
            'comment' => $inputs['comment'] ?? null,
        ]);
        $patients = Patient::all();

        return View('dashboard.patient.index', compact('patients'));
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
