<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Repositories\CompanyRepository;
use App\Services\CompanyService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CompanyController extends Controller
{

    private $companyRepository;
    public function __construct(CompanyRepository $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = $this->companyRepository->getAll();
        return view('dashboard.company.index', compact('companies'));
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

    public function store(Request $request, CompanyService $service)
    {
        $result = $service->createCompany($request);

        
        return redirect()->route('company.index')
        ->with(["success" =>"Entreprise créée. Un email d’activation a été envoyé."]);
        
        # A utiliser lors de la création via API
        # return response()->json([
        #     'success' => true,
        #     'message' => "Entreprise créée. Un email d’activation a été envoyé.",
        #     'data' => [
        #         'company_id' => $result->id,
        #     ],
        # ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Company $company)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        //
    }

    public function activateCompany($id)
    {
        $company = $this->companyRepository->getById($id);
        if ($company) {
            $this->companyRepository->update($id, ['status' => 0]);

            return response()->json([
                'success' => true,
                'message' => "Bien vouloir valider les commandes pour finaliser l'activation"
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => "Etablissement non existant"
        ]);
    }
}
