<?php

use App\Http\Controllers\AllergyController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\InsurerController;
use App\Http\Controllers\PathologyController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PrestationController;
use App\Http\Controllers\HospitalisationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // return view('welcome');
    return view('auth.login');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    # Patient
    Route::resource('/appointments', AppointmentController::class);
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
});

require __DIR__.'/auth.php';
