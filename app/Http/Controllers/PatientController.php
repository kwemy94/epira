<?php

namespace App\Http\Controllers;

use App\Models\BloodType;
use App\Models\Patient;
use App\Repositories\AllergyRepository;
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
use App\Repositories\PathologyRepository;
use App\Repositories\PrestationRepository;
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
    private $pathologyRepository;
    private $prestationRepository;
    private $allergyRepository;
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
        PathologyRepository $pathologyRepository,
        PrestationRepository $prestationRepository,
        AllergyRepository $allergyRepository,
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
        $this->pathologyRepository = $pathologyRepository;
        $this->prestationRepository = $prestationRepository;
        $this->allergyRepository = $allergyRepository;
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
        $prestations = $this->prestationRepository->getAll();
        return view('dashboard.patient.create', compact('categories', 'matrimonials', 'countries', 'contacts', 'documents', 'levels', 'contactTypes','prestations'));
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
        $bloodTypes = BloodType::all();
         $prestations = $this->prestationRepository->getAll();
        $mainPathologies = $this->pathologyRepository->getByType(1);
        $associatePathologies = $this->pathologyRepository->getByType(2);
        $allergies = $this->allergyRepository->getAll();
// dd($allergies, $patient);
        return view('dashboard.patient.show', compact('allergies', 'categories', 'matrimonials', 'countries', 'contacts', 'documents', 'levels', 'contactTypes', 'patient', 'bloodTypes', 'mainPathologies', 'associatePathologies','prestations'));
    }

    public function edit(Patient $patient)
    {
        return view('dashboard.patient.edit');
    }

    public function update(Request $request, Patient $patient)
    {
        try {
            $inputs = $request->all();
            // dd($inputs);
            if (isset($request->groupe_sang)) {
                $inputs = array_replace([
                    'smook' => 0,
                    'sport_pratice' => 0,
                    'herbal_medicine' => 0,
                ], $inputs);
            }

            if(isset($request->hygiene_vie)){
                $inputs = array_replace([
                    'fulfilment' => 0,
                    'motivation' => 0,
                    'boredom' => 0,
                    'stress' => 0,
                ], $inputs);
            }

            $this->patientRepository->update($patient->id, $inputs);


        } catch (\Throwable $th) {
            // dd($th);
            Log::info("Erreur update patient: " . $th->getMessage());
            return redirect()->back()->with("error", "Erreur de modification du patient");
        }
        return redirect()->back()->with("success", "Patient mise à jour avec succès");
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
