<?php

namespace App\Http\Controllers;

use App\Models\StaffType;
use App\Repositories\StaffTypeRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class StaffTypeController extends Controller
{
    private $staffTypeRepository;

    public function __construct(
        StaffTypeRepository $staffTypeRepository,
    ) {
        $this->staffTypeRepository = $staffTypeRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $staffTypes = $this->staffTypeRepository->getAll();

        return view('dashboard.staff_type.index', compact('staffTypes'));
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
                'name' => 'required|string|unique:staff_types',
            ], [
                "name.unique" => "Le nom $request->name existe déjà"
            ]);
            $inputs = $request->all();
            $this->staffTypeRepository->store($inputs);

            return redirect()->back()->with('success', 'Type personnel crée avec succès');
        } catch (\Throwable $th) {
            Log::error("Erreur create STAFF TYPE : " . $th->getMessage());
            return redirect()->back()->with('error', 'Echec création du type de personnel: '. $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(StaffType $staffType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StaffType $staffType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StaffType $staffType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StaffType $staffType)
    {
        //
    }
}
