<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Repositories\ProfesionnalTitleRepository;
use App\Repositories\SpecializationRepository;
use App\Repositories\StaffRepository;
use App\Repositories\StaffTypeRepository;
use Illuminate\Http\Request;

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
                $file = $request->file('photo');
                $path = $file->store('staff_photos', 'public'); // -> storage/app/public/staff_photos
                $inputs['avatar'] = $path;
            }

            $this->staffRepository->store($inputs);

            return redirect()->route('staff.index')
                ->with('success', 'Personnel enregistré avec succès.');
        } catch (\Exception $e) {
            // En cas d'erreur, on redirige avec le message
            return back()->with('error', 'Erreur lors de l’enregistrement : ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Staff $staff)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Staff $staff)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Staff $staff)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Staff $staff)
    {
        //
    }
}
