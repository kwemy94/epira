<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Repositories\CategoryRepository;
use App\Repositories\CountryRepository;
use App\Repositories\MatrimonialRepository;
use Illuminate\Http\Request;
use App\Repositories\PatientRepository;

class PatientController extends Controller
{

    private $patientRepository;
    private $categoryRepository;
    private $matrimonialRepository;
    private $countryRepository;
    public function __construct(
        PatientRepository $patientRepository,
        CategoryRepository $categoryRepository,
        MatrimonialRepository $matrimonialRepository,
        CountryRepository $countryRepository,
    ) {
        $this->patientRepository = $patientRepository;
        $this->categoryRepository = $categoryRepository;
        $this->matrimonialRepository = $matrimonialRepository;
        $this->countryRepository = $countryRepository;
    }

    public function index()
    {
        $patients = $this->patientRepository->getAll();

        return View('dashboard.patient.index', compact('patients'));
    }

    public function create()
    {
        $categories = $this->categoryRepository->getAll();
        $matrimonials = $this->matrimonialRepository->getAll();
        $countries = $this->countryRepository->getAll();
        return view('dashboard.patient.create', compact('categories', 'matrimonials', 'countries'));
    }

    public function store(Request $request)
    {
        $inputs = $request->all();
        dd($inputs);
    }

    public function show(Patient $patient)
    {
        return view('dashboard.patient.show');
    }

    public function edit(Patient $patient)
    {
        return view('dashboard.patient.edit');
    }

    public function update(Request $request, Patient $patient)
    {
        //
    }

    public function destroy(Patient $patient)
    {
        dd("to be delete");
    }
}
