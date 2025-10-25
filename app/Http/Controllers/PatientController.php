<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Repositories\ContactRepository;
use App\Repositories\ContactTypeRepository;
use App\Repositories\DocumentRepository;
use App\Repositories\InsurerRepository;
use App\Repositories\LevelRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Repositories\CountryRepository;
use App\Repositories\PatientRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\MatrimonialRepository;
use Illuminate\Support\Facades\Log;

class PatientController extends Controller
{

    private $patientRepository;
    private $categoryRepository;
    private $matrimonialRepository;
    private $countryRepository;
    private $contactRepository;
    private $insurerRepository;
    private $levelRepository;
    private $documentRepository;
    private $contactTypeRepository;
    public function __construct(
        PatientRepository $patientRepository,
        CategoryRepository $categoryRepository,
        MatrimonialRepository $matrimonialRepository,
        CountryRepository $countryRepository,
        InsurerRepository $insurerRepository,
        ContactRepository $contactRepository,
        DocumentRepository $documentRepository,
        LevelRepository $levelRepository,
        ContactTypeRepository $contactTypeRepository,
    ) {
        $this->patientRepository = $patientRepository;
        $this->categoryRepository = $categoryRepository;
        $this->matrimonialRepository = $matrimonialRepository;
        $this->countryRepository = $countryRepository;
        $this->contactRepository = $contactRepository;
        $this->insurerRepository = $insurerRepository;
        $this->levelRepository = $levelRepository;
        $this->documentRepository = $documentRepository;
        $this->contactTypeRepository = $contactTypeRepository;
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
        $contacts = $this->contactRepository->getAll();
        $contactTypes = $this->contactTypeRepository->getAll();
        $documents = $this->documentRepository->getAll();
        $levels = $this->levelRepository->getAll();
        return view('dashboard.patient.create', compact('categories', 'matrimonials', 'countries', 'contacts', 'documents', 'levels', 'contactTypes'));
    }

    public function store(Request $request)
    {
        $inputs = $request->all();

        try {
            $inputs['reference'] = $this->generate('patients', 'reference', 'P');

            // if($request->compl_info){
            //     $contact[''] = $inputs[''];
            // }
            DB::beginTransaction();
            $patient = $this->patientRepository->store($inputs);

            if ($request->contact1_info) {
                $contact['patient_id'] = $patient->id;
                $contact['contact_type_id'] = $inputs['contact_type_id'];
                $contact['contact_name'] = $inputs['contact_name'];
                $contact['contact_job'] = $inputs['contact_job'];
                $contact['contact_employer'] = $inputs['contact_employer'];
                $contact['contact_address'] = $inputs['contact_address'];
                $contact['contact_phone'] = $inputs['contact_phone'];
                $contact['contact_other_phone'] = $inputs['contact_other_phone'];

                $contact = $this->contactRepository->store($contact);
                $patient->contacts()->attach($contact->id);
            }
            if ($request->contact2_info) {
                // dump('contact2');
            }
            if ($request->insurer_info) {
                $assurances['insurer_name'] = $inputs['insurer_name'];
                $assurances['insurer_employer'] = $inputs['insurer_employer'];
                $assurances['start_date'] = $inputs['start_date'];
                $assurances['end_date'] = $inputs['end_date'];
                $assurances['insurance_number'] = $inputs['insurance_number'];
                $assurances['card_number'] = $inputs['card_number'];
                $assurances['percentage'] = $inputs['percentage'];
                $assurances['max_insurance'] = $inputs['max_insurance'];

                $insurer = $this->insurerRepository->store($assurances);
                $patient->insurer()->attach($insurer->id);

            }

            
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            // dd($th);
            Log::info("Erreur store patient: " . $th->getMessage());
            return redirect()->back()->with("error", "Erreur de création du patient");
        }
        return redirect()->route('patient.index')->with("success", "Patient crée avec succès");
    }

    public function show(Patient $patient)
    {
        $categories = $this->categoryRepository->getAll();
        $matrimonials = $this->matrimonialRepository->getAll();
        $countries = $this->countryRepository->getAll();
        $contacts = $this->contactRepository->getAll();
        $contactTypes = $this->contactTypeRepository->getAll();
        $documents = $this->documentRepository->getAll();
        $levels = $this->levelRepository->getAll();
        
        return view('dashboard.patient.show', compact('categories', 'matrimonials', 'countries', 'contacts', 'documents', 'levels', 'contactTypes', 'patient'));
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

    public function generate(string $table, string $column = 'reference', string $prefix = 'P'): string
    {
        $year = date('Y');

        $last = DB::table($table)
            ->where($column, 'like', "{$prefix}{$year}%")
            ->orderBy('id', 'desc')
            ->value($column);

        if ($last && preg_match('/' . $prefix . $year . '(\d+)/', $last, $matches)) {
            $lastNumber = (int) $matches[1];
        } else {
            $lastNumber = 0;
        }

        $newNumber = str_pad($lastNumber + 1, 5, '0', STR_PAD_LEFT);

        return "{$prefix}{$year}{$newNumber}";
    }
}
