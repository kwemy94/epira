<?php

namespace App\Http\Controllers;

use App\Models\Insurer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Repositories\InsurerRepository;

class InsurerController extends Controller
{
    private $insurerRepository;

    public function __construct(
        InsurerRepository $insurerRepository,
    ) {
        $this->insurerRepository = $insurerRepository;
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
        try {
            $inputs = $request->all();
            // dd($inputs);
            DB::beginTransaction();
            $insurer = $this->insurerRepository->store($inputs);
            
            $insurer->patient()->attach($inputs['patient_id']);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error("Erreur create insurer : " . $th->getMessage());
            return redirect()->back()->with('error', 'Echec création assureur');
        }
        return redirect()->back()->with(['success', 'Assureur crée avec succès','insurer'=>$insurer]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Insurer $insurer)
    {
        return response()->json($insurer);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Insurer $insurer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Insurer $insurer)
    {
        try {
            $inputs = $request->all();
            $this->insurerRepository->update($insurer->id, $inputs);
            return redirect()->back()->with('success', "Assureur mis à jour");
            
        } catch (\Throwable $th) {
            Log::info("erreur update insurer" . $th->getMessage());
            return redirect()->back()->with('error', "Echec de mise à jour de l'assureur");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Insurer $insurer)
    {
         try {
            DB::beginTransaction();
            $insurer->patient()->detach();
            $this->insurerRepository->destroy($insurer->id);
            DB::commit();
            return redirect()->back()->with('success', 'Assureur supprimé avec succès');

        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error("Erreur delete assurer : " . $th->getMessage());
            return redirect()->back()->with('error', 'Echec de suppression de l\'assureur');
        }
    }
}
