<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $patientsCount = \App\Models\Patient::count();
        $prestationsCount = \App\Models\Prestation::count();
        $appointments = Appointment::count();

        return view('dashboard.dashboard', compact('patientsCount', 'prestationsCount','appointments'));
    }



}
