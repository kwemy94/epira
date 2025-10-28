<?php

namespace App\Http\Controllers;

use App\Models\Pathology;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Repositories\PathologyRepository;

class PathologyController extends Controller
{
    private $pathologyRepository;

    public function __construct(PathologyRepository $pathologyRepository)
    {
        $this->pathologyRepository = $pathologyRepository;
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
            // dd($inputs, !empty($request->pathology_id));
            if (!empty($request->pathology_id)) {
                $pathologie = $this->pathologyRepository->getById($request->pathology_id);
                $pathologie->patient()->attach($request->patient_id);
            } else {

                DB::beginTransaction();
                $pathologie = $this->pathologyRepository->store($inputs);
                $pathologie->patient()->attach($inputs['patient_id']);
                DB::commit();
            }

            return redirect()->back()->with('success', 'Pathologie ajoutée avec succès');
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error("Erreur create pathologie : " . $th->getMessage());
            return redirect()->back()->with('error', 'Echec création de la pathologie');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Pathology $pathology)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pathology $pathology)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pathology $pathology)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pathology $pathology)
    {
        //
    }
}
