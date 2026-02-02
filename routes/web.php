<?php

use App\Http\Controllers\AllergyController;
use App\Http\Controllers\AmbulanceController;
use App\Http\Controllers\AnalyseController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DevisController;
use App\Http\Controllers\InsurerController;
use App\Http\Controllers\PathologyController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PrestationController;
use App\Http\Controllers\HospitalisationController;
use App\Http\Controllers\MedecineController;
use App\Http\Controllers\PharmacieController;
use App\Http\Controllers\ProfesionnalTitleController;
use App\Http\Controllers\RadiologieController;
use App\Http\Controllers\SpecializationController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\StaffTypeController;
use App\Http\Controllers\VisiteController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::get('/', function () {
    // return view('welcome');
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }
    return view('auth.login');
})->name('home');

Route::get('/dashboard', function () {
    return app(DashboardController::class)->index();
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    #staff
    Route::resource('staff-host', StaffController::class);
    Route::post('staff-host/contact', [StaffController::class, 'sendMail'])->name('contact.staff');
    Route::resource('specialization-host', SpecializationController::class);
    Route::resource('staff-type-host', StaffTypeController::class);
    Route::resource('pro-title-host', ProfesionnalTitleController::class);
    Route::get('prestation/show/{id}', [PrestationController::class, 'showPrestationDetails'])->name('prestation.show.details');

    # Patient
    Route::resource('/appointments', AppointmentController::class);
    Route::post('/appointments-fix', [PatientController::class, 'fixAppointment'])->name('fix.appointment');
    Route::get('/dossier-patient/{id}', [PatientController::class, 'dossierPatient'])->name('dossier.patient');
    Route::resource('/allergy-pat', AllergyController::class);
    Route::resource('/patient', PatientController::class);
    Route::resource('/insurer', InsurerController::class);
    Route::resource('/contact', ContactController::class);
   
    Route::resource('/pathology', PathologyController::class);
    Route::resource('/category', CategoryController::class);
    // Route::resource('/pathology', PathologyController::class);

    //Prestations
    Route::resource('/prestation', PrestationController::class);
    Route::get('/prestation/create2/{patient_id}', [PrestationController::class, 'create'])->name('prestation.create2');
    Route::get('/hopitalisation/create2/{patient_id}/{prestation_id}', [HospitalisationController::class, 'create'])->name('hospitalisation.create2');
    Route::resource('/consultation', ConsultationController::class); 
    Route::resource('/visite', VisiteController::class);

    Route::resource('/hospitalisation', HospitalisationController::class);
    Route::resource('/devis', DevisController::class); 
    Route::resource('/analyse', AnalyseController::class);
    Route::resource('/ambulance', AmbulanceController::class);
    Route::resource('/radiologie', RadiologieController::class); 
    Route::resource('/pharmacie', PharmacieController::class);
    Route::resource('/medecine', MedecineController::class);
    Route::post('/devis/line/create', [DevisController::class, 'createdevisLine'])->name('devis.line.create');
});

require __DIR__.'/auth.php';
