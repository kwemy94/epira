<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;
use App\Repositories\PatientRepository;

class PatientController extends Controller
{

    private $patientRepository;
    private $categoryRepository;
    public function __construct(
        PatientRepository $patientRepository,
        CategoryRepository $categoryRepository
    ) {
        $this->patientRepository = $patientRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {
        $patients = $this->patientRepository->getAll();

        return View('dashboard.patient.index', compact('patients'));
    }

    public function create()
    {
        $categories = $this->categoryRepository->getAll();
        return view('dashboard.patient.create', compact('categories'));
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
