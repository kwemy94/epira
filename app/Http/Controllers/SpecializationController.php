<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Specialization;
use Illuminate\Support\Facades\Log;
use App\Repositories\SpecializationRepository;

class SpecializationController extends Controller
{
    private $specializationRepository;

    public function __construct(
        SpecializationRepository $specializationRepository
    ) {
        $this->specializationRepository = $specializationRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $specializations = $this->specializationRepository->getAll();

        return view('dashboard.specialisation.index', compact('specializations'));
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
            $validated = $request->validate([
                'name' => 'required|string|unique:specializations',
            ], [
                "name.unique" => "Le nom $request->name existe déjà"
            ]);
            $inputs = $request->all();
            $this->specializationRepository->store($inputs);

        } catch (\Throwable $th) {
            Log::error("Erreur create SPECIALIZATION : " . $th->getMessage());
            return redirect()->back()->with('error', 'Echec création de la spécialisation : '.$th->getMessage());
        }
        return redirect()->back()->with('success', 'Spécialisation crée avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(Specialization $specialization)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Specialization $specialization)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Specialization $specialization)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Specialization $specialization)
    {
        //
    }
}
