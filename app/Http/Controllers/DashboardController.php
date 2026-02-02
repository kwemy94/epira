<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Repositories\PatientRepository;
use App\Repositories\PrestationRepository;
use App\Repositories\AppointmentRepository;

class DashboardController extends Controller
{
    private $patientRepository;
    private $prestationRepository;
    private $appointmentRepository;

    public function __construct(
        PatientRepository $patientRepository,
        PrestationRepository $prestationRepository,
        AppointmentRepository $appointmentRepository
        )
    {
        $this->patientRepository = $patientRepository;
        $this->prestationRepository = $prestationRepository;
        $this->appointmentRepository = $appointmentRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        toggleDatabase(true);
        $patientsCount = $this->patientRepository->getAll()->count();
        $prestationsCount = $this->prestationRepository->getAll()->count();
        $appointments = $this->appointmentRepository->getAll()->count();

        return view('dashboard.dashboard', compact('patientsCount', 'prestationsCount','appointments'));
    }



}
