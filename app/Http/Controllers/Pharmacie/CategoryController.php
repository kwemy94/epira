<?php

namespace App\Http\Controllers\Pharmacie;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Repositories\CategoryRepository;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository){
        $this->categoryRepository = $categoryRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        toggleDatabase(true);
        $categories =  $this->categoryRepository->getAll();
        return view('dashboard.category.index', compact('categories'));
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
        toggleDatabase(true);
        try {
            // $validator = Validator::make($request->all(), [
            //     'name' => 'string|unique:pathologies,name',
            // ], [
            //     'name.unique' => 'Ce nom de pathologie existe déjà.',
            // ]);

            // if ($validator->fails()) {
            //     throw new ValidationException($validator);
            // }
            $inputs = $request->all();
            $category = $this->categoryRepository->store($inputs);

        } catch (\Throwable $th) {
            Log::error("Erreur create category : " . $th->getMessage());
            return redirect()->back()->with('error', 'Echec création de la catégorie');
        }
        return redirect()->back()->with('success', 'Catégorie crée avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }
}
