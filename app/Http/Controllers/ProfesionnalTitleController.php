<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProfesionnalTitle;
use App\Repositories\ProfesionnalTitleRepository;
use Illuminate\Support\Facades\Log;

class ProfesionnalTitleController extends Controller
{
    private $profesionnalTitleRepository;

    public function __construct(
        ProfesionnalTitleRepository $profesionnalTitleRepository,
    ){
        $this->profesionnalTitleRepository = $profesionnalTitleRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $proTitles = $this->profesionnalTitleRepository->getAll();

        return view('dashboard.titre_profe.index', compact('proTitles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $profesionnalTitles = $this->profesionnalTitleRepository->getAll();

        return view('', compact('profesionnalTitles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    
        public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|unique:profesionnal_titles',
            ], [
                "name.unique" => "Le titre $request->name existe déjà"
            ]);
            $inputs = $request->all();
            $this->profesionnalTitleRepository->store($inputs);

            return redirect()->back()->with('success', 'Titre professionnel crée avec succès');
        } catch (\Throwable $th) {
            Log::error("Erreur create STAFF TYPE : " . $th->getMessage());
            return redirect()->back()->with('error', 'Echec création du titre professionnel : '.$th->getMessage());
        }
    }
    

    /**
     * Display the specified resource.
     */
    public function show(ProfesionnalTitle $profesionnalTitle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProfesionnalTitle $profesionnalTitle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProfesionnalTitle $profesionnalTitle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProfesionnalTitle $profesionnalTitle)
    {
        //
    }
}
