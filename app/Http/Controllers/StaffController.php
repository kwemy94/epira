<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Staff;
use Pest\Support\Str;
use App\Mail\GenericMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Repositories\StaffRepository;
use App\Repositories\StaffTypeRepository;
use App\Repositories\SpecializationRepository;
use App\Repositories\ProfesionnalTitleRepository;

class StaffController extends Controller
{
    private $staffRepository;
    private $profesionnalTitleRepository;
    private $specializationRepository;
    private $staffTypeRepository;

    public function __construct(
        StaffRepository $staffRepository,
        ProfesionnalTitleRepository $profesionnalTitleRepository,
        SpecializationRepository $specializationRepository,
        StaffTypeRepository $staffTypeRepository,
    ) {
        $this->staffRepository = $staffRepository;
        $this->staffTypeRepository = $staffTypeRepository;
        $this->profesionnalTitleRepository = $profesionnalTitleRepository;
        $this->specializationRepository = $specializationRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $staffs = $this->staffRepository->getAll();

        return view('dashboard.staff.index', compact('staffs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $staffTypes = $this->staffTypeRepository->getAll();
        $profesionnalTitles = $this->profesionnalTitleRepository->getAll();
        $specializations = $this->specializationRepository->getAll();

        return view('dashboard.staff.create', compact('profesionnalTitles', 'staffTypes', 'specializations'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        // dd(1);
        try {

            // $validated = $request->validate([
            //     'lastname' => 'required|string|max:100',
            //     'firstname' => 'required|string|max:100',
            //     'sex' => 'required|in:male,female', // ou selon ta logique
            //     'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            // ]);

            $inputs = $request->all();

            if ($request->hasFile('photo')) {
                $path = $request->file('photo')->store('staff_photos', 'public');
                $inputs['avatar'] = $path;
                // dd($inputs);
            }

            $inputs['password'] = Hash::make($inputs['password']);

            $this->staffRepository->store($inputs);

            return redirect()->route('staff-host.index')
                ->with('success', 'Professionnel enregistré avec succès.');
        } catch (\Exception $e) {
            // En cas d'erreur, on redirige avec le message
            return back()->with('error', 'Erreur lors de l\'enregistrement : ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $staff = $this->staffRepository->getById($id);
        $staffTypes = $this->staffTypeRepository->getAll();
        $profesionnalTitles = $this->profesionnalTitleRepository->getAll();
        $specializations = $this->specializationRepository->getAll();

        return view('dashboard.staff.create', compact('staff', 'staffTypes', 'profesionnalTitles', 'specializations'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $staff = $this->staffRepository->getById($id);
            if (!$staff) {
                throw new Exception('Professionnel non existant');
            }
            $inputs = $request->all();

            if ($request->hasFile('photo')) {
                $path = $request->file('photo')->store('staff_photos', 'public');
                $inputs['avatar'] = $path;
                // dd($inputs);
            }

            if ($request->hasFile('photo')) {
                $file = $request->file('photo');
                $path = $file->store('staff_photos', 'public'); // -> storage/app/public/staff_photos
                $inputs['avatar'] = $path;
            }

            if (!empty($inputs['password'])) {
                $inputs['password'] = Hash::make($inputs['password']);
            }

            $inputs = array_replace([
                'intern' => 0,
                'generic_account' => 0,
                'honorary_appointment' => 0,
                'authorize_appointment' => 0,
            ], $inputs);

            $this->staffRepository->update($id, $inputs);

            return redirect()->route('staff-host.index')
                ->with('success', 'Professionnel mis à jour avec succès.');
        } catch (\Exception $e) {
            return back()->with('error', 'Erreur lors de la mise à jour : ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $spec = $this->staffRepository->getById($id);

            if (!$spec) {
                throw new \Exception('Professionnel non trouvée');
            }
            if ($spec->patient()->exists()) {
                throw new \Exception('Professionnel utilisé');
            }

            $this->staffRepository->destroy($id);

            return redirect()->back()->with('success', 'Professionnel supprimée avec succès');
        } catch (\Throwable $th) {
            Log::error("Erreur DELETE PROFESIONNEL : " . $th->getMessage());
            return redirect()->back()->with('error', 'Echec suppression du professionnel ');
        }
    }


    public function sendMail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        try {
            Mail::to($request->email)->send(
                new GenericMail($request->subject, $request->message)
            );

            return redirect()->back()->with('success', 'Email envoyé avec succès !');
        } catch (Exception $e) {
            Log::error("SEND MAIL ERROR : " . $e->getMessage());
            return redirect()->back()->with('error', 'Echec d\'envoie de message ');
        }
    }
}
